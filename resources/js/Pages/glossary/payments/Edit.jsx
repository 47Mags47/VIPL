import { useForm, usePage } from '@inertiajs/react'

import { AuthenticatedLayout as Layout } from '@/layouts';
import { VerticalForm as Form, StringInput as Input, Select, TextArea } from '@/components/forms';


export default function Edit() {
    const payment = usePage().props.payment.data
    const { data, setData, put, processing } = useForm({
        code:               payment.code,
        krv:                payment.krv,
        name:               payment.name,
        kbk:                payment.kbk,
        periodicity_id:     payment.periodicity.id,
        law_id:             payment.law.id,
    });


    function onSubmit(e) {
        e.preventDefault()

        put(route('glossary.payments.update', {payment: payment.id}), data)
    }

    return (
        <Layout>
            <Form
                header="Новая выплата"
                sbm="Отправить"
                handleSubmit={onSubmit}
                processing={processing}
            >
                <Input
                    name="code"
                    label="Код"
                    value={data.code}
                    onChange={(e) => setData('code', e.target.value)}
                />
                <Input
                    name="krv"
                    label="Краткое наименование"
                    value={data.krv}
                    onChange={(e) => setData('krv', e.target.value)}
                />
                <TextArea
                    name="name"
                    label="Наименование"
                    value={data.name}
                    onChange={(e) => setData('name', e.target.value)}
                />
                <Input
                    name="kbk"
                    label="КБК"
                    value={data.kbk}
                    onChange={(e) => setData('kbk', e.target.value)}
                />
                <Select
                    name="law_id"
                    label="Закон"
                    list={usePage().props.laws.data}
                    item_value="code"
                    value={data.law_id}
                    onChange={(value) => setData('law_id', value)}
                />
                <Select
                    name="periodicity_id"
                    label="Переодичность"
                    list={usePage().props.periodicities.data}
                    item_value="name"
                    value={data.periodicity_id}
                    onChange={(value) => setData('periodicity_id', value)}
                />
            </Form>
        </Layout>
    );
}
