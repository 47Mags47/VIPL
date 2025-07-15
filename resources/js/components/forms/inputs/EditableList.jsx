import List from '@/components/List'
import { EditableText, DeleteItemButton, CreateItemButton } from '@/components/forms'


export default function EditableList({ ...props }) {
    const name = props.name
    const value = props.value ?? []

    const onChange = props.onChange
    const onDelete = props.onDelete
    const onBlur = props.onBlur

    function AddHandler(e) {
        value.push('')
        onChange(value)
    }

    function changeHandler(e, index) {
        value[index] = e.target.value
        onChange(value)
    }

    function deleteHandler(e, index) {
        onChange(value.filter((_, i) => i !== index))
        if (typeof onDelete !== 'undefined')
            onDelete(e, index, value)
    }

    function blurHandler(e, index) {
        if (e.target.value === '')
            onChange(value.filter((_, i) => i !== index))
        if (typeof onBlur !== 'undefined')
            onBlur(e, index, value)
    }

    return (
        <List
            value={value}
            itemRender={(item, index) => (
                <>
                    <EditableText
                        value={item}
                        onChange={(e) => changeHandler(e, index)}
                        name={`${name}[${index}]`}
                        onBlur={(e) => blurHandler(e, index)}
                        changing={item === ''}
                    />
                    <DeleteItemButton onClick={(e) => deleteHandler(e, index)} />
                </>
            )}
            footer={() => (
                <CreateItemButton onClick={AddHandler}/>
            )}
        />
    )
}


// import { EditableText, DeleteItemButton, CreateItemButton } from '@/components/forms'


// export default function List({ ...props }) {
//     const name = props.name
//     const value = props.value ?? []

//     const onChange = props.onChange
//     const onDelete = props.onDelete
//     const onBlur = props.onBlur

//     const itemRender = props.itemRender ?? defaultItemRender

//     function AddHandler(e) {
//         value.push('')
//         onChange(value)
//     }

//     function changeHandler(e, index) {
//         value[index] = e.target.value
//         onChange(value)
//     }

//     function deleteHandler(e, index) {
//         onChange(value.filter((_, i) => i !== index))
//         if (typeof onDelete !== 'undefined')
//             onDelete(e, index, value)
//     }

//     function blurHandler(e, index) {
//         if (e.target.value === '')
//             onChange(value.filter((_, i) => i !== index))
//         if (typeof onBlur !== 'undefined')
//             onBlur(e, index, value)
//     }

//     function defaultItemRender(item, index) {
//         return (
//             <>
//                 <EditableText
//                     value={item}
//                     onChange={(e) => changeHandler(e, index)}
//                     name={`${name}[${index}]`}
//                     onBlur={(e) => blurHandler(e, index)}
//                     changing={item === ''}
//                 />
//                 <DeleteItemButton onClick={(e) => deleteHandler(e, index)} />
//             </>
//         )
//     }

//     return (
//         <div className="list-box">
//             <ul className="list">
//                 {value.map((item, index) => (
//                     <li key={index}>
//                         {itemRender(item, index)}
//                     </li>
//                 ))}
//             </ul>
//             <CreateItemButton onClick={AddHandler}/>
//         </div>
//     )
// }




















// import { useEffect, useRef }                    from 'react'

// import { List as AntdList }                     from 'antd'
// import EditableText                             from './EditableText'

// import { CreateItemButton, DeleteItemButton }   from '@/components/forms'


// export default function List({
//     items = [],
//     setItems,
//     name,
//     label,
//     hasDelete,
//     hasAdd,
//     render,
//     ...props
// }) {
//     const firstUpdate = useRef(true);
//     const onDeleteClick = (e, index) => {
//         e.preventDefault()

//         const updated = items.filter((_, i) => i !== index)
//         setItems(updated)
//     }

//     const handleAdd = () => { setItems([...items, '']) }

//     const handleChange = (e, index) => {
//         const newItems = [...items]
//         newItems[index] = e.target.value
//         setItems(newItems)
//     }

//     useEffect(() => {
//         if (firstUpdate.current) {
//             firstUpdate.current = false;
//             return
//         }
//     })

//     const defaultRender = (item, index) => {
//         return (
//             <EditableText
//                 name={name}
//                 value={item}
//                 index={index}
//                 blurHandler={onDeleteClick}
//                 handleChange={handleChange}
//                 hasFocus={firstUpdate.current}
//             />
//         )
//     }

//     return (
//         <div className={'list'}>
//             <AntdList
//                 header={label}
//                 dataSource={items}
//                 {...props}
//                 renderItem={(item, index) => (
//                     <AntdList.Item key={index}>
//                         {render ? render(item, index) : defaultRender(item, index)}
//                         {hasDelete ??
//                             <DeleteItemButton onClick={(e) => onDeleteClick(e, index)} />
//                         }
//                     </AntdList.Item>
//                 )}
//                 footer={
//                     <>
//                         {hasAdd ??
//                             <div className='add-button-container'>
//                                 <CreateItemButton
//                                     type={'button'}
//                                     onClick={handleAdd}
//                                 />
//                             </div >
//                         }
//                     </>
//                 }
//             />
//         </div >
//     )
// }
