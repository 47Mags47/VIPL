import BlueButton from '@/components/buttons/BlueButton';
import AddIco from '@/components/icons/AddIco';


export default function CreateItemButton(props) {
    const className = props.className ?? ''
    const onClick = props.onClick

    return (
        <div>
            <BlueButton
                {...props}
                className={className}
                onClick={onClick}
            >
                <AddIco />
            </BlueButton>
        </div>
    );
}
