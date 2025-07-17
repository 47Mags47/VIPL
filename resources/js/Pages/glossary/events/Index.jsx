import { usePage } from "@inertiajs/react";

import { AuthenticatedLayout as Layout } from '@/layouts';
import { Table, AddButton, EditButton, DeleteButton } from "@/components/table";

export default function Index() {
    const events = usePage().props.events

    const columns = [
        {
            title: 'Дата',
            dataIndex: 'date',
            width: 125,
            onCell: (record, index) => {
                const obj = {}
                const inThisdate = events.data.filter((item) => item.date === record.date)
                if (inThisdate.length > 1) {
                    obj.rowSpan = inThisdate[0].id == record.id
                        ? inThisdate.length
                        : 0
                }
                return obj
            },
            render: (value) => new Date(value).toLocaleDateString()
        },
        {
            title: 'Номер выплаты',
            dataIndex: ['payment', 'code'],
        },
        {
            title: 'Нормативно-правовые акты, соответствующие выплате.',
            dataIndex: ['payment', 'law', 'name'],
        },
        {
            key: 'delete',
            width: 80,
            render: (_, record) => (
                <DeleteButton href={route('glossary.events.destroy', { event: record.id })} />
            )
        },
        {
            key: 'edit',
            width: 80,
            render: (_, record) => (
                <EditButton href={route('glossary.events.edit', { event: record.id })} />
            )
        },
    ]



    return (
        <Layout>
            <Table
                rowKey="id"
                columns={columns}
                data={events}
                actions={
                    <AddButton href={route('glossary.events.create')} />
                }
            />
        </Layout>
    );
}
