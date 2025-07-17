import { usePage } from "@inertiajs/react"

export default function Error({ name }) {
    const { errors } = usePage().props

    if (name.includes('['))
        name = name.replaceAll('[', '.').replaceAll(']', '')

    let reg = new RegExp(`(^${name}$)|(^${name}\.[0-9]{1,99}$)|(^${name}.*\.[0-9]{1,99}$)`)
    let keys = Object.keys(errors).filter((item) => reg.test(item))



    return (
        <ul className="error-list">
            {keys.map((key, i) => (
                <li key={i}>{errors[key]}</li>
            ))}
        </ul>
    )
}
