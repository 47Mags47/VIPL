import { useState } from 'react';
import { router } from '@inertiajs/react'

import VerticalForm from '@/components/form/VerticalForm';

import Input from "@/components/inputs/Input"
import ModalButton from "@/components/button/ModalButton";
import BlueButton from '@/components/button/BlueButton';
import handleChange from '@/handles/input/handleChange';
import TextArea from '@/components/inputs/TextArea';
import AddIco from '@/components/icons/AddIco'
import SelectComponent from '@/components/inputs/Select'
import handleSelectChange from '@/handles/input/handleSelectChange';


export default function Create({ laws, periodicity }) {
    const [modalShow, changeModalShow] = useState(false)
    const [values, setValues] = useState({
        code: '',
        krv: '',
        name: '',
        kbk: '',
        periodicity_id:'',
        law_id: '',
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
                    form="glossary-payments-add-form"
                >
                    Добавить
                </BlueButton>
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




