import BaseButton from "./BaseButton"

export default function BlueButton({type, children, onClick}) {
    return (
        <BaseButton type={type} className={'blue-button'} onClick={onClick}>
            {children}
        </BaseButton>
    )
}