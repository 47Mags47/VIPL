import { router } from '@inertiajs/react'

import TrashIco from '@/components/icons/TrashIco'


export default function Delete({ record }) {
    function onDeleteClick(record) {
        if (confirm("Вы уверены, что хотите удалить эту запись?")) 
            router.delete(route('main.users.destroy', { user: record.id }));
    }

    return (
        <TrashIco onClick={() => onDeleteClick(record)} />
    )
}
