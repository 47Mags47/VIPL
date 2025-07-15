import { usePage } from "@inertiajs/react";

import { AuthenticatedLayout as Layout } from '@/layouts';
import { Table, EditButton } from "@/components/table";
import { Tooltip } from "antd";


export default function Index() {
    const columns = usePage().props.columns

    const tableColumns = [
        {
            title: 'Код',
            dataIndex: 'code',
            width: 75,
        },
        {
            title: 'Наименование',
            dataIndex: 'name',
        },
        {
            title: 'Позиция',
            dataIndex: 'file_pos',
            width: 100,
        },
        {
            title: 'Обязательное',
            dataIndex: 'required',
            width: 150,
            render: (_, record) => {
                if (record.required === 1) return 'Да'
                else return 'Нет'
            }
        },
        {
            title: 'Шаблоны',
            dataIndex: 'patterns',
            render: (_, record) => {
                if (record.patterns.length === 0)
                    return '—'

                const list = record.patterns.map((pattern, i) => (
                    <p key={i}>{pattern}</p>
                ))

                return list.length > 3
                    ? (<Tooltip title={list}>{list.slice(0, 3)}...</Tooltip>)
                    : (list)
            }
        },
        {
            title: '',
            key: 'edit',
            width: 80,
            render: (_, record) => (
                <EditButton href={route('glossary.validator.edit', { column: record.id })} />
            )
        },
    ];

    return (
        <Layout>
            <Table
                rowKey="code"
                columns={tableColumns}
                data={columns}
            />
        </Layout>
    );
}
