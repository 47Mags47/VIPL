import { usePage, router, useForm } from "@inertiajs/react";

import { useState } from "react";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

import { Table } from "@/components/table";
import BlueButton from '@/components/buttons/BlueButton';
import DownloadButton from '@/components/buttons/DownloadButton';
import EchoProgress from '@/components/EchoProgress';
import EditableText from '@/components/forms/inputs/EditableText';


export default function Index() {
    const { raports, event } = usePage().props

   const { data, setData, put } = useForm({
    comment: raports.id
   })

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
            render: (value) => new Date(value).toLocaleString('ru-RU', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            })
        },
        {
            title: 'Комментарий',
            dataIndex: 'comment',
            render: (_, record) => (
                <>
                    <EditableText
                        name={record.name}
                        index={record.id}
                        value={data.comment}
                        handleChange={(e) => setData(e.target.value)}
                        // blurHandler={put(route(''), data)}
                    />
                </>
            )
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
