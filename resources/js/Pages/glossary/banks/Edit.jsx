import VerticalForm from '@/components/form/VerticalForm';
import Input from "@/components/inputs/Input"
import TextArea from "@/components/inputs/TextArea"
import ModalButton from "@/components/button/ModalButton";
import BaseButton from '@/components/button/BaseButton';
import handleChange from '@/handles/input/handleChange';

import { useState } from 'react';
import { router } from '@inertiajs/react'

export default function Edit({ record }) {
    const [modalShow, changeModalShow] = useState(false)
    const [values, setValues] = useState({
        bank: {
            number_code: record.number_code,
            code: record.code,
            name: record.name,
            exporter_id: record.exporter.id,
        },
        contract: {
            number: record.contract.number,
            signed_at: record.contract.signed_at,
            division_side_id: record.contract.division_side.id,
        },
        bank_side: {
            name: record.contract.bank_side.name,
            INN: record.contract.bank_side.INN,
            BIK: record.contract.bank_side.BIK,
            account: record.contract.bank_side.account,
            comment: record.contract.bank_side.comment,
        },
    });

    function changeEditState(state) {
        changeModalShow(state);
    }

    function onEditSubmit(e) {
        e.preventDefault()

        router.put(route('glossary.banks.update', { bank: record.id }), values, {
            onSuccess: function () {
                changeModalShow(false)
                // showFlash() // [ ] front добавить глобальный хелпер для вывода сообщения из Flash хранилища
            },
        })
    }

    return (
        <ModalButton
            open={modalShow}
            changeState={changeEditState}
            buttonText="Редактировать"
            footer={
                <BaseButton type="submit" form="glossary-bank-edit-form">Отправить</BaseButton>
            }
        >
            <VerticalForm
                header={'Редактировать'}
                handleSubmit={onEditSubmit}
                id="glossary-bank-edit-form"
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
