import { useForm, usePage } from '@inertiajs/react'

import { AuthenticatedLayout as Layout } from '@/layouts';
import { VerticalForm as Form, StringInput as Input, Select } from '@/components/forms';


export default function Create() {
    const { data, setData, post, processing } = useForm({
        code: '',
        name: '',
        source_id: '',
    });

    function onSubmit(e) {
        e.preventDefault()

        post(route('glossary.laws.store'), data)
    }

    return (
        <Layout>
            <Form
                header="Новый закон"
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




