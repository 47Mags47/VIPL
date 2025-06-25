import BlueButton from '@/components/button/BlueButton'

export default function EditIco({onClick}) {
    return(
        <BlueButton className="ico" onClick={onClick}>
            <i className="fa-solid fa-pen ico ico-edit"></i>
        </BlueButton>
    )
}