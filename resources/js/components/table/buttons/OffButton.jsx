import { router } from "@inertiajs/react"
import RedButton from "@/components/buttons/RedButton"
import { OffIco } from "@/components/icons"

export default function OffButton({ ...props }) {

    const href = props.href

    function off() {
        if (confirm('Вы уверены, что хотите отключить пользователя?'))
            router.delete(href)
    }

    return (
        <RedButton onClick={off}>
            <OffIco />
        </RedButton>
    )
}
