import { usePage } from "@inertiajs/react";

import { AuthenticatedLayout as Layout } from '@/layouts';
import { Table, AddButton, DeleteButton, GoToButton } from "@/components/table";
import StatusCircle from "@/components/StatusCircle";

export default function Index() {
    const files = usePage().props.files
    const paymentPackage = usePage().props.package.data

    const columns = [
        {
            title: '',
            dataIndex: 'status',
            width: 40,
            render: (_, record) => (<StatusCircle title={record.status.name} color={record.status.color} />)
        },
        {
            title: 'Нименование',
            dataIndex: 'name',
        },
        {
            title: 'Банк',
            dataIndex: ['bank', 'code'],
            width: 200,
        },
        {
            title: 'Получателей',
            dataIndex: 'recipients',
            width: 125,
        },

        {
            title: 'На сумму (руб)',
            dataIndex: 'summ',
            width: 200,
        },
        {
            title: 'Размер',
            dataIndex: 'size',
            width: 100,
        },
        {
            title: 'Ошибки',
            dataIndex: 'errors',
            width: 300,
            render: (_, record) => (
                <ul title={record.errors.context.join(',\n')} >
                    {
                        record.errors.list.map((error, i) => (
                            <li key={i} >{error}</li>
                        ))
                    }
                </ul>
            )
        },
        {
            key: 'delete',
            width: 80,
            render: (_, record) => (
                <DeleteButton href={route('payments.files.destroy', { package: paymentPackage.id, file: record.id })} />
            )
        },
        {
            key: 'show',
            width: 80,
            render: (_, record) => {
                return record.status.color !== 'red'
                    ? (
                        <GoToButton href={route('payments.files.show', { file: record.id })} />
                    )
                    : ''
            }
        },
    ]

    return (
        <Layout>
            <Table
                rowKey="id"
                columns={columns}
                data={files}
                actions={
                    <AddButton href={route('payments.files.create', { package: paymentPackage.id })} />
                }
            />
        </Layout>
    );
}
