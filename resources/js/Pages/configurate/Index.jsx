import Table from '@/components/Table'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'

import { usePage } from '@inertiajs/react'

export default function Index() {
    const config = usePage().props.config

    const columns = [
        {
            title: 'Параметр',
            dataIndex: 'key',
        },
        {
            title: 'Значение',
            dataIndex: 'value',
        }
    ]
Ф
    return (
        <AuthenticatedLayout>
            {/* <Table
                rowKey="key"
                columns={columns}
                dataSource={config}
            >
            </Table> */}

        </AuthenticatedLayout>
    )
}
