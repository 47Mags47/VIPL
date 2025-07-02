import BlueButton from '@/components/button/BlueButton'

export default function AddIco({ onClick }) {
    return (
        <BlueButton className="ico" onClick={onClick}>
           <i className="fa-solid fa-check"></i>
        </BlueButton>
    )
}
