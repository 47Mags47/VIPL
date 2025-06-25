import { router } from '@inertiajs/react'

import TrashIco from '@/components/icons/TrashIco'


export default function Delete({ packages, record }) {
    function onDeleteClick({ packages, record }) {
        if (confirm("Вы уверены, что хотите удалить эту запись?")) 
            router.delete(route('payments.package.files.destroy', { package: packages.id, file: record.id }));
        }

    return (
        <TrashIco onClick={() => onDeleteClick(packages, record)} />
    )
}
