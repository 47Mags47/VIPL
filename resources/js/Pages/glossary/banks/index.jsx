import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

export default function index({banks}) {
    console.log(banks);
    return (
        <AuthenticatedLayout>
            <p>test</p>
        </AuthenticatedLayout>
    );
}
