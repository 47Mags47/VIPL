import { useState }         from 'react'

import { List as AntdList } from 'antd'
import ListItem             from './ListItem'

import BlueButton           from '@/components/buttons/BlueButton'
import AddIco               from '@/components/icons/AddIco'


export default function List({
    items = [],
    setItems,
    name,
    label,
}) {

    const [editing, setEditing] = useState(null)

    const onDeleteClick = (e, index) => {
        e.preventDefault()

        const updated = items.filter((_, i) => i !== index)
        setItems(updated)
    }

    const handleAdd = () => {
        const newIndex = items.length
        setItems([...items, ''])
        setEditing(newIndex)
    }

    const handleChange = (e, index) => {
        const newItems = [...items]
        newItems[index] = e.target.value
        setItems(newItems)
    }

    return (
        <div className='list'>
            <AntdList
                header={label}
                dataSource={items}
                renderItem={(item, index) => (
                    <AntdList.Item key={index}>
                        <ListItem
                            name={name}
                            value={item}
                            index={index}
                            editing={editing === index}
                            setEditing={(isEditing) => setEditing(isEditing ? index : null)}
                            onDeleteClick={onDeleteClick}
                            handleChange={handleChange}
                        />
                    </AntdList.Item>
                )}
            />
            <div className='add-button-container'>
                <BlueButton
                    type={'button'}
                    onClick={handleAdd}
                >
                    <AddIco />
                </BlueButton>
            </div>
        </div>
    )
}
