import { useForm, usePage } from '@inertiajs/react'

import { AuthenticatedLayout as Layout } from '@/layouts';
import { VerticalForm as Form, StringInput as Input, Select, DatePicker } from '@/components/forms';


export default function Create() {
    const { data, setData, post, processing } = useForm({
        bank: {
            number_code: '',
            code: '',
            name: '',
            exporter_id: '',
        },
        contract: {
            number: '',
            signed_at: '',
        }
    });

    function onSubmit(e) {
        e.preventDefault()

        post(route('glossary.banks.store'), data)
    }


    return (
        <Layout>
            <Form
                header="Новый банк"
                sbm="Отправить"
                handleSubmit={onSubmit}
                processing={processing}
            >
                <Input
                    type="number"
                    name="bank[number_code]"
                    label="Числовой код"
                    value={data.bank.number_code}
                    onChange={(e) => setData('bank.number_code', e.target.value)}
                />
                <Input
                    name="bank[code]"
                    label="Строковый код"
                    value={data.bank.code}
                    onChange={(e) => setData('bank.code', e.target.value)}
                />
                <Input
                    name="bank[name]"
                    label="Наименование"
                    value={data.bank.name}
                    onChange={(e) => setData('bank.name', e.target.value)}
                />
                <Select
                    name="bank[exporter_id]"
                    label="Экспортер"
                    list={usePage().props.exporters.data}
                    item_value="name"
                    value={data.bank.exporter_id}
                    onChange={(value) => setData('bank.exporter_id', value)}
                />
                <Input
                    type="text"
                    name="contract[number]"
                    label="Номер контракта"
                    value={data.contract.number}
                    onChange={(e) => setData('contract.number', e.target.value)}
                />
                <DatePicker
                    name="contract[signed_at]"
                    label="Дата заключения"
                    value={data.contract.signed_at ? dayjs(data.contract.signed_at, 'YYYY-MM-DD') : dayjs()}
                    onChange={(value) => setData('contract.signed_at', value ? value.format('YYYY-MM-DD') : '')}
                />
            </Form>
        </Layout>
    );

}




