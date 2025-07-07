import { useEffect, useRef } from 'react'

import { List as AntdList } from 'antd'
import EditableText from './EditableText'

import { CreateItemButton, DeleteItemButton } from '@/components/forms'


export default function List({
    items = [],
    setItems,
    name,
    label,
    hasDelete,
    hasAdd
}) {
    const firstUpdate = useRef(true);
    const onDeleteClick = (e, index) => {
        e.preventDefault()

        const updated = items.filter((_, i) => i !== index)
        setItems(updated)
    }

    const handleAdd = () => { setItems([...items, '']) }

    const handleChange = (e, index) => {
        const newItems = [...items]
        newItems[index] = e.target.value
        setItems(newItems)
    }

    useEffect(() => {
        if (firstUpdate.current) {
            firstUpdate.current = false;
            return
        }
    })

    return (
        <div className='list'>
            <AntdList
                header={label}
                dataSource={items}
                renderItem={(item, index) => (
                    <AntdList.Item key={index}>
                        <EditableText
                            name={name}
                            value={item}
                            index={index}
                            blurHandler={onDeleteClick}
                            handleChange={handleChange}
                            hasFocus={firstUpdate.current}
                        />
                        {hasDelete ??
                            <DeleteItemButton onClick={(e) => onDeleteClick(e, index)} />
                        }
                    </AntdList.Item>
                )}
                footer={
                    <>
                        {hasAdd ??
                            <div className='add-button-container'>
                                <CreateItemButton
                                    type={'button'}
                                    onClick={handleAdd}
                                />
                            </div>
                        }
                    </>
                }
            />
        </div>
    )
}
