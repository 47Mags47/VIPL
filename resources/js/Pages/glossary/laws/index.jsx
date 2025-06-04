import { usePage } from "@inertiajs/react";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

import Table from "@/components/Table";

// import Edit from "./Edit";
// import Create from "./Create";
// import Delete from "./Delete";


export default function index() {
    // const banks = usePage().props.laws.data

     const columns = [
        {
            title: ' Код',
            dataIndex: 'code',
        },
        {
            title: 'Наименование',
            dataIndex: 'name',
        },
             {
            title: 'Вид финансирования',
            dataIndex: 'source_id',
        },
        // {
        //     title: '',
        //     key: 'edit',
        //     render: (_, record) => (
        //         <Edit record={record} />
        //     )
        // },
        // {
        //     title: '',
        //     key: 'delete',
        //     render: (_, record) => (
        //         <Delete record={record} />
        //     )
        // },
    ];

    return (
        <AuthenticatedLayout>
            <Table
                rowKey="id"
                columns={columns}
                // dataSource={banks}
                // actions={
                     // <Create />
                // }
            />
        </AuthenticatedLayout>
    );
}
