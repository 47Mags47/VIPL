import { router } from '@inertiajs/react'

import Link from "@/components/Link"
import GoTo from '@/components/icons/GoTo'


export default function Show({ packages, record }) {
    function show({ packages, record }) {
        router.get(route('payments.package.files.show', { package: packages.id, file: record.id }), {
            onSuccess: function (response) {
            },
        });
    }
    return (
        <Link
            onClick={() => show({ packages, record })}
            name="goto"
        >
            <GoTo />
        </Link>
    )
}
