import { router } from '@inertiajs/react'

import TrashIco from '@/components/icons/TrashIco'


export default function Delete({ record }) {
    function onDeleteClick(record) {
        if (confirm("Вы уверены, что хотите удалить эту запись?"))
            router.delete(route('glossary.divisions.destroy', { division: record.id }))
    }

    return (
        <TrashIco onClick={() => onDeleteClick(record)} />
    )
}
