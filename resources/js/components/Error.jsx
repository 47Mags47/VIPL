import { usePage } from "@inertiajs/react"

export default function Error({ name }) {
    const { errors } = usePage().props

    if(name.includes('['))
        name = name.replaceAll('[', '.').replaceAll(']', '')

    return (
        <div className="form-errors">
            {errors[name] && <div>{errors[name]}</div>}
        </div>
    )
}
