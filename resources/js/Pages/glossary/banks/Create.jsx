import { useState } from 'react';
import { router } from '@inertiajs/react'

import VerticalForm from '@/components/form/VerticalForm';

import Input from "@/components/inputs/Input"
import TextArea from "@/components/inputs/TextArea"
import ModalButton from "@/components/button/ModalButton";
import BaseButton from '@/components/button/BaseButton';
import handleChange from '@/handles/input/handleChange';


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

export default function Create() {
    const [modalShow, changeModalShow] = useState(false)
    const [values, setValues] = useState({
        bank: {
            number_code: '',
            code: '',
            name: '',
            exporter_id: '',
        },
        contract: {
            number: '',
            signed_at: '',
            division_side_id: '',
        },
        bank_side: {
            name: '',
            INN: '',
            BIK: '',
            account: '',
            comment: '',
        },
    });

    function changeAddState(state) {
        changeModalShow(state);
    }

    function onAddSubmit(e) {
        e.preventDefault()

        router.post(route('glossary.banks.store'), values, {
            onSuccess: function () {
                changeModalShow(false)
                // showFlash() // [ ] front добавить глобальный хелпер для вывода сообщения из Flash хранилища
            },
        })
    }


    return (
        <ModalButton
            open={modalShow}
            changeState={changeAddState}
            buttonText="Добавить"
            footer={
                <BaseButton type="submit" form="glossary-bank-add-form">Добавить</BaseButton>
            }
        >
            <VerticalForm
                header={'Добавить'}
                handleSubmit={onAddSubmit}
                id="glossary-bank-add-form"
            >
                <Input
                    type={"number"}
                    name={"bank[number_code]"}
                    label={"Числовой код"}
                    value={values.bank.number_code}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <Input
                    type="text"
                    name="bank[code]"
                    label="Строковый код"
                    value={values.bank.code}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <Input
                    type="text"
                    name="bank[name]"
                    label="Наименование"
                    value={values.bank.name}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <Input //[ ] front Изменить на SELECT (exporters)
                    type="text"
                    name="bank[exporter_id]"
                    label="Экспортер"
                    value={values.bank.exporter_id}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <Input
                    type="text"
                    name="contract[number]"
                    label="Номер контракта"
                    value={values.contract.number}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <Input
                    type="date"
                    name="contract[signed_at]"
                    label="Дата заключения"
                    value={values.contract.signed_at}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <Input //[ ] front Изменить на SELECT (division_sides)
                    type="text"
                    name="contract[division_side_id]"
                    label="Сторона организации"
                    value={values.contract.division_side_id}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <Input
                    type="text"
                    name="bank_side[name]"
                    label="Наименование"
                    value={values.bank_side.name}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <Input
                    type="text"
                    name="bank_side[INN]"
                    label="ИНН"
                    value={values.bank_side.INN}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <Input
                    type="number"
                    name="bank_side[account]"
                    label="Счет"
                    value={values.bank_side.account}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <Input
                    type="number"
                    name="bank_side[BIK]"
                    label="БИК"
                    value={values.bank_side.BIK}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <TextArea
                    name="bank_side.comment"
                    label="Комментарий"
                    rows={9}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                >
                    {values.bank_side.comment}
                </TextArea>
            </VerticalForm>
        </ModalButton>
    );

}




