import { useState } from 'react';
import { router } from '@inertiajs/react'

import VerticalForm from '@/components/form/VerticalForm';

import Input from "@/components/inputs/Input"
import TextArea from "@/components/inputs/TextArea"
import ModalButton from "@/components/button/ModalButton";
import BaseButton from '@/components/button/BaseButton';
import EditIco from '@/components/icons/Edit'
import handleChange from '@/handles/input/handleChange';
import handleSelectChange from '@/handles/input/handleSelectChange';
import SelectComponent from '@/components/inputs/Select';


export default function Edit({ division, exporter, record }) {
    const [modalShow, changeModalShow] = useState(false)
    const [values, setValues] = useState({
        bank: {
            number_code: record.number_code,
            code: record.code,
            name: record.name,
            exporter_id: record.exporter.id,
            exporter_name: record.exporter.name,
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
        exporterSelect: exporter.map(exporter => ({
            value: exporter.id,
            label: exporter.name,
        })),
        divisionSelect: division.map(division => ({
            value: division.id,
            label: division.name
        }))
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
            className={"edit"}
            open={modalShow}
            changeState={changeEditState}
            buttonText={<EditIco />}
            footer={
                <BaseButton
                    className={"edit-btn"}
                    type="submit"
                    form="glossary-bank-edit-form"
                >
                    Отправить
                </BaseButton>
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
                <SelectComponent
                    name="bank[exporter_id]"
                    label="Экспортер"
                    options={values.exporterSelect}
                    value={values.bank.exporter_id}
                    onChange={(value) => { handleSelectChange('bank.exporter_id', value, values, setValues)
                        
                    }}
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
                <SelectComponent
                    name="contract[division_side_id]"
                    label="Сторона организации"
                    options={values.divisionSelect} 
                    value={values.contract.division_side_id}
                    onChange={(value) => { handleSelectChange('contract.division_side_id', value, values, setValues)
                        
                    }}
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
                    value={values.bank_side.comment}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                >
                </TextArea>
            </VerticalForm>
        </ModalButton>
    );
}
