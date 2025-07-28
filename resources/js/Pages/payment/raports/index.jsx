import { usePage, router } from "@inertiajs/react"

import { AuthenticatedLayout as Layout } from "@/layouts"

import { Table } from "@/components/table/echo"
import BlueButton from '@/components/buttons/BlueButton'
import DownloadButton from '@/components/buttons/DownloadButton'
import EchoProgress from "@/components/EchoProgress"
import FileZipperIco from "@/components/icons/FileZipperIco"
import FileIco from "@/components/icons/FileIco"


export default function Index() {
    const event = usePage().props.event

    const columns = [
        {
            title: '',
            width: 80,
            center: true,
            render: (_, record) => <EchoProgress
                chanel={'payment.total-raports.' + record.id}
                status={record.status.type}
            />
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
            width: 160,
            render: (_, record) => new Date(record.created_at).toLocaleString('ru-RU')
        },
        {
            title: 'Комментарий',
            dataIndex: 'comment',
            render: (_, record) => (<></>)
        },
        {
            key: 'download-bank-files',
            center: true,
            button: true,
            render: (_, record) => {
                return record.status.code === 'created'
                    ? (
                        <DownloadButton href={route('payments.bank-files.download', { raport: record.id })}>
                            <FileZipperIco />
                        </DownloadButton>
                    )
                    : ''
            }
        },
        {
            key: 'download-raport',
            center: true,
            button: true,
            render: (_, record) => {
                return record.status.code === 'created'
                    ? (
                        <DownloadButton href={route('payments.raports.download', { raport: record.id })} >
                            <FileIco />
                        </DownloadButton>
                    )
                    : ''
            }
        },
    ]

    return (
        <Layout>
            <Table
                columns={columns}
                dataKey="raports"
                channels={{
                    itemChannel: "payment.total-raports.{id}"
                }}
                actions={() => (
                    <BlueButton onClick={() => router.post(route('payments.raports.store', { event: event.data.id }))}>
                        Сформировать отчет
                    </BlueButton>
                )}
                realtime
            />
        </Layout >
    )
}
