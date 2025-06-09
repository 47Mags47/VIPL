import { router } from '@inertiajs/react'

import Link from "@/components/Link"
import GoTo from '@/components/icons/GoTo'


export default function Show({ record }) {
    function show(record) {
        router.get(route('payments.event.packages.show', { event: record.event.id, package: record.id }));
    }
    return (
        <Link
            onClick={() => show(record)}
            name="goto"
        >
            <GoTo />
        </Link>
    )
}
