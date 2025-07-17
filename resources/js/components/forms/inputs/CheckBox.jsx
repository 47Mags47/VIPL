import FormGroup    from "./FormGroup"
import Label        from "./Label"


export default function CheckBox({ ...props }) {
    const name = props.name
    const id = props.id ?? props.name
    const label = props.label
    const value = props.value
    const onChange = props.onChange
    const disabled = props.disabled

    return (
        <FormGroup name={"inline"}>
            <input
                type="checkbox"
                id={id}
                name={name}
                value={value ?? ''}
                onChange={onChange}
                disabled={disabled}
            />
            <Label label={label} />
        </FormGroup>
    )
}
