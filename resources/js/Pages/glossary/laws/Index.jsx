import { usePage }                                      from "@inertiajs/react"

import { AuthenticatedLayout as Layout }                from '@/layouts'
import { Table, AddButton, EditButton, DeleteButton }   from "@/components/table"


export default function Index() {
    const laws = usePage().props.laws

    const columns = [
        {
            title: ' Код',
            dataIndex: 'code',
            width: 80,
        },
        {
            title: 'Наименование',
            dataIndex: 'name',
        },
        {
            title: 'Вид финансирования',
            dataIndex: ['source', 'name'],
            width: 250,
        },
        {
            title: '',
            key: 'edit',
            width: 80,
            render: (_, record) => (
                <EditButton href={route('glossary.laws.edit', { law: record.id })} />
            )
        },
        {
            title: '',
            key: 'delete',
            width: 80,
            render: (_, record) => (
                <DeleteButton href={route('glossary.laws.destroy', { law: record.id })} />
            )
        },
    ]

    return (
        <Layout>
            <Table
                rowKey="id"
                columns={columns}
                data={laws}
                actions={
                    <AddButton href={route('glossary.laws.create')} />
                }
            />
        </Layout>
    )
}
