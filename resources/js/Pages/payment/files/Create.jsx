import { useEffect, useState } from 'react';
import { router, usePage } from '@inertiajs/react';
import Resumable from 'resumablejs';

import { Upload, Button } from 'antd';

import { UploadOutlined } from '@ant-design/icons';

import ModalButton from "@/components/button/ModalButton";
import ProgressBar from '@/components/ProgressBar';
import BaseButton from '@/components/button/BaseButton';
import VerticalForm from '@/components/form/VerticalForm';
import Add from '@/components/icons/Add'
import SelectComponent from '@/components/inputs/Select';
import handleSelectChange from '@/handles/input/handleSelectChange';

export default function Create() {
    const props = usePage().props

    const [progress, setProgress] = useState(0)
    const [isUploading, setIsUploading] = useState(false)
    const [modalShow, changeModalShow] = useState(false)
    const [disabled, setDisabled] = useState(false)
    const [closable, setClosable] = useState(true)

    useEffect(() => {
        if (!modalShow) {
            setProgress(0)
            setIsUploading(false)
            setValues(prev => ({ ...prev, file: {}, bank: '' }))
        }
    }, [modalShow])

    const [values, setValues] = useState({
        file: {},
        bank: '',
        banks: props.banks.data.map(bank => ({
            value: bank.id,
            label: bank.name
        }))
    });

    const isFormValid = values.bank && values.file instanceof File;

    const query = { _token: token(), bank: values.bank }

    const resumable = new Resumable({
        chunkSize: 0.1 * 1024 * 1024, // 10MB
        simultaneousUploads: 3,
        testChunks: false,
        throttleProgressCallbacks: 1,
        target: route('payments.package.files.store', { package: props.package.data.id }),
        query: query,
    });

    useEffect(() => {
        resumable.cancel()
        if (values.file instanceof File)
            resumable.addFile(values.file)
    }, [values])

    function onSubmit(e) {
        e.preventDefault()

        let url = route('payments.package.files.check', { package: props.package.data.id })
        router.post(url, { ...query, 'file-size': values.file.size }, {
            onSuccess: async () => {
                resumable.upload();
                setIsUploading(true)
            }
        })
    }

    resumable.on('progress', () => {
        let procentage = resumable.progress()
        setProgress(procentage)
        setClosable(false)
        setDisabled(true)
    })
    resumable.on('fileSuccess', () => {
        setClosable(true)
        setDisabled(false)
        setIsUploading(false)
        changeModalShow(false)
    })
    return (
        <ModalButton
            open={modalShow}
            maskClosable={closable}
            closable={closable}
            className="add"
            changeState={(state) => { changeModalShow(state) }}
            buttonText={<Add />}
            footer={
                <BaseButton
                    className="add-btn"
                    type="submit"
                    form="glossary-bank-add-form"
                    disabled={!isFormValid || disabled}
                >
                    Добавить
                </BaseButton>
            }
        >
            <VerticalForm
                header={'Добавить'}
                handleSubmit={onSubmit}
                id="glossary-bank-add-form"
            >
                <SelectComponent
                    name="bank"
                    label="Банк"
                    options={values.banks}
                    disabled={disabled}
                    value={values.bank}
                    onChange={(value) => {
                        handleSelectChange('bank', value, values, setValues)
                    }}
                />
                <Upload
                    type={"file"}
                    name={"file"}
                    disabled={disabled}
                    maxCount={1}
                    beforeUpload={(file) => {
                        setValues({ ...values, file: file })
                        return false
                    }}
                >
                    <Button
                        icon={<UploadOutlined />}
                    >
                        Загрузить файл
                    </Button>
                </Upload>
                {isUploading && <ProgressBar progress={progress} />}
            </VerticalForm>
        </ModalButton >
    )
}
