import { router } from '@inertiajs/react'

import BaseButton from "@/components/button/BaseButton"
import Trash from '@/components/icons/Trash'


export default function Delete({ record }) {
    function onDeleteClick(record) {
        if (confirm("Вы уверены, что хотите удалить эту запись?")) {
            router.delete(route('glossary.banks.destroy', { bank: record.id }), {
                onFinish: function () {
                }
            });
        }
    }

    return (
        <>
            <BaseButton
                className="trash"
                type="button"
                onClick={() => onDeleteClick(record)}
            >
                <Trash />
            </BaseButton>
        </>
    )
}
