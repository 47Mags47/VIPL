import Resumable from 'resumablejs';
import { useForm, usePage } from '@inertiajs/react'

import { UploadOutlined } from '@ant-design/icons';
import { Button, Upload } from 'antd';

import { AuthenticatedLayout as Layout } from '@/layouts';
import { VerticalForm as Form, Select } from '@/components/forms';


export default function Create() {
    const PaymentPackage = usePage().props.package.data
    const banks = usePage().props.banks.data

    const { data, setData, post, processing } = useForm({
        file: '',
        bank: '',
    });

    function onSubmit(e) {
        e.preventDefault()

        post(route('payments.files.store', { package: PaymentPackage.id }), data)
    }


    return (
        <Layout>
            <Form
                header={'Добавить'}
                sbm="Отправить"
                handleSubmit={onSubmit}
                processing={processing}
                file
            >
                <Select
                    name="bank"
                    label="Банк"
                    list={banks}
                    item_value="name"
                    value={data.bank_id}
                    onChange={(value) => setData('bank', value)}
                />
                <Upload
                    customRequest={({ onSuccess, onError, file }) => {
                        setData('file', file)
                        onSuccess(null, file);
                    }}
                >
                    <Button icon={<UploadOutlined />}>Upload</Button>
                </Upload>
            </Form>
        </Layout>
    )
}
