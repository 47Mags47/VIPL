import BaseButton from "./BaseButton"

export default function BlueButton({type, children, onClick, buttonName}) {
    return (
        <BaseButton type={type} className={"blue-button " +(buttonName ?? '')} onClick={onClick}>
            {children}
        </BaseButton>
    )
}