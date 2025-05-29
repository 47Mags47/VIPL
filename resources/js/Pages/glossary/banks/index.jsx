import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import TableComponent from "../../../components/table/Table";

export default function index({banks}) {
    console.log(banks);
    return (
        <AuthenticatedLayout>
            <TableComponent />
        </AuthenticatedLayout>
    );
}
