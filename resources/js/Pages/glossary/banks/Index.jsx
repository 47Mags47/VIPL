import { usePage }                                      from "@inertiajs/react"

import { AuthenticatedLayout as Layout }                from '@/layouts'
import { Table, AddButton, EditButton, DeleteButton }   from "@/components/table"


export default function Index() {
    const banks = usePage().props.banks

    const columns = [
        {
            title: 'Числовой код',
            dataIndex: 'number_code',
        },
        {
            title: 'Строковый код',
            dataIndex: 'code',
        },
        {
            title: 'Наименование',
            dataIndex: 'name',
        },
        {
            title: 'Экспортер',
            dataIndex: ['exporter', 'name'],
        },
        {
            title: 'Номер контракта',
            dataIndex: ['contract', 'number'],
        },
        {
            title: 'Дата заключения',
            dataIndex: ['contract', 'signed_at'],
            render: (value) => new Date(value).toLocaleDateString()
        },
        {
            key: 'edit',
            width: 80,
            render: (_, record) => (
                <EditButton href={route('glossary.banks.edit', { bank: record.id })} />
            )
        },
        {
            key: 'delete',
            width: 80,
            render: (_, record) => (
                <DeleteButton href={route('glossary.banks.destroy', { bank: record.id })} />
            )
        },
    ]

    return (
        <Layout>
            <Table
                rowKey="id"
                columns={columns}
                data={banks}
                actions={
                    <AddButton href={route('glossary.banks.create')} />
                }
            />
        </Layout>
    )
}
