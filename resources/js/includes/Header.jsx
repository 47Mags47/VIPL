import { usePage } from '@inertiajs/react';
import { UserIco } from '@/components/icons'
import Meny from './Meny';

export default function Header() {
    const logo = 'VIPL';
    const user = usePage().props.current_user.data;

    return (
        <header>
            <h3 className="logo">{logo}</h3>
            <span className="user">
                <UserIco />
                {user.name}
            </span>
            <Meny />
        </header >
    );
}
