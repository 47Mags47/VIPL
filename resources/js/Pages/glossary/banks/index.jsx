import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import Header from "../../../components/Header";
import AuthForm from "../../../components/AuthForm";
export default function index({banks}) {
    console.log(banks);
    return (
        <AuthenticatedLayout>
            <Header />
        </AuthenticatedLayout>
    );
}
