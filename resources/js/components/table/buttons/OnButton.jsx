import { router } from "@inertiajs/react"
import BlueButton from "@/components/buttons/BlueButton"
import { OffIco } from "@/components/icons"

export default function OnButton({ ...props }) {

    const href = props.href

    function on() {
        if (confirm('Вы уверены, что хотите восстановить?'))
            router.post(href)
    }

    return (
        <BlueButton onClick={on}>
            <OffIco />
        </BlueButton>
    )
}
