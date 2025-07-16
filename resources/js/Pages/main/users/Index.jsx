import { usePage }                                              from "@inertiajs/react"
import { useEffect, useState }                                  from "react"

import { AuthenticatedLayout as Layout }                        from '@/layouts'
import { Table, AddButton, EditButton, OffButton, OnButton }    from "@/components/table"

export default function Index() {
    const { users } = usePage().props
    const [datalUsers, setDataUsers] = useState(users)
    const [tableKey, setTableKey] = useState(0)

    useEffect(() => {
        setDataUsers(users)
        setTableKey(prev => prev + 1)
    }, [users])

    const columns = [
        {
            title: '',
            dataIndex: 'online',
            width: 45,
            render: (_, record) => {
                const StatusColor = {
                    'new': '#f3f55c',
                    'send-invitation': '#f3f55c',
                    'send-verify': '#f3f55c',
                    'active': '#5cf561',
                    'disabled': '#f53b3b',
                }

                return (
                    <i
                        className="fa-solid fa-circle"
                        style={{ color: StatusColor[record.status.code] }}
                        title={record.status.name}
                    />
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
                const roleNames = record.roles?.map(role => role.name).join(', ') || '—'
                return <span>{roleNames}</span>
            }
        },
        {
            title: '',
            key: 'delete',
            width: 80,
            render: (_, record) => {
                return record.deleted
                    ? <OnButton href={route('main.users.restore', { user: record.id })} />
                    : <OffButton href={route('main.users.destroy', { user: record.id })} />
            }
        },
        {
            title: '',
            key: 'edit',
            width: 80,
            render: (_, record) => {
                return record.deleted ? null : (
                    <EditButton href={route('main.users.edit', { user: record.id })} />
                )
            }
        }
    ]

    return (
        <Layout>
            <Table
                key={tableKey}
                columns={columns}
                data={datalUsers}
                actions={<AddButton href={route('main.users.create')} />}
            />
        </Layout>
    )
}
