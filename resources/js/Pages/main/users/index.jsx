import { usePage } from "@inertiajs/react";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

import Table from "@/components/Table";

import Edit from "./Edit";
import Create from "./Create";
import Delete from "./Delete";


export default function index() {
    const laws = usePage().props.laws.data
    const sources = usePage().props.sources.data


    const columns = [
        {
            title: ' Код',
            dataIndex: 'code',
            width: 80,
        },
        {
            title: 'Наименование',
            dataIndex: 'name',
        },
        {
            title: 'Вид финансирования',
            dataIndex: ['source', 'name'],
            width: 150,
        },
        {
            title: '',
            key: 'edit',
            width: 80,
            render: (_, record) => (
                <Edit sources={sources} record={record} />
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
                dataSource={laws}
                actions={
                    <Create sources={sources} />
                }
            />
        </AuthenticatedLayout>
    );
}
