import { usePage }                                      from "@inertiajs/react"

import { AuthenticatedLayout as Layout }                from '@/layouts'
import { Table, AddButton, EditButton, DeleteButton }   from "@/components/table"


export default function Index() {
    const payments = usePage().props.payments

    const columns = [
        {
            title: 'Код',
            dataIndex: 'code',
            width: 75,
        },
        {
            title: 'Краткое наименование',
            dataIndex: 'krv',
        },
        {
            title: 'Наименование',
            dataIndex: 'name',
        },
        {
            title: 'КБК',
            dataIndex: 'kbk',
            width: 210,
        },
        {
            title: 'Закон',
            dataIndex: ['law', 'code'],
            width: 150,
        },
        {
            title: 'Периодичность',
            dataIndex: ['periodicity', 'name'],
            width: 150,
        },
        {
            title: 'Дата начала',
            dataIndex: ['start_at'],
            render: (value) => new Date(value).toLocaleDateString()
        },
        {
            title: '',
            key: 'edit',
            width: 80,
            render: (_, record) => (
                <EditButton href={route('glossary.payments.edit', { payment: record.id })} />
            )
        },
        {
            title: '',
            key: 'delete',
            width: 80,
            render: (_, record) => (
                <DeleteButton href={route('glossary.payments.destroy', { payment: record.id })} />
            )
        },
    ]

    return (
        <Layout>
            <Table
                rowKey="code"
                columns={columns}
                data={payments}
                actions={
                    <AddButton href={route('glossary.payments.create')} />
                }
            />
        </Layout>
    )
}
