import Label from "./Label";


export default function StringInput({ ...props }) {
    const type = props.type ?? 'text'
    const name = props.name
    const id = props.id ?? props.name
    const label = props.label
    const value = props.value
    const placeholder = props.placeholder ?? ''
    const disabled = props.disabled
    const autoFocus = props.autoFocus ?? false

    const onChange = props.onChange
    const onBlur = props.onBlur

    return (
        <Label name={name} label={label} >
            <input
                type={type}
                id={id}
                name={name}
                value={value ?? ''}
                placeholder={placeholder}
                disabled={disabled}
                autoFocus={autoFocus}

                onChange={onChange}
                onBlur={onBlur}
            />
        </Label>
    )
}
