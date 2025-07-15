import { router } from "@inertiajs/react"
import RedButton from "@/components/buttons/RedButton"
import { TrashIco } from "@/components/icons"

export default function DeleteButton({ ...props }) {

    const href = props.href

    function destroy() {
        if (confirm('Вы уверены, что хотите удалить запись?'))
            router.delete(href)
    }

    return (
        <RedButton onClick={destroy}>
            <TrashIco />
        </RedButton>
    )
}
