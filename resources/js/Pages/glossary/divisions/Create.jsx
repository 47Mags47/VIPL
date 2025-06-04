import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

/* DEV форма создания подразделения
    Форма отправляет POST запрос на route('glossary.divisions.store)

    Требуемые данные:
    - code      Числовой код    => string, формата ###, где # - число
    - name      Строковый код   => string, длиной до 255 символов
*/

export default function create(

) {
    return (
        <AuthenticatedLayout>
            <div>test react page</div>
        </AuthenticatedLayout>
    );

}
