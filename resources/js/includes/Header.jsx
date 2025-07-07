import { usePage } from '@inertiajs/react';

import Meny from './Meny';

export default function Header() {
    const logo = 'VIPL';
    const user = usePage().props.user.data;

    return (
        <header>
            <h3 className="logo">{logo}</h3>
            <span className="user">
                <i className="fa-solid fa-user ico user-ico"></i>
                {user.name}
            </span>
            <Meny />
        </header >
    );
}
