export default function Label({ name, label }) {
    return (
        <label htmlFor={name}>
            {label}
        </label>
    )
}
