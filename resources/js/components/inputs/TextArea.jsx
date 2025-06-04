import GroupComponent from "./GroupComponent";


export default function TextArea({ id, rows, name, label, children }) {

    id = id ?? name

    return (
        <GroupComponent name={name} label={label}>
            <textarea name={name} id={id} rows={rows}>{children}</textarea>
        </GroupComponent>
    )
}