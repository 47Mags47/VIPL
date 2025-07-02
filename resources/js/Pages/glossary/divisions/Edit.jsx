import { useForm, usePage } from '@inertiajs/react'

import { AuthenticatedLayout as Layout } from '@/layouts';
import { VerticalForm as Form, StringInput as Input, Select } from '@/components/forms';


export default function Edit() {
    const division = usePage().props.division.data
    const { data, setData, put, processing } = useForm({
        code: division.code,
        name: division.name,
    });

    function onSubmit(e) {
        e.preventDefault()

        put(route('glossary.divisions.update', { division: division.id }), data)
    }

    return (
        <Layout>
            <Form
                header={division.name}
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
            </Form>
        </Layout>
    );
}
