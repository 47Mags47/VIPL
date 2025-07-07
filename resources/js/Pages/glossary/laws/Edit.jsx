import { useForm, usePage } from '@inertiajs/react'

import { AuthenticatedLayout as Layout } from '@/layouts';
import { VerticalForm as Form, StringInput as Input, Select } from '@/components/forms';


export default function Edit() {
    const law = usePage().props.law.data
    const { data, setData, put, processing } = useForm({
        code: law.code,
        name: law.name,
        source_id: law.source.id,
    });

    function onSubmit(e) {
        e.preventDefault()

        put(route('glossary.laws.update', { law: law.id }), data)
    }

    return (
        <Layout>
            <Form
                header={law.code}
                sbm="сохранить"
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
                    name="name"
                    label="Наименование"
                    value={data.name}
                    onChange={(e) => setData('name', e.target.value)}
                />
                <Select
                    name="source_id"
                    label="Вид финансирования"
                    list={usePage().props.sources.data}
                    item_value="name"
                    value={data.source_id}
                    onChange={(value) => setData('source_id', value)}
                />
            </Form>
        </Layout>
    );
}
