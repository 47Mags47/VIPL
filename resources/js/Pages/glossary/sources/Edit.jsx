import { useForm, usePage } from '@inertiajs/react'

import { AuthenticatedLayout as Layout } from '@/layouts';
import { VerticalForm as Form, StringInput as Input } from '@/components/forms';


export default function Create() {
    const source = usePage().props.source.data

    const { data, setData, put, processing } = useForm({
        code: source.code,
        name: source.name,
    });

    function onSubmit(e) {
        e.preventDefault()

        put(route('glossary.sources.update', {source: source.id}), data)
    }

    return (
            <Layout>
                <Form
                    header="Новый источник финансирования"
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
                </Form>
            </Layout>
        );

    }
