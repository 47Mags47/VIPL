import { usePage } from "@inertiajs/react";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

import { CheckCircleTwoTone, CloseCircleTwoTone } from '@ant-design/icons';

import Table from "@/components/Table";

// import Edit from "./Edit";
// import Create from "./Create";
// import Delete from "./Delete";


export default function index() {
    const user = usePage().props.user.data
    const users = usePage().props.users.data
    console.log(users);


    const columns = [
        {
            title: 'Онлайн',
            dataIndex: 'online',
            width: 80,
            render: (_, record) =>
                record.online ? (
                    <CheckCircleTwoTone twoToneColor="#52c41a" />
                ) : (
                    <CloseCircleTwoTone twoToneColor="#ff4d4f" />
                ),
        },
        {
            title: 'Имя',
            dataIndex: 'name',
        },
        {
            title: 'Email',
            dataIndex: 'email',
            width: 150,
        },
        {
            title: 'Подразделение',
            dataIndex: ['division', 'name'],
            width: 150,
        },
        {
            title: 'Роли',
            dataIndex: ['roles', 'name'],
            width: 150,
            render: (_, record) => {
                const roleNames = record.roles?.map(role => role.name).join(', ') || '—';
                return <span>{roleNames}</span>;
            }
        },
        {
            title: '',
            key: 'edit',
            width: 80,
            // render: (_, record) => (
            //     <Edit sources={sources} record={record} />
            // )
        },
        {
            title: '',
            key: 'delete',
            width: 80,
            // render: (_, record) => (
            //     <Delete record={record} />
            // )
        },
    ];

    return (
        <AuthenticatedLayout>
            <Table
                rowKey="id"
                columns={columns}
                dataSource={users}
            // actions={
            //     // <Create sources={sources} />
            // }
            />
        </AuthenticatedLayout>
    );
}
