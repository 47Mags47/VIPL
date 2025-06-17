import { router } from '@inertiajs/react'

import BaseButton from "@/components/button/BaseButton"
import Trash from '@/components/icons/Trash'


export default function Delete({ packages, record }) {
    function onDeleteClick({ packages, record }) {
        if (confirm("Вы уверены, что хотите удалить эту запись?")) {
            router.delete(route('payments.package.files.destroy', { package: packages.id, file: record.id }), {
                onSuccess: function (response) {
                },
            });
        }
    }

    return (
        <BaseButton
            className="trash"
            type="button"
            onClick={() => onDeleteClick({ packages, record })}
        >
            <Trash />
        </BaseButton>
    )
}
