import { usePage } from "@inertiajs/react";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

import Table from "@/components/Table";

import Edit from "./Edit";
import Create from "./Create";
import Delete from "./Delete";


export default function index() {
    const divisions = usePage().props.divisions.data
    const pagination = usePage().props.divisions.meta

    const columns = [
        {
            title: ' Код',
            dataIndex: 'code',
            width: 75,
        },
        {
            title: 'Наименование',
            dataIndex: 'name',
        },
        {
            title: '',
            key: 'edit',
            width: 80,
            render: (_, record) => (
                <Edit record={record} />
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
                rowKey="id"
                columns={columns}
                dataSource={divisions}
                current_page={pagination.current_page}
                last_page={pagination.last_page}
                from={pagination.from}
                actions={
                    <Create />
                }
            />
        </AuthenticatedLayout>
    );
}
