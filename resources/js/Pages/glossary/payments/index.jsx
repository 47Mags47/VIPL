import { usePage } from "@inertiajs/react";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

import Table from "@/components/Table";

import Edit from "./Edit";
import Create from "./Create";
import Delete from "./Delete";


export default function index() {
    const payments = usePage().props.payments.data
    const laws = usePage().props.laws.data
    const periodicity = usePage().props.periodicityes.data
    const pagination = usePage().props.payments.meta


    const columns = [
        {
            title: 'Код',
            dataIndex: 'code',
            width: 75,
        },
        {
            title: 'Краткое наименование',
            dataIndex: 'krv',
        },
        {
            title: 'Наименование',
            dataIndex: 'name',
        },
        {
            title: 'КБК',
            dataIndex: 'kbk',
            width: 210,
        },
        {
            title: 'Закон',
            dataIndex: ['law', 'code'],
            width: 150,
        },
        {
            title: 'Периодичность',
            dataIndex: ['periodicity', 'name'],
            width: 150,
        },
        {
            title: '',
            key: 'edit',
            width: 80,
            render: (_, record) => (
                <Edit laws={laws} periodicity={periodicity} record={record} />
            )
        },
        {
            title: '',
            key: 'delete',
            width: 80,
            render: (_, record) => (
                <Delete record={record} />
            )
        },
    ];

    return (
        <AuthenticatedLayout>
            <Table
                rowKey="code"
                columns={columns}
                dataSource={payments}
                current_page={pagination.current_page}
                last_page={pagination.last_page}
                from={pagination.from}
                only={['payments']}
                actions={
                    <Create laws={laws} periodicity={periodicity} />
                }
            />
        </AuthenticatedLayout>
    );
}
