import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

/* DEV форма редактирования выплаты
    Форма отправляет PUT (POST) запрос на route('glossary.payments.update)

    Требуемые данные:
    - code              Числовой код            => string, формата ###, где # - число
    - name              Наименование            => text
    - krv               Краткое наименование    => string, длиной до 255 символов
    - kbk               КБК                     => string, формата ### #### ##### ##### ###
    - law_id            Закон                   => int, id закона, объект приходит с бэка laws
    - periodicity_id    Переодичность           => int, id закона, объект приходит с бэка peridicity
*/

export default function edit(

) {
    return (
        <AuthenticatedLayout>
            <div>test react page</div>
        </AuthenticatedLayout>
    );
}
