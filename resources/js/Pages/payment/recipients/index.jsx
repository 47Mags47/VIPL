import { usePage } from "@inertiajs/react";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

import Edit from "./Edit";
import Delete from "./Delete";
import Table from "@/components/Table";

export default function Index() {
    const recipients = usePage().props.recipients
    const columns = [
        {
            title: 'Фамилия',
            dataIndex: 'last_name',
        },
        {
            title: 'Имя',
            dataIndex: 'first_name',
        },
        {
            title: 'Отчество',
            dataIndex: 'middle_name',
        },

        {
            title: 'Дата рождения',
            dataIndex: 'd_rojd',
            render: (value, record, index) => {
                let string = new Date(value).toLocaleDateString()
                return (
                    string
                )
            },
        },
        {
            title: 'СНИЛС',
            dataIndex: 'snils',
        },
        {
            title: 'Счет',
            dataIndex: 'account',
        },
        {
            title: 'Сумма',
            dataIndex: 'summ',
        },
        {
            title: 'Паспортные данные',
            dataIndex: 'pasp',
        },
        {
            title: '',
            key: 'edit',
            // render: (_, record) => (
            //     <Edit record={record} />
            // )
        },
        {
            title: '',
            key: 'delete',
            // render: (_, record) => (
            //     <Delete record={record} />
            // )
        },
    ]
    return (
        <AuthenticatedLayout>
            <Table
                rowKey="id"
                columns={columns}
                dataSource={recipients.data}
                current_page={recipients.meta.current_page}
                last_page={recipients.meta.last_page}
                from={recipients.meta.from}
            />
        </AuthenticatedLayout>
    );
}
