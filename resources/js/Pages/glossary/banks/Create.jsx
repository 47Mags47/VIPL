import { useState } from 'react';
import { router } from '@inertiajs/react'

import VerticalForm from '@/components/form/VerticalForm';
import BlueButton from '@/components/button/BlueButton';
import ModalButton from "@/components/button/ModalButton";
import AddIco from '@/components/icons/AddIco'
import Input from "@/components/inputs/Input"
import TextArea from "@/components/inputs/TextArea"
import SelectComponent from '@/components/inputs/Select';

import handleChange from '@/handles/input/handleChange';
import handleSelectChange from '@/handles/input/handleSelectChange';


export default function Create({ exporter, division }) {
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
    const selectOptions = {
        exporter: exporter.map(exporter => ({
            value: exporter.id,
            label: exporter.name,
        })),
        division: division.map(division => ({
            value: division.id,
            label: division.name
        }))
    }

    function changeAddState(state) {
        changeModalShow(state);
    }

    function onSubmit(e) {
        e.preventDefault()

        router.post(route('glossary.banks.store'), values, {
            onSuccess: function () {
                changeModalShow(false)
            },
        })
    }

    const Button = ({ onClick }) => {
        return <AddIco onClick={onClick} />
    };

    return (
        <ModalButton
            open={modalShow}
            changeState={changeAddState}
            Button={Button}
            footer={
                <BlueButton
                    type="submit"
                    form="glossary-bank-add-form"
                >
                    Добавить
                </BlueButton>
            }
        >
            <VerticalForm
                header={'Добавить'}
                handleSubmit={onSubmit}
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
                <SelectComponent
                    name="bank[exporter_id]"
                    label="Экспортер"
                    options={selectOptions.exporter}
                    value={values.bank.exporter_id}
                    onChange={(value) => {
                        handleSelectChange('bank.exporter_id', value, values, setValues)
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
                    options={selectOptions.division}
                    value={values.contract.division_side_id}
                    onChange={(value) => {
                        handleSelectChange('contract.division_side_id', value, values, setValues)

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
                    onChange={(e) => { handleChange(e, values, setValues) }}
                >
                    {values.bank_side.comment}
                </TextArea>
            </VerticalForm>
        </ModalButton>
    );

}




