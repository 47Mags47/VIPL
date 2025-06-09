import { router } from '@inertiajs/react'

import BaseButton from "@/components/button/BaseButton"
import Trash from '@/components/icons/Trash'


export default function Delete({ files, record }) {
    function onDeleteClick({ files, record }) {
        if (confirm("Вы уверены, что хотите удалить эту запись?")) {
            router.delete(route('payments.file.recipients.destroy', { file: files.id, recipient: record.id }), { //Поменять роут
                onSuccess: function (response) {
                    // showFlash() // [ ] front добавить глобальный хелпер для вывода сообщения из Flash хранилища
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
            <Trash />
        </BaseButton>
    )
}
