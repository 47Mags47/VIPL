import BaseButton from "@/components/button/BaseButton"

import { router } from '@inertiajs/react'

export default function Delete({ record }) {
    function onDeleteClick(record) {
        if (confirm("Вы уверены, что хотите удалить эту запись?")) {
            router.delete(route('glossary.laws.delete', { law: record.id }), {
                onSuccess: function (response) {
                    // showFlash() // [ ] front добавить глобальный хелпер для вывода сообщения из Flash хранилища
                },
            });
        }
    }

    return (
        <BaseButton type="button" onClick={() => onDeleteClick(record)}>
            удалить
        </BaseButton>
    )
}
