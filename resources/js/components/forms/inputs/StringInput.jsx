import Label from "./Label";


export default function StringInput({ ...props }) {
    const type = props.type ?? 'text'
    const name = props.name
    const id = props.id ?? props.name
    const label = props.label
    const value = props.value
    const placeholder = props.placeholder ?? ''
    const onChange = props.onChange
    const disabled = props.disabled

    return (
        <Label name={name} label={label} >
            <input
                type={type}
                id={id}
                name={name}
                value={value ?? ''}
                onChange={onChange}
                placeholder={placeholder}
                disabled={disabled}
            />
        </Label>
    )
}
