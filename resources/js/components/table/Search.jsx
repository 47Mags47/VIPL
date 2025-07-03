import { router } from "@inertiajs/react"
import { useForm } from "@inertiajs/react"
import { useEffect, useRef } from "react"

export default function Search() {
    const { data, setData } = useForm({ search: '' })
    const firstUpdate = useRef(true);

    useEffect(() => {
        if (firstUpdate.current) {
            firstUpdate.current = false;
            return
        }

        const timer = setTimeout(() => {
            let url = new URL(location.href)

            url.searchParams.delete('search')

            if (data.search !== '')
                url.searchParams.append('search', data.search)

            router.get(url.href, undefined, {
                preserveState: true,
                replace: true,
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
