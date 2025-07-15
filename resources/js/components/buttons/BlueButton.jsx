import BaseButton from "./BaseButton"

export default function BlueButton(props) {

    return (
        <BaseButton
            {...props}
            disabled={props.disabled}
            className={"blue-button " + props.className}
        >
            {props.children}
        </BaseButton>
    )
}
