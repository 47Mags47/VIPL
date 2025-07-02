import { usePage, router, Link } from "@inertiajs/react";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

import BlueButton from '@/components/button/BlueButton';
import Table from "@/components/Table";


export default function Index() {
    const event = usePage().props.event.data

    function GenerateRaport(e){
        router.post(route('payments.raports.store', {event: event.id}))
    }

    return (
        <AuthenticatedLayout>
            <Table
                actions={
                    <BlueButton onClick={GenerateRaport}>Сформировать</BlueButton>
                }
            />
        </AuthenticatedLayout >
    )
}
