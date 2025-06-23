import { router } from '@inertiajs/react'

import Link from "@/components/Link"
import GoTo from '@/components/icons/GoTo'


export default function Show({ packages, record }) {
    function show({ packages, record }) {
        router.get(route('payments.files.show', { file: record.id }), {
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
