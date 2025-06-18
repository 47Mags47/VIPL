import { Link } from '@inertiajs/react';

export default function ItemMenu({ itemKey, routeName, text, method }) {
    const href = route(routeName);
    return (
        <Link
            href={href}
            method={method}
            className={"menu-item-" + itemKey }
        >
            {text}
        </Link>
    );
}