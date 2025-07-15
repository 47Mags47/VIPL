import { useForm, usePage } from '@inertiajs/react'

import { AuthenticatedLayout as Layout } from '@/layouts';
import { VerticalForm as Form, StringInput as Input } from '@/components/forms';

export default function Edit() {
    const config = usePage().props.config.data
    const { data, setData, put, processing } = useForm({
        code: config.code,
        value: config.value,
    });

    function onSubmit(e) {
        e.preventDefault()

        put(route('config.update', { config: config.id }), data)
    }

    return (
        <Layout>
            <Form
                header="Конфигурация"
                sbm="сохранить"
                handleSubmit={onSubmit}
                processing={processing}
            >
                <Input
                    name="code"
                    label="Код"
                    value={data.code}
                    onChange={(e) => setData('code', e.target.value)}
                    disabled
                />
                <Input
                    name="value"
                    label="Значение"
                    value={data.value}
                    onChange={(e) => setData('value', e.target.value)}
                />
            </Form>
        </Layout>
    );
}
