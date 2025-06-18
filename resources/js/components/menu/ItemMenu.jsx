import { Link } from '@inertiajs/react';

export default function ItemMenu({ routeName, text }) {
    const href = route(routeName);
    return (
        <Link href={href} className="menu-item">
            {text}
        </Link>
    );
}