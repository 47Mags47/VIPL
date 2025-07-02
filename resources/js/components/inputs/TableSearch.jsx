// DELETE Компонент является устаревшим и будет удален

import { router, useForm } from '@inertiajs/react'
import { useEffect } from 'react'
import Input from '@/components/inputs/Input'


export default function TableSearch({only}) {
    const { data, setData } = useForm({
        filter: {
            search: ''
        }
    })

    function handleChange(e) {
        setData('filter.search', e.target.value)
    }

    useEffect(() => {
        const timer = setTimeout(() => {
            submit()
        }, 500)

        return () => clearTimeout(timer)
    }, [data.filter.search])

    function submit() {
        const url = new URL(window.location.href)

        for (const key of Array.from(url.searchParams.keys()).filter(k =>
            k.startsWith('filter')
        )) {
            url.searchParams.delete(key)
        }

        if (data.filter.search) {
            url.searchParams.set('filter[search]', data.filter.search)
        }

        window.history.replaceState(null, '', url.toString())

        router.reload({
            only: only,
            preserveState: true,
            replace: true
        })
    }

    return (
        <Input
            type="search"
            name="filter[search]"
            value={data.filter.search}
            onChange={handleChange}
            placeholder="Поиск..."
        />
    )
}
