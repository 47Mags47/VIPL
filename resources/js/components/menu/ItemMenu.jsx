import { Link } from '@inertiajs/react';

export default function ItemMenu({ itemKey, routeName, text, method, routeData }) {
    const href = route(routeName, routeData);

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
