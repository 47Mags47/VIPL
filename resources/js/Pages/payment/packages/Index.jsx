import { usePage } from "@inertiajs/react";

import { AuthenticatedLayout as Layout } from '@/layouts';
import { Table, GoToButton } from "@/components/table";
import StatusCircle from "@/components/StatusCircle";

export default function Index() {
    const packages = usePage().props.packages
    const event = usePage().props.event.data

    const columns = [
        {
            title: '',
            dataIndex: 'status',
            width: 50,
            render: (_, record) => (<StatusCircle title={record.status.name} color={record.status.color} />)
        },
        {
            title: 'UUID',
            dataIndex: 'id',
            width: 300,
        },
        {
            title: 'Создан',
            dataIndex: 'created_at',
            width: 110,
        },
        {
            title: ' Подразделение',
            dataIndex: ['division', 'name'],
        },
        {
            title: 'На сумму',
            dataIndex: 'totalSumm',
            width: 300,
        },
        {
            key: 'goTo',
            width: 80,
            render: (_, record) => (
                <GoToButton href={route('payments.packages.show', { package: record.id })} />
            )
        },
    ]

    return (
        <Layout>
            <Table
                rowKey="id"
                columns={columns}
                data={packages}
                actions={
                    <GoToButton href={route('payments.raports.index', { event: event.id })} />
                }
            />
        </Layout >
    );
}
