import Table from '@/components/Table'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'

import { usePage } from '@inertiajs/react'

import List from '@/components/forms/inputs/List'
import { useState } from 'react'
import ListItem from '@/components/forms/inputs/ListItem'


export default function Index() {
    const config = usePage().props.config

    const [editing, setEditing] = useState(null)

    const onDeleteClick = (e, index) => {
        e.preventDefault()

        const updated = items.filter((_, i) => i !== index)
        setItems(updated)
    }
    const handleChange = (e, index) => {
        const newItems = [...items]
        newItems[index] = e.target.value
        setItems(newItems)
    }

    const columns = [
        {
            title: 'Параметр',
            dataIndex: 'key',
        },
        {
            title: 'Значение',
            dataIndex: 'value',
            render: (_, record) => (
                <ListItem
                    name={'value'}
                    value={record.value}
                    index={record.key}
                    editing={editing === record.key}
                    setEditing={(isEditing) => setEditing(isEditing ? record.key : null)}
                    onDeleteClick={onDeleteClick}
                    handleChange={handleChange}
                />
            )
        }
    ]

    return (
        <AuthenticatedLayout>
            <Table
                rowKey="key"
                columns={columns}
                dataSource={config}
            >
            </Table>
        </AuthenticatedLayout>
    )
}
