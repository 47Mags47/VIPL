import { useState, useEffect, useRef } from 'react'
import { usePage, router } from '@inertiajs/react'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'

import BlueButton from "@/components/buttons/BlueButton";
import EditableText from '@/components/forms/inputs/EditableText'
import Table from '@/components/Table';


export default function Index() {
    const config = usePage().props.config

    const [items, setItems] = useState([...config])

    const firstUpdate = useRef(true)

    useEffect(() => {
        if (firstUpdate.current) {
            firstUpdate.current = false;
            return
        }
    })

    const handleChange = (e, index) => {
        const newItems = [...items]
        newItems[index].value = e.target.value
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
            render: (_, record, index) => (
                <EditableText
                    name={'value'}
                    value={record.value}
                    index={index}
                    handleChange={handleChange}
                    hasFocus={firstUpdate.current}
                />
            )
        }
    ]

    function onSubmit(e) {
        e.preventDefault()

        router.put(route('configurate.update'), items)
    }

    return (
        <AuthenticatedLayout>
            <Table
                rowKey="key"
                columns={columns}
                dataSource={config}
                actions={
                    <BlueButton className={"save-config"} onClick={onSubmit}>
                        Сохранить
                    </BlueButton>
                }
            >
            </Table>
        </AuthenticatedLayout>
    )
}
