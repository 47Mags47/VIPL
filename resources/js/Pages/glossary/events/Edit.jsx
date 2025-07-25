import { useForm, usePage } from '@inertiajs/react'

import { AuthenticatedLayout as Layout } from '@/layouts';
import { VerticalForm as Form, DatePicker, Select } from '@/components/forms';


export default function Create() {
    const event = usePage().props.event.data

    const { data, setData, put, processing } = useForm({
        date: event.date,
        payment_id: event.payment.id,
    });


    function onSubmit(e) {
        e.preventDefault()

        put(route('glossary.events.update', { event: event.id }), data)
    }

    return (
        <Layout>
            <Form
                header="Новый источник финансирования"
                sbm="Отправить"
                handleSubmit={onSubmit}
                processing={processing}
            >
                <DatePicker
                    name="date"
                    label="Дата"
                    value={data.date}
                    onChange={(value) => setData('date', value)}
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
