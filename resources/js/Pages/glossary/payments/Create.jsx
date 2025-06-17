import { useState } from 'react';
import { router } from '@inertiajs/react'

import VerticalForm from '@/components/form/VerticalForm';

import Input from "@/components/inputs/Input"
import ModalButton from "@/components/button/ModalButton";
import BaseButton from '@/components/button/BaseButton';
import handleChange from '@/handles/input/handleChange';
import TextArea from '@/components/inputs/TextArea';
import Add from '@/components/icons/Add'
import SelectComponent from '@/components/inputs/Select'
import handleSelectChange from '@/handles/input/handleSelectChange';


export default function Create({ laws, periodicity }) {
    const [modalShow, changeModalShow] = useState(false)
    const [values, setValues] = useState({
        code: '',
        krv: '',
        name: '',
        kbk: '',
        periodicity: {
            id: '',
        },
        law: {
            id: '',
        },
        lawsSelect: laws.map(laws => ({
            value: laws.id,
            label: laws.code
        })),
        periodicitySelect: periodicity.map(periodicity => ({
            value: periodicity.id,
            label: periodicity.name
        }))
    });

    function changeAddState(state) {
        changeModalShow(state);
    }

    function onAddSubmit(e) {
        e.preventDefault()

        router.post(route('glossary.payments.store'), values, {
            onSuccess: function () {
                changeModalShow(false)
            },
        })
    }


    return (
        <ModalButton
            className={"add"}
            open={modalShow}
            changeState={changeAddState}
            buttonText={<Add />}
            footer={
                <BaseButton
                    className={"add-btn"}
                    type="submit"
                    form="glossary-payments-add-form"
                >
                    Добавить
                </BaseButton>
            }
        >
            <VerticalForm
                header={'Добавить'}
                handleSubmit={onAddSubmit}
                id="glossary-payments-add-form"
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
                />
                <Input
                    type="text"
                    name="kbk"
                    label="КБК"
                    value={values.kbk}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <SelectComponent
                    name="law[id]"
                    label="Закон"
                    options={values.lawsSelect}
                    value={values.law.id}
                    onChange={(value) => {
                        handleSelectChange('law.id', value, values, setValues)
                    }}
                />
                <SelectComponent
                    name="periodicity[id]"
                    label="Переодичность"
                    options={values.periodicitySelect}
                    value={values.periodicity.id}
                    onChange={(value) => {
                        handleSelectChange('periodicity.id', value, values, setValues)
                    }}
                />
            </VerticalForm>
        </ModalButton>
    );

}




