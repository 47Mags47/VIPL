import Label from "./Label";


export default function StringInput({ ...props }) {
    const id = props.id ?? props.name
    const name = props.name
    const label = props.label
    const value = props.value
    const placeholder = props.placeholder ?? ''
    const onChange = props.onChange

    return (
        <Label
            name={name}
            label={label}
        >
            <textarea
                id={id}
                name={name}
                value={value ?? ''}
                onChange={onChange}
                placeholder={placeholder}
            />
        </Label>
    )
}
