import { usePage, router } from "@inertiajs/react";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

import { Table } from "@/components/table";
import BlueButton from '@/components/buttons/BlueButton';
import DownloadButton from '@/components/buttons/DownloadButton';
import EchoProgress from '@/components/EchoProgress';


export default function Index() {
    const { raports, event } = usePage().props

    const columns = [
        {
            title: 'Статус',
            dataIndex: 'status',
            width: 80,
            render: (_, record) => {
                return (
                    <EchoProgress
                        chanel={`raports.${record.id}`}
                        event='.update'
                        type="circle"
                        status={record.status.type}
                        size={35}
                    />
                )
            }
        },
        {
            title: ' Наименование',
            dataIndex: 'name',
            width: 350,
        },
        {
            title: 'Запустил',
            dataIndex: ['start_by', 'name'],
            width: 250,
        },
        {
            title: 'Создан',
            dataIndex: 'created_at',
            width: 100,
            render: (value) => new Date(value).toLocaleDateString()
        },
        {
            title: 'Комментарий',
            dataIndex: 'comment',
            render: (_, record) => (<></>)
        },
        {
            title: '',
            key: 'download-bank-files',
            width: 80,
            render: (_, record) => {
                return record.status.code === 'created'
                    ? (
                        <DownloadButton href={route('payments.bank-files.download', { raport: record.id })}>
                            <i className="fa-solid fa-folder"></i>
                        </DownloadButton>
                    )
                    : ''
            }
        },
        {
            title: '',
            key: 'download-raport',
            width: 80,
            render: (_, record) => {
                return record.status.code === 'created'
                    ? (<DownloadButton href={route('payments.raports.download', { raport: record.id })} />)
                    : ''
            }
        },
    ]

    return (
        <AuthenticatedLayout>
            <Table
                rowKey="id"
                columns={columns}
                data={raports}
                actions={
                    <BlueButton onClick={() => router.post(route('payments.raports.store', { event: event.data.id }))}>
                        Сформировать отчет
                    </BlueButton>
                }
            />
        </AuthenticatedLayout >
    )
}
