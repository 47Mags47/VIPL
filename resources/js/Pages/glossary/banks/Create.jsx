import VerticalForm from '@/components/form/VerticalForm';
import Input from "@/components/inputs/Input"
import TextArea from "@/components/inputs/TextArea"
import ModalButton from "@/components/button/ModalButton";
import { useState, useRef } from 'react';
import { router } from '@inertiajs/react'


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

export default function Create({ record }) {
    const formRef = useRef();
    const modalRef = useRef();
    const [values, setValues] = useState({
        // 'bank[number_code]': record.number_code,
        // 'bank[code]': record.code,
        // 'bank[name]': record.name,
        // 'bank[exporter_id]': record.exporter.id,
        // 'contract[number]': record.contract.number,
        // 'contract[signed_at]': record.contract.signed_at,
        // 'contract[division_side_id]': 1,
        // 'bank_side[name]': record.name,
        // 'bank_side[INN]': record.contract.division_side.INN,
        // 'bank_side[BIK]': record.contract.division_side.BIK,
        // 'bank_side[account]': record.contract.division_side.account,
        // 'bank_side[comment]': record.contract.division_side.comment,
    });

    function handleChange(e) {
        const key = e.target.name;
        const value = e.target.value
        setValues(values => ({
            ...values,
            [key]: value,
        }))

    }

    function onOkEditModal() {
        formRef.current.requestSubmit()
    }

    function onAdd(data) {
        router.post(route('glossary.banks.create', { bank: record.id }), data, {
            onSuccess: function (response) {
                
            },
        })
    }


    return (
        <ModalButton
            buttonText="Добавить"
            okHandle={onOkEditModal}
            ref={modalRef}
        >
            <VerticalForm
                ref={formRef}
                header={'Добавить'}
                onSubmit={onAdd}
                method="GET"
            >
                <Input
                    type={"number"}
                    name={"bank[number_code]"}
                    label={"Числовой код"}
                />
                <Input
                    type="text"
                    name="bank[code]"
                    label="Строковый код"
                    inputValue={values['bank[code]']}
                    onChange={handleChange}
                />
                <Input
                    type="text"
                    name="bank[name]"
                    label="Наименование"
                    inputValue={values['bank[name]']}
                    onChange={handleChange}
                />
                <Input //DEV Изменить на SELECT жду ответа от back`a
                    type="text"
                    name="bank[exporter_id]"
                    label="Экспортер"
                    inputValue={values['bank[exporter_id]']}
                    onChange={handleChange}
                />
                <Input
                    type="text"
                    name="contract[number]"
                    label="Номер контракта"
                    inputValue={values['contract[number]']}
                    onChange={handleChange}
                />
                <Input
                    type="date"
                    name="contract[signed_at]"
                    label="Дата заключения"
                    inputValue={values['contract[signed_at]']}
                    onChange={handleChange}
                />
                <Input //DEV Изменить на SELECT жду ответа от back`a
                    type="text"
                    name="contract[division_side_id]"
                    label="Сторона организации"
                    inputValue={1} //record.contract.division_side.name
                    onChange={handleChange}
                />
                <Input
                    type="text"
                    name="bank_side[name]"
                    label="Наименование"
                    inputValue={values['bank_side[name]']}
                    onChange={handleChange}
                />
                <Input
                    type="text"
                    name="bank_side[INN]"
                    label="ИНН"
                    inputValue={values['bank_side[INN]']}
                    onChange={handleChange}
                />
                <Input
                    type="number"
                    name="bank_side[account]"
                    label="Счет"
                    inputValue={values['bank_side[account]']}
                    onChange={handleChange}
                />
                <Input
                    type="number"
                    name="bank_side[BIK]"
                    label="БИК"
                    inputValue={values['bank_side[BIK]']}
                    onChange={handleChange}
                />
                <TextArea
                    name="bank_side[comment]"
                    label="Комментарий"
                    rows={9}
                >
                    {values['bank_side[comment]']}
                </TextArea>
            </VerticalForm>
        </ModalButton>
    );

}




