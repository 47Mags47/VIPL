import BaseButton from "./BaseButton"


export default function RedButton(props) {

    return (
        <BaseButton
            {...props}
            className={"red-button " + props.className}
        >
            {props.children}
        </BaseButton>
    )
}
