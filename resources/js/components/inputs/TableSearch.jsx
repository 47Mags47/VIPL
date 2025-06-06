import { useEffect, useState, useRef } from 'react';
import { router } from '@inertiajs/react';

import handleChange from '@/handles/input/handleChange';
import Input from '@/components/inputs/Input'


export default function TableSearch() {
    const firstUpdate = useRef(true);
    const [value, setValue] = useState({
        filter: { search: new URL(location.href).searchParams.get('filter[search]') ?? '' }
    })

    useEffect(() => {
        if (firstUpdate.current)
            firstUpdate.current = false;
        else {
            const timer = setTimeout(() => {
                searchSubmit()
            }, 1000);

            return () => clearTimeout(timer);
        }
    }, [value])

    function searchSubmit() {
        if (value.filter.search == '')
            router.get(location.origin + location.pathname, {}, { preserveState: true, replace: true })
        else
            router.get(location.href, value, { preserveState: true, replace: true })
    }

    return (
        <>
            <Input
                type="search"
                name="filter[search]"
                value={value.filter.search}
                onChange={(e) => handleChange(e, value, setValue)}
                placeholder='Найти...'
                autoComplete='off'
            />
        </>
    )
}
