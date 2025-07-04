import { useForm, usePage } from '@inertiajs/react'

import { AuthenticatedLayout as Layout } from '@/layouts';
import { VerticalForm as Form, StringInput as Input, Select } from '@/components/forms';

import List from '@/components/forms/inputs/List';

export default function Edit() {
    const column = usePage().props.column.data

    const { data, setData, put, processing } = useForm({
        code: column.code,
        name: column.name,
        file_pos: column.position,
        required: column.required,
        patterns: column.patterns,
        type_id: column.type.id
    });

    function onSubmit(e) {
        e.preventDefault()

        put(route('glossary.validator.update', { column: column.id }), data)
    }

    return (
        <Layout>
            <Form
                header={column.name}
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
                    disabled
                />
                <Input
                    name="file_pos"
                    label="Позиция"
                    value={data.file_pos}
                    onChange={(e) => setData('file_pos', e.target.value)}
                />

                <Select
                    name="type_id"
                    label="Тип"
                    list={usePage().props.types.data}
                    item_value="name"
                    value={data.type_id}
                    onChange={(value) => setData('type_id', value)}
                />
                <List
                    items={data.patterns}
                    setItems={(newPatterns) => setData('patterns', newPatterns)}
                    name="patterns"
                    label="Шаблоны"
                />
            </Form>
        </Layout>
    )
}
