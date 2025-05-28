import Error from "../FormError"

export default function GroupComponent({ name, children, label }) {
    return (
        <div className="form-group">
            <label htmlFor={ name }>{ label }</label>
            { children }
            <Error name={ name } />
        </div>
    )
}