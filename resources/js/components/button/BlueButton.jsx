// DELETE Компонент является устаревшим и будет удален, замена на '@/components/buttons/BlueButton'

import BaseButton from "./BaseButton"

export default function BlueButton(props) {

    return (
        <BaseButton
            {...props}
            className={"blue-button " + props.className}
        >
            {props.children}
        </BaseButton>
    )
}
