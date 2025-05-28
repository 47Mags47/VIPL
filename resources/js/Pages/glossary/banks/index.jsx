import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import Header from "../../../components/Header";

export default function index({banks}) {
    console.log(banks);
    return (
        <AuthenticatedLayout>
            <Header />
        </AuthenticatedLayout>
    );
}
