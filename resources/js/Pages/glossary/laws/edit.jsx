import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

/* DEV форма редактирования закона
    Форма отправляет PUT (POST) запрос на route('glossary.laws.update)

    Требуемые данные:
    - code          Строковый код       => string, длиной до 50 символов
    - name          Наименование        => string
    - source_id     Вид финансирования  => int, id вида фининсирования, объект приходит с бэка sources
*/

export default function edit(

) {
    return (
        <AuthenticatedLayout>
            <div>test react page</div>
        </AuthenticatedLayout>
    );

}
