import { usePage } from "@inertiajs/react";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

import Table from "@/components/Table";

import Edit from "./Edit";
import Create from "./Create";
import Delete from "./Delete";


export default function index() {
    const banks = usePage().props.banks.data
    const exporter = usePage().props.exporters.data
    const division = usePage().props.division_sides.data

    const columns = [
        {
            title: 'Числовой код',
            dataIndex: 'number_code',
        },
        {
            title: 'Строковый код',
            dataIndex: 'code',
        },
        {
            title: 'Наименование',
            dataIndex: 'name',
        },
        {
            title: 'Экспортер',
            dataIndex: ['exporter', 'name'],
        },
        {
            title: 'Номер контракта',
            dataIndex: ['contract', 'number'],
        },
        {
            title: 'Дата заключения',
            dataIndex: ['contract', 'signed_at'],
            render: (value, record, index) => {
                let string = new Date(value).toLocaleDateString()
                return (
                    string
                )
            },
        },

        {
            title: 'Сторона организации',
            dataIndex: ['contract', 'division_side', 'name'],
        },
        {
            title: 'Наименование',
            dataIndex: ['contract', 'division_side', 'name'],
        },
        {
            title: 'ИНН',
            dataIndex: ['contract', 'division_side', 'INN'],
        },
        {
            title: 'Счет',
            dataIndex: ['contract', 'division_side', 'account'],
        },
        {
            title: 'БИК',
            dataIndex: ['contract', 'division_side', 'BIK'],
        },
        {
            title: 'Комментарий',
            dataIndex: ['contract', 'division_side', 'comment'],
        },
        {
            title: '',
            key: 'edit',
            width: 80,
            render: (_, record) => (
                <Edit division={division} exporter={exporter} record={record} />
            )
        },
        {
            title: '',
            key: 'delete',
            width: 80,
            render: (_, record) => (
                <Delete record={record} />
            )
        },
    ];

    return (
        <AuthenticatedLayout>
            <Table
                rowKey="id"
                columns={columns}
                dataSource={banks}
                actions={
                    <Create division={division} exporter={exporter} />
                }
            />
        </AuthenticatedLayout>
    );
}
