import BaseButton from "@/components/button/BaseButton"

import { router } from '@inertiajs/react'

import Trash from '@/components/icons/Trash'

export default function Delete({ record }) {
    function onDeleteClick(record) {
        if (confirm("Вы уверены, что хотите удалить эту запись?")) {
            router.delete(route('glossary.banks.delete', { bank: record.id }), {
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
            onClick={() => onDeleteClick(record)}
        >
            <Trash />
        </BaseButton>
    )
}
