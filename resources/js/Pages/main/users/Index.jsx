import { usePage } from "@inertiajs/react"

import { AuthenticatedLayout as Layout } from '@/layouts'
import { Table, AddButton, EditButton, OffButton, OnButton } from "@/components/table"
import StatusCircle                         from "@/components/StatusCircle"

export default function Index() {
    const users = usePage().props.users

    const columns = [
        {
            title: '',
            dataIndex: 'online',
            width: 45,
            render: (_, record) => (<StatusCircle title={record.status.name} color={record.status.color} />)
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
            render: (_, record) => {
                return (
                    record.deleted
                        ? <OnButton href={route('main.users.restore', { user: record.id })} />
                        : <OffButton href={route('main.users.destroy', { user: record.id })} />
                )
            }
        },
        {
            title: '',
            key: 'edit',
            width: 80,
            render: (_, record) => {
                return (
                    record.deleted
                        ? ''
                        : <EditButton href={route('main.users.edit', { user: record.id })} />
                )

            }
        }
    ]

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
    )
}
