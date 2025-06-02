import GroupComponent from "./GroupComponent";


export default function Input({ type, id, name, inputValue, placeholder, onChange, label }) {

    type = type ?? 'text'
    id = id ?? name
    placeholder = placeholder ?? ''

    return (
        <GroupComponent name={name} label={label}>
            <input type={type} id={id} name={name} value={inputValue} onChange={onChange} placeholder={placeholder} />
        </GroupComponent>
    )
}
