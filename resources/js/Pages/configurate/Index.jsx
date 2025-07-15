import { usePage } from "@inertiajs/react";

import { AuthenticatedLayout as Layout } from '@/layouts';
import { Table, EditButton } from "@/components/table";

export default function Index() {
    const config = usePage().props.config

    const columns = [
        {
            title: 'Параметр',
            dataIndex: 'code',
        },
        {
            title: 'Значение',
            dataIndex: 'value',
        },
        {
            key: 'edit',
            width: 80,
            render: (_, record) => (
                <EditButton href={route('config.edit', { config: record.id })} />
            )
        },
    ]

    return (
        <Layout>
            <Table
                columns={columns}
                data={config}
            >
            </Table>
        </Layout>
    )
}
