import { usePage } from "@inertiajs/react"

export default function Error({ name }) {
    const errors = usePage().props.errors

    const hasError = () => {
        if (name in errors) {
            return (
                <div className="form-errors">
                    <span>{errors[name]}</span>
                </div>
                
            )
                
        }else {
            return null;
        }        
    }
    console.log(hasError);

    return (
        hasError()
    )
}