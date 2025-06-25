import { usePage, router } from "@inertiajs/react";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

import BlueButton from '@/components/button/BlueButton';
import Table from "@/components/Table";
import Show from "./Show";


export default function Index() {
    const packages = usePage().props.packages.data
    const pagination = usePage().props.packages.meta

    function onSubmit(e) {
        e.preventDefault()
        router.post(route('payments.raports.store'))
    }

    const columns = [
        {
            title: 'UUID',
            dataIndex: 'id',
        },
        {
            title: ' Подразделение',
            dataIndex: ['division', 'name'],
        },
        {
            title: 'Выплата',
            dataIndex: ['event', 'payment', 'code'],
        },
        {
            title: 'На',
            dataIndex: ['event', 'date'],
            render: (value, record, index) => {
                let string = new Date(value).toLocaleDateString()
                return (
                    string
                )
            },
        },
        {
            title: 'Статус',
            dataIndex: 'status',
        },
        {
            title: 'Создан',
            dataIndex: 'created_at',
        },
        {
            title: '',
            key: 'show',
            width: 80,
            render: (_, record) => (
                <Show record={record} />
            )
        },
    ]
    return (
        <AuthenticatedLayout>
            <Table
                rowKey="id"
                columns={columns}
                dataSource={packages}
                current_page={pagination.current_page}
                last_page={pagination.last_page}
                from={pagination.from}
                actions={
                    <BlueButton
                        type="submit"
                        form="payments-report"
                        onClick={onSubmit}

                    >
                        Выгрузить отчет
                    </BlueButton>
                }
            />
        </AuthenticatedLayout >
    );
}
