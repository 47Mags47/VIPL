import { usePage } from "@inertiajs/react";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

import Table from "@/components/Table";
import Show from "./Show";
import Delete from "./Delete";
import Create from "./Create";

/** payments.package.files.index
 *
 * Выводит список файлов
 *
 * содержить ссылку на show (payments.package.files.show).
 * ______________________________________________________________________________
 * | Нименование | Статус | Получателей | На сумму | контрольная сумма | размер |
 * |_____________|________|_____________|__________|___________________|________|
 *
 */

export default function Index() {
    const files = usePage().props.files.data
    const packages = usePage().props.package.data
    const pagination = usePage().props.files.meta

    const columns = [
        {
            title: 'Нименование',
            dataIndex: 'name',
        },
        {
            title: 'Статус',
            dataIndex: 'status',
        },
        {
            title: 'Получателей',
            dataIndex: 'recipients',
        },

        {
            title: 'На сумму (руб)',
            dataIndex: 'summ',
        },

        {
            title: 'Контрольная сумма',
            dataIndex: 'hash',

        },
        {
            title: 'Размер',
            dataIndex: 'size',
        },
        {
            title: '',
            key: 'show',
            render: (_, record) => (
                <Show packages={packages} record={record} />
            )
        },
        {
            title: '',
            key: 'delete',
            render: (_, record) => (
                <Delete packages={packages} record={record} />
            )
        },
    ]
    return (
        <AuthenticatedLayout>
            <Table
                rowKey="id"
                columns={columns}
                dataSource={files}
                current_page={pagination.current_page}
                last_page={pagination.last_page}
                from={pagination.from}
                actions={
                    <Create />
                }
            />
        </AuthenticatedLayout>
    );
}
