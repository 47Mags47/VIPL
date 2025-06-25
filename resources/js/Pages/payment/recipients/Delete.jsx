import { router } from '@inertiajs/react'

import BaseButton from "@/components/button/BaseButton"
import TrashIco from '@/components/icons/TrashIco'


export default function Delete({ files, record }) {
    function onDeleteClick({ files, record }) {
        if (confirm("Вы уверены, что хотите удалить эту запись?")) {
            router.delete(route('payments.file.recipients.destroy', { file: files.id, recipient: record.id }), { //Поменять роут
                onSuccess: function (response) {
                },
            });
        }
    }

    return (
        <BaseButton
            className="trash"
            type="button"
            onClick={() => onDeleteClick({files, record })}
        >
            <TrashIco />
        </BaseButton>
    )
}
