import { useEffect, useState }  from 'react';
import { router, usePage }      from '@inertiajs/react';
import Resumable                from 'resumablejs';

import ModalButton              from "@/components/button/ModalButton";
import BaseButton               from '@/components/button/BaseButton';
import VerticalForm             from '@/components/form/VerticalForm';
import Add                      from '@/components/icons/Add'
import Input                    from "@/components/inputs/Input"
import SelectComponent          from '@/components/inputs/Select';
import handleSelectChange       from '@/handles/input/handleSelectChange';

export default function Create() {
    const props = usePage().props

    const [modalShow, changeModalShow] = useState(false)
    const [values, setValues] = useState({
        file: {},
        bank: '',
        banks: props.banks.data.map(bank => ({
            value: bank.id,
            label: bank.name
        }))
    });

    const query = { _token: token(), bank: values.bank }

    const resumable = new Resumable({
        chunkSize: 10 * 1024 * 1024, // 10MB
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
        router.post(url, {...query, 'file-size' : values.file.size}, {
            onSuccess: async () => {
                resumable.upload();
            }
        })
    }

    resumable.on('progress', () => {
        let procentage = resumable.progress()
        // DEV Суда запихнуть прогрессбар
        // DEV после закрытия модалки, надо сделать очистку формы
        console.log(procentage);

        if(procentage === 1)
            changeModalShow(false)
    })

    return (
        <ModalButton
            open={modalShow}
            className="add"
            changeState={(state) => { changeModalShow(state) }}
            buttonText={<Add />}
            footer={
                <BaseButton
                    className="add-btn"
                    type="submit"
                    form="glossary-bank-add-form"
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
                    value={values.bank}
                    onChange={(value) => {
                        handleSelectChange('bank', value, values, setValues)
                    }}
                />
                <Input
                    type={"file"}
                    name={"file"}
                    label={"Числовой код"}
                    onChange={(e) => {
                        setValues({ ...values, file: e.target.files[0] })
                    }}
                />
            </VerticalForm>
        </ModalButton>
    )
}
