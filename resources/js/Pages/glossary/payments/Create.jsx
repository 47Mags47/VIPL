import { useForm, usePage }                                                         from '@inertiajs/react'

import { AuthenticatedLayout as Layout }                                            from '@/layouts'
import { VerticalForm as Form, StringInput as Input, Select, TextArea, DatePicker } from '@/components/forms'

import dayjs                                                                        from 'dayjs'


export default function Create() {
    const { data, setData, post, processing } = useForm({
        code: '',
        krv: '',
        name: '',
        kbk: '',
        periodicity_id: '',
        law_id: '',
        start_at: '',
    })

    function onSubmit(e) {
        e.preventDefault()

        post(route('glossary.payments.store'), data)
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
                <DatePicker
                    name="start_at"
                    label="Дата начала"
                    value={data.start_at ? dayjs(data.start_at, 'YYYY-MM-DD') : dayjs()}
                    onChange={(value) => setData('start_at', value ? value.format('YYYY-MM-DD') : '')}
                />
            </Form>
        </Layout>
    )
}
