import Error from "@/components//Error"

export default function GroupComponent({ name, children, label, error }) {
    return (
        <div className="form-group">
            <label htmlFor={name}>{label}</label>
            {children}
            <Error name={name} />
        </div>
    )
}
