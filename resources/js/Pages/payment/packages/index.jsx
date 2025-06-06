import { usePage } from "@inertiajs/react";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

import Table from "@/components/Table";
import Show from "./Show";


/** payments.event.packages.index
 *
 * Выводит список пакетов
 *
 * содержить ссылку на show (payments.event.packages.show).
 * Редактирования и удаления нет.
 *
 * ____________________________________________________________________________________
 * | UUID | Подразделение | Выплата (code - krv) | На (дата) | Статус | Создан (дата) |
 * |______|_______________|______________________|___________|________|_______________|
 *
 */

export default function Index() {
    const packages = usePage().props.packages.data
    const columns = [
        {
            title: 'UUID',
            dataIndex: 'id',
        },
        {
            title: ' Подразделение',
            dataIndex: ['division', 'name'],
        },
        {
            title: 'Выплата',
            dataIndex: ['event', 'payment', 'code'],
        },
        {
            title: 'На',
            dataIndex: ['event', 'date'],
        },
        {
            title: 'Статус',
            dataIndex: 'status',
        },
        {
            title: 'Создан',
            dataIndex: 'created_at',
        },
        {
            title: '',
            key: 'show',
        render: (_, record) => (
                <Show record={record} />
            )
        },
    ]
    return (
        <AuthenticatedLayout>
            <Table
                rowKey="id"
                columns={columns}
                dataSource={packages}
            />
        </AuthenticatedLayout>
    );
}
