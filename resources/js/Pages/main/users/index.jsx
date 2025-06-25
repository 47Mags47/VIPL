import { usePage } from "@inertiajs/react";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

import Table from "@/components/Table";

import Edit from "./Edit";
import Create from "./Create";
import Delete from "./Delete";


export default function index() {
    const users = usePage().props.users.data
    const divisions = usePage().props.divisions.data
    const roles = usePage().props.roles.data
    const pagination = usePage().props.users.meta


    const columns = [
        {
            title: '',
            dataIndex: 'online',
            width: 45,
            render: (_, record) =>
                record.online ? (
                    <i className="fa-solid fa-circle online"></i>
                ) : (
                    <i className="fa-solid fa-circle ofline"></i>
                ),
        },
        {
            title: 'Имя',
            dataIndex: 'name',
        },
        {
            title: 'Email',
            dataIndex: 'email',
            
        },
        {
            title: 'Подразделение',
            dataIndex: ['division', 'name'],
            
        },
        {
            title: 'Роли',
            dataIndex: ['roles', 'name'],
            render: (_, record) => {
                const roleNames = record.roles?.map(role => role.name).join(', ') || '—';
                return <span>{roleNames}</span>;
            }
        },
        {
            title: '',
            key: 'edit',
            width: 80,
            render: (_, record) => (
                <Edit roles={roles} divisions={divisions} record={record}/>
            )
        },
        {
            title: '',
            key: 'delete',
            width: 80,
            render: (_, record) => (
                <Delete record={record }/>
            )
        },
    ];

    return (
        <AuthenticatedLayout>
            <Table
                rowKey="id"
                columns={columns}
                dataSource={users}
                current_page={pagination.current_page}
                last_page={pagination.last_page}
                from={pagination.from}
                actions={
                    <Create roles={roles} divisions={divisions} />
                }
            />
        </AuthenticatedLayout>
    );
}
