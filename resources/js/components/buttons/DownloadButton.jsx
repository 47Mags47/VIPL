import DownloadIco from "../icons/DownloadIco";
import BlueButton from "@/components/buttons/BlueButton";

export default function DownloadButton({ ...props }) {
    const href = props.href
    const content = () => {
        return props.children
            ? props.children
            : <DownloadIco />
    }

    const request = () => location.href = href

    return (
        <BlueButton onClick={request}>
            {content()}
        </BlueButton>
    )
}
