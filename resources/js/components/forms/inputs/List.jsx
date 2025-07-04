import { List as AntdList } from 'antd'
import EditableText from './EditableText'

import BlueButton from "@/components/buttons/BlueButton";
import RedButton from "@/components/buttons/RedButton";

import AddIco from '@/components/icons/AddIco'
import TrashIco from '@/components/icons/TrashIco'
import { useEffect, useRef } from 'react';


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

    const handleAdd = () => {setItems([...items, ''])}

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
                            <RedButton onClick={(e) => onDeleteClick(e, index)}>
                                <TrashIco />
                            </RedButton>
                        }
                    </AntdList.Item>
                )}
                footer={
                    <>
                        {hasAdd ??
                            <div className='add-button-container'>
                                <BlueButton
                                    type={'button'}
                                    onClick={handleAdd}
                                >
                                    <AddIco />
                                </BlueButton>
                            </div>
                        }
                    </>
                }
            />
        </div>
    )
}
