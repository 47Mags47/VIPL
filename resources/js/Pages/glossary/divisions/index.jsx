import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

export default function index({banks}) {
    console.log(banks);

    return (
        <AuthenticatedLayout>
            <div>test react page</div>
        </AuthenticatedLayout>
    );
}
