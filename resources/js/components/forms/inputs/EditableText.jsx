import { useEffect, useState, useRef }  from 'react'

import Error                            from '@/components/Error'
import { StringInput as Input }         from '@/components/forms'


export default function EditableText({ ...props }) {
    const value = props.value ?? ''
    const index = props.index
    const blurHandler = props.blurHandler
    const onChange = props.handleChange
    const name = props.name
    const hasFocus = props.hasFocus

    const [editing, setEditing] = useState(true)
    const firstUpdate = useRef(true);

    const onBlur = (e) => {
        if (e.target.value.trim() == '')
            blurHandler(e, index)

        setEditing(false)
    }

    const spanRender = () => (
        <div className="label-list span">
            <span>{value || '...'}</span>
            <Error name={`${name}.${index}`} />
        </div>
    )

    const inputRender = () => (
        <Input
            name={`${name}[${index}]`}
            value={value}
            onChange={(e) => onChange(e, index)}
            onBlur={onBlur}
            placeholder="Введите значение"
            autoFocus
        />
    )

    const render = () => editing ? inputRender() : spanRender()

    useEffect(() => {
        if (firstUpdate.current && hasFocus) {
            firstUpdate.current = false;
            setEditing(false)
            return
        }
    }, [editing])

    return (
        <div
            className="list-item"
            onDoubleClick={() => { setEditing(true) }}
        >
            <div className="left">
                {render()}
            </div>
        </div>
    )
}
