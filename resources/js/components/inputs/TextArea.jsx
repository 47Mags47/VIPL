import Label from "../forms/inputs/Label";


export default function TextArea({ id, rows, name, label, value, onChange }) {

    id = id ?? name

    return (
        <Label
            name={name}
            label={label}
        >
            <textarea
                name={name}
                id={id}
                value={value}
                rows={rows}
                onChange={onChange}
            >
                {/* {value} */}
            </textarea>
        </Label>
    )
}
