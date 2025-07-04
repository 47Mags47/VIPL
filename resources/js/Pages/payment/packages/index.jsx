import { usePage, router, Link } from "@inertiajs/react";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

import GoToButton from '@/components/table/buttons/GoToButton';
import Table from "@/components/Table";
import Show from "./Show";


export default function Index() {
    const event = usePage().props.event.data
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
            render: (value) => new Date(value).toLocaleDateString()
        },
        {
            title: 'Статус',
            dataIndex: 'status',
        },
        {
            title: 'Создан',
            dataIndex: 'created_at',
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
                     <GoToButton href={route('payments.raports.index', { event: event.id })} />
                }
            />
        </AuthenticatedLayout >
    );
}
