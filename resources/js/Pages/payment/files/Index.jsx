import { usePage } from "@inertiajs/react"

import { AuthenticatedLayout as Layout } from '@/layouts'
import { AddButton, DeleteButton, GoToButton } from "@/components/table"
import EchoProgress from "@/components/EchoProgress"
import Table from "@/components/table/echo/Table"

export default function Index() {
    const paymentPackage = usePage().props.package.data

    const columns = [
        {
            title: '',
            width: 80,
            center: true,
            render: (_, record, changeState) => <EchoProgress chanel={'files.' + record.id} status={record.status.type} />

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
            center: true,
            button: true,
            render: (_, record) => (
                <DeleteButton href={route('payments.files.destroy', { package: paymentPackage.id, file: record.id })} />
            )
        },
        {
            key: 'show',
            center: true,
            button: true,
            render: (_, record) => {
                return record.status.type === 'done' || record.status.type === 'error'
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
                columns={columns}
                dataKey="files"
                channels={{
                    listChannel: 'package.' + paymentPackage.id + '.files',
                    itemChannel: "files.{id}"
                }}
                actions={() => (
                    <AddButton href={route('payments.files.create', { package: paymentPackage.id })} />
                )}
            />
        </Layout>
    )
}
