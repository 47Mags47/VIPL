import { usePage } from "@inertiajs/react";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

import Table from "@/components/Table";

import Edit from "./Edit";
import Create from "./Create";
import Delete from "./Delete";


export default function Index() {
    const users = usePage().props.users.data
    const divisions = usePage().props.divisions.data
    const roles = usePage().props.roles.data
    const pagination = usePage().props.users.meta

    const StatusColor = {
        'new': '#f3f55c',
        'send-invitation': '#f3f55c',
        'send-verify': '#f3f55c',
        'active': '#5cf561',
        'disabled': '#f53b3b',
    }

    const columns = [
        {
            title: '',
            dataIndex: 'online',
            width: 45,
            render: (_, record) =>
                <i
                    className={"fa-solid fa-circle"}
                    style={{ color: StatusColor[record.status.code] }}
                    title={record.status.name}
                ></i>
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
            title: 'Подразделение',
            dataIndex: ['division', 'id'],
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
            render: (_, record) => (
                <Edit roles={roles} divisions={divisions} record={record} />
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
