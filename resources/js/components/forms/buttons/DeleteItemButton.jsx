import RedButton    from "@/components/buttons/RedButton";
import TrashIco     from '@/components/icons/TrashIco'


export default function DeleteItemButton(props) {
    const className = props.className ?? ''
    const onClick = props.onClick

    return (
        <div>
            <RedButton
                {...props}
                className={className}
                onClick={onClick}
            >
                <TrashIco />
            </RedButton>
        </div>
    );
}
