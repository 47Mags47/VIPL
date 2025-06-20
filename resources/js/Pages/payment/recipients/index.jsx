import { usePage } from "@inertiajs/react";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

import Edit from "./Edit";
import Delete from "./Delete";
import Table from "@/components/Table";


// import Show from "./Show";
// import Delete from "./Delete";
// import Create from "./Create";

/** payments.file.recipients.index
 *
 * Страница только для администраторов
 *
 * Выводит список получателей
 * _______________________________________________________________________________________
 * | Фамилия | Имя | Отчество | Дата рождения | СНИЛС | Счет | Сумма | Паспортные данные |
 * |_________|_____|__________|_______________|_______|______|_______|___________________|
 *
 */

export default function Index() {
    const recipients = usePage().props.recipients.data
    // const files = usePage().props.files.data
    const pagination = usePage().props.recipients.meta
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
            render: (_, record) => (
                <Edit record={record} />
            )
        },
        {
            title: '',
            key: 'delete',
            render: (_, record) => (
                <Delete record={record} />
            )
        },
    ]
    return (
        <AuthenticatedLayout>
            <Table
                rowKey="id"
                columns={columns}
                dataSource={recipients}
                current_page={pagination.current_page}
                last_page={pagination.last_page}
                from={pagination.from}
            />
        </AuthenticatedLayout>
    );
}