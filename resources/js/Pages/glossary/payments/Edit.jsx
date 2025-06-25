import { useState } from 'react';
import { router } from '@inertiajs/react'

import ModalButton from "@/components/button/ModalButton";

import VerticalForm from '@/components/form/VerticalForm';

import Input from "@/components/inputs/Input"
import BlueButton from '@/components/button/BlueButton';
import EditIco from '@/components/icons/EditIco'
import handleChange from '@/handles/input/handleChange';
import TextArea from '@/components/inputs/TextArea';
import SelectComponent from '@/components/inputs/Select'
import handleSelectChange from '@/handles/input/handleSelectChange';


export default function Edit({ laws, periodicity, record }) {
    const [modalShow, changeModalShow] = useState(false)
    const [values, setValues] = useState({
        code: record.code,
        krv: record.krv,
        name: record.name,
        kbk: record.kbk,
        periodicity_id: record.periodicity.id,
        law_id: record.law.id,
    });
    const selectOptions = {
        laws: laws.map(laws => ({
            value: laws.id,
            label: laws.code
        })),
        periodicity: periodicity.map(periodicity => ({
            value: periodicity.id,
            label: periodicity.name
        }))
    }

    function changeEditState(state) {
        changeModalShow(state);
    }

    function onEditSubmit(e) {
        e.preventDefault()

        router.put(route('glossary.payments.update', { payment: record.id }), values, {
            onSuccess: function () {
                changeModalShow(false)
            },
        })
    }
    const Button = ({ onClick }) => {
        return <EditIco onClick={onClick} />
    };

    return (
        <ModalButton
            open={modalShow}
            changeState={changeEditState}
            Button={Button}
            footer={
                <BlueButton
                    type="submit"
                    form="glossary-payments-edit-form"
                >
                    Отправить
                </BlueButton>
            }
        >
            <VerticalForm
                header={'Редактировать'}
                handleSubmit={onEditSubmit}
                id="glossary-payments-edit-form"
            >
                <Input
                    type="text"
                    name="code"
                    label="Код"
                    value={values.code}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <Input
                    type="text"
                    name="krv"
                    label="Краткое наименование"
                    value={values.krv}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <TextArea
                    name="name"
                    rows={2}
                    label="Наименование"
                    value={values.name}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                >
                </TextArea>
                <Input
                    type="text"
                    name="kbk"
                    label="КБК"
                    value={values.kbk}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <SelectComponent
                    name="law_id"
                    label="Закон"
                    options={selectOptions.laws}
                    value={values.law_id}
                    onChange={(value) => {
                        handleSelectChange('law_id', value, values, setValues)
                    }}
                />
                <SelectComponent
                    name="periodicity_id"
                    label="Переодичность"
                    options={selectOptions.periodicity}
                    value={values.periodicity_id}
                    onChange={(value) => {
                        handleSelectChange('periodicity_id', value, values, setValues)
                    }}
                />
            </VerticalForm>
        </ModalButton>
    );
}
