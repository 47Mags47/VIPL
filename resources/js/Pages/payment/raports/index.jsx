import { usePage, router } from "@inertiajs/react";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

import { Table, GoToButton, DeleteButton } from "@/components/table";
import BlueButton from '@/components/buttons/BlueButton';


export default function Index() {
    const { raports, event } = usePage().props

    const columns = [
        {
            title: 'id',
            dataIndex: 'id',
        },
        {
            title: ' Наименование',
            dataIndex: 'original_name',
        },
        {
            title: 'Кто начал',
            dataIndex: 'start_by',
        },
        {
            title: 'Создан',
            dataIndex: 'created_at',
            render: (value) => new Date(value).toLocaleDateString()
        },
        {
            title: '',
            key: 'show',
            width: 80,
            render: (_, record) => (
                <GoToButton href={route('payments.raports.show', { raport: record.id })} />
            )
        },
        {
            key: 'delete',
            width: 80,
            render: (_, record) => (
                <DeleteButton href={route('payments.raports.destroy', { raport: record.id })} />
            )
        },
    ]

    function raportGenerate(){
        router.post(route('payments.raports.store', { event: event.data.id }))
    }

    return (
        <AuthenticatedLayout>
            <Table
                rowKey="id"
                columns={columns}
                data={raports}
                actions={
                    <BlueButton onClick={raportGenerate}>
                        Сформировать отчет
                    </BlueButton>
                }
            />
        </AuthenticatedLayout >
    )
}
