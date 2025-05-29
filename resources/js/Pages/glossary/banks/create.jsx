import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

/* DEV форма создания банка
    Форма отправляет POST запрос на route('glossary.banks.store)

    Требуемые данные:
    - bank[number_code]             Числовой код            => string, формата ###, где # - число
    - bank[code]                    Строковый код           => string, длиной до 50 символов
    - bank[name]                    Наименование            => string, длиной до 255 символов
    - bank[exporter_id]             Экспортер               => int, id экпортера, объект приходит с бэка exporters

    - contract[number]              Номер                   => string, длиной до 255 символов
    - contract[signed_at]           Дата заключения         => date
    - contract[division_side_id]    Сторона организации     => int, id стороны организации, объект приходит с бэка sides.division

    - bank_side[name]               Наименование            => string, длиной до 255 символов
    - bank_side[INN]                ИНН                     => int, формата ##########
    - bank_side[account]            Счет                    => int, формата ####################
    - bank_side[BIK]                БИК                     => int, формата #########
    - bank_side[comment]            Комментарий             => string|null, длиной до 255 символов
*/

export default function create(

) {
    return (
        <AuthenticatedLayout>
            <div>test react page</div>
        </AuthenticatedLayout>
    );

}
