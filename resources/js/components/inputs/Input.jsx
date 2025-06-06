import GroupComponent from "./GroupComponent";


export default function Input({ type, id, name, value, placeholder, onChange, label, ...props }) {

    type = type ?? 'text'
    id = id ?? name
    placeholder = placeholder ?? ''

    return (
        <GroupComponent
            name={name}
            label={label}
        >
            <input
                type={type}
                id={id}
                name={name}
                value={value ?? ''}
                onChange={onChange}
                placeholder={placeholder}
                {...props}
            />
        </GroupComponent>
    )
}
