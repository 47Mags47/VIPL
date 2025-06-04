import { usePage } from "@inertiajs/react";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

import Table from "@/components/Table";

import Edit from "./Edit";
import Create from "./Create";
import Delete from "./Delete";


export default function index() {
    const payments = usePage().props.payments.data


    const columns = [
        {
            title: 'Код',
            dataIndex: 'code',
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
        },
        {
            title: 'Закон',
            dataIndex: ['law', 'name'],
        },
        {
            title: 'Периодичность',
            dataIndex: ['periodicity', 'name'],
        },
        {
            title: '',
            key: 'edit',
            render: (_, record) => (
                <Edit record={record} />
            )
        },
        {
            title: '',
            key: 'delete',
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
                actions={
                    <Create />
                }
            />
        </AuthenticatedLayout>
    );
}
