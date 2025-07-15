import { usePage } from "@inertiajs/react";

import { AuthenticatedLayout as Layout } from '@/layouts';
import { Table, AddButton, EditButton, OffButton } from "@/components/table";


export default function Index() {
    const users = usePage().props.users

    const columns = [
        {
            title: '',
            dataIndex: 'online',
            width: 45,
            render: (_, record) => {
                let StatusColor = {
                    'new': '#f3f55c',
                    'send-invitation': '#f3f55c',
                    'send-verify': '#f3f55c',
                    'active': '#5cf561',
                    'disabled': '#f53b3b',
                }

                let status = 'disabled'
                if (record.deleted)
                    status = 'disabled'
                else
                    status = record.status.code


                return (
                    <i
                        className={"fa-solid fa-circle"}
                        style={{ color: StatusColor[status] }}
                        title={record.status.name}
                    ></i>
                )
            }
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
            width: 150,
            render: (_, record) => {
                const roleNames = record.roles?.map(role => role.name).join(', ') || '—';
                return <span>{roleNames}</span>;
            }
        },
        {
            title: '',
            key: 'delete',
            width: 80,
            render: (_, record) => (
                <OffButton href={route('main.users.destroy', {user: record.id})} />
            )
        },
        {
            title: '',
            key: 'edit',
            width: 80,
            render: (_, record) => (
                <EditButton href={route('main.users.edit', {user: record.id})} />
            )
        },
    ];

    return (
        <Layout>
            <Table
                columns={columns}
                data={users}
                actions={
                    <AddButton href={route('main.users.create')} />
                }
            />
        </Layout>
    );
}
