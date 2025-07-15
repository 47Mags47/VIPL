import { useEffect, useState, useRef } from 'react'

import Error from '@/components/Error'
import { StringInput as Input } from '@/components/forms'


export default function EditableText({ ...props }) {
    const value = props.value ?? ''
    const index = props.index
    const onChange = props.onChange
    const name = props.name

    const BlurHandler = props.BlurHandler ?? function(){}
    const DoubleClickHandler = props.DoubleClickHandler ?? function(){}

    const [changing, setСhanging] = useState(props.changing ?? false)


    const render = () => changing
        ? (
            <Input
                name={`${name}[${index}]`}
                value={value}
                onChange={(e) => onChange(e, index)}
                placeholder="Введите значение"
                onBlur={(e) => {setСhanging(false); BlurHandler(e)}}
                autoFocus
            />
        )
        : (
            <div className="label-input span" onDoubleClick={(e) => {setСhanging(true); DoubleClickHandler(e)}}>
                <span>{value || '...'}</span>
                <Error name={`${name}.${index}`} />
            </div>
        )

    return (
        render()
    )
}
