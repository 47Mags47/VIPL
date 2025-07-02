import { router } from "@inertiajs/react"
import { useForm } from "@inertiajs/react"
import { useEffect } from "react"

export default function Search() {
    const { data, setData } = useForm({ search: new URL(location.href).searchParams.get('search') ?? '' })

    useEffect(() => {
        const timer = setTimeout(() => {
            router.get(location.href, data, {
                preserveState: true,
                replace: true
            })
        }, 700)

        return () => clearTimeout(timer)
    }, [data.search])


    return (
        <input
            type="search"
            name="search"
            value={data.search}
            onChange={e => setData('search', e.target.value)}
            placeholder="Поиск..."
        />
    )
}
