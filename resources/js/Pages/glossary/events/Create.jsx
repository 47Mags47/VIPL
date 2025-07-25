import { useForm, usePage } from '@inertiajs/react'

import { AuthenticatedLayout as Layout } from '@/layouts';
import { VerticalForm as Form, DatePicker, Select } from '@/components/forms';


export default function Create() {
    const { data, setData, post, processing } = useForm({
        date: [],
        payment_id: '',
    });

    function onSubmit(e) {
        e.preventDefault()

        post(route('glossary.events.store'), data)
    }


    return (
        <Layout>
            <Form
                header="График выплат"
                sbm="Отправить"
                handleSubmit={onSubmit}
                processing={processing}
            >
                <DatePicker
                    name="date"
                    label="Дата"
                    value={data.date}
                    onChange={(value) => setData('date', value)}
                    multiple
                />
                <Select
                    name="payment_id"
                    label="Выплата"
                    list={usePage().props.payments.data}
                    value={data.payment_id}
                    item_value="name"
                    onChange={(value) => setData('payment_id', value)}
                />
            </Form>
        </Layout>
    );

}
