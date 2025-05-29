import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

/* DEV форма редактирования подразделения
    Форма отправляет PUT (POST) запрос на route('glossary.divisions.update)

    Требуемые данные:
    - code      Числовой код    => string, формата ###, где # - число
    - name      Строковый код   => string, длиной до 255 символов
*/

export default function edit(

) {
    return (
        <AuthenticatedLayout>
            <div>test react page</div>
        </AuthenticatedLayout>
    );
}
