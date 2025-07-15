import BlueButton from '@/components/buttons/BlueButton';
import { EditIco } from '@/components/icons';


export default function EditItemButton(props) {
    const className = props.className ?? ''
    const onClick = props.onClick

    return (
        <div>
            <BlueButton
                {...props}
                className={className}
                onClick={onClick}
            >
                <EditIco />
            </BlueButton>
        </div>
    );
}
