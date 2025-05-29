import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

/* DEV форма создания закона
    Форма отправляет POST запрос на route('glossary.laws.store)

    Требуемые данные:
    - code          Строковый код       => string, длиной до 50 символов
    - name          Наименование        => string
    - source_id     Вид финансирования  => int, id вида фининсирования, объект приходит с бэка sources
*/

export default function create(

) {
    return (
        <AuthenticatedLayout>
            <div>test react page</div>
        </AuthenticatedLayout>
    );

}
