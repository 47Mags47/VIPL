import { usePage }                      from "@inertiajs/react"

import {AuthenticatedLayout as Layout}  from "@/layouts"

import Table                            from "@/components/table/Table"

import Edit                             from "./Edit"
import Create                           from "./Create"
import Delete                           from "./Delete"


export default function DivisionIndex() {
    const users = usePage().props.users.data
    const roles = usePage().props.roles.data
    const pagination = usePage().props.users.meta

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
            title: 'Роли',
            dataIndex: ['roles', 'name'],
            render: (_, record) => {
                const roleNames = record.roles?.map(role => role.name).join(', ') || '—';
                return <span>{roleNames}</span>;
            }
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
        // {
        //     title: '',
        //     key: 'edit',
        //     width: 80,
        //     render: (_, record) => (
        //         <Edit roles={roles} division={users.division} record={record} />
        //     )
        // },
    //     {
    //         title: '',
    //         key: 'delete',
    //         width: 80,
    //         render: (_, record) => (
    //             <Delete record={record} />
    //         )
    //     },
    ]

    return (
        <Layout>
            <Table
                rowKey="id"
                columns={columns}
                dataSource={users}
                current_page={pagination.current_page}
                last_page={pagination.last_page}
                from={pagination.from}
                // actions={
                    // <Create roles={roles} division={users.division} />
                // }
            />
        </Layout>
    )
}
