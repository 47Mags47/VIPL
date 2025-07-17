import { usePage }                          from "@inertiajs/react"

import { AuthenticatedLayout as Layout }    from '@/layouts'
import { Table }                            from "@/components/table"


export default function Index() {
    const recipients = usePage().props.recipients

    const columns = [
        {
            title: 'Фамилия',
            dataIndex: 'last_name',
            width: 175,
        },
        {
            title: 'Имя',
            dataIndex: 'first_name',
            width: 175,
        },
        {
            title: 'Отчество',
            dataIndex: 'middle_name',
            width: 175,
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
            width: 110,
        },
        {
            title: 'СНИЛС',
            dataIndex: 'snils',
            width: 150,
        },
        {
            title: 'Счет',
            dataIndex: 'account',
            width: 190,
        },
        {
            title: 'Сумма',
            dataIndex: 'summ',
            width: 175,
        },
        {
            title: 'Паспортные данные',
            dataIndex: 'pasp',
        },
    ]
    return (
        <Layout>
            <Table
                rowKey="id"
                columns={columns}
                data={recipients}
            />
        </Layout>
    )
}
