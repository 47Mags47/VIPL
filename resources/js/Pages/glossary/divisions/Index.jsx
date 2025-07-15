import { usePage }                                      from "@inertiajs/react"

import { AuthenticatedLayout as Layout }                from '@/layouts'
import { Table, AddButton, EditButton, DeleteButton }   from "@/components/table"


export default function Index() {
    const divisions = usePage().props.divisions

    const columns = [
        {
            title: ' Код',
            dataIndex: 'code',
            width: 75,
        },
        {
            title: 'Наименование',
            dataIndex: 'name',
        },
        {
            title: '',
            key: 'edit',
            width: 80,
            render: (_, record) => (
                <EditButton href={route('glossary.divisions.edit', { division: record.id })} />
            )
        },
        {
            title: '',
            key: 'delete',
            width: 80,
            render: (_, record) => (
                <DeleteButton href={route('glossary.divisions.destroy', { division: record.id })} />
            )
        },
    ]

    return (
        <Layout>
            <Table
                rowKey="id"
                columns={columns}
                data={divisions}
                actions={
                    <AddButton href={route('glossary.divisions.create')} />
                }
            />
        </Layout>
    )
}
