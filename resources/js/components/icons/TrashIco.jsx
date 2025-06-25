import RedButton from "../button/RedButton"


export default function TrashIco({ onClick }) {
    return (
        <RedButton className="ico" onClick={onClick}>
            <i className="fa-solid fa-trash ico ico-trash"></i>
        </RedButton>
    )
}