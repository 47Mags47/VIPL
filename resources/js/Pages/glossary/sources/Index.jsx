import { usePage } from "@inertiajs/react";

import { AuthenticatedLayout as Layout } from '@/layouts';
import { Table, AddButton, EditButton, DeleteButton } from "@/components/table";

export default function Index() {
    const sources = usePage().props.sources

    const columns = [
        {
            title: 'Код',
            dataIndex: 'code',
            width: 100,
        },
        {
            title: 'Наименование',
            dataIndex: 'name',
        },
        {
            key: 'edit',
            width: 80,
            render: (_, record) => (
                <EditButton href={route('glossary.sources.edit', { source: record.id })} />
            )
        },
        {
            key: 'delete',
            width: 80,
            render: (_, record) => (
                <DeleteButton href={route('glossary.sources.destroy', { source: record.id })} />
            )
        },
    ];

    return (
        <Layout>
            <Table
                rowKey="id"
                columns={columns}
                data={sources}
                actions={
                    <AddButton href={route('glossary.sources.create')} />
                }
            />
        </Layout>
    );
}
