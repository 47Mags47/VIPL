import { useState } from 'react';
import { router } from '@inertiajs/react'

import VerticalForm from '@/components/form/VerticalForm';

import Input from "@/components/inputs/Input"
import ModalButton from "@/components/button/ModalButton";
import BlueButton from '@/components/button/BlueButton';
import handleChange from '@/handles/input/handleChange';
import AddIco from '@/components/icons/AddIco'
import SelectComponent from '@/components/inputs/Select'
import handleSelectChange from '@/handles/input/handleSelectChange';


export default function Create({ sources }) {
    const [modalShow, changeModalShow] = useState(false)
    const [values, setValues] = useState({
        code: '',
        name: '',
        source_id: ''
    });
    const selectOptions = {
        sources: sources.map(sources => ({
            value: sources.id,
            label: sources.name
        }))
    }

    function changeAddState(state) {
        changeModalShow(state);
    }

    function onAddSubmit(e) {
        e.preventDefault()

        router.post(route('glossary.laws.store'), values, {
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
                    form="glossary-laws-add-form"
                >
                    Добавить
                </BlueButton>
            }
        >
            <VerticalForm
                header={'Добавить'}
                handleSubmit={onAddSubmit}
                id="glossary-laws-add-form"
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
                    name="name"
                    label="Наименование"
                    value={values.name}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <SelectComponent
                    name="source_id"
                    label="Вид финансирования"
                    options={selectOptions.sources}
                    value={values.source_id}
                    onChange={(value) => {
                        handleSelectChange('source_id', value, values, setValues)
                    }}
                />
            </VerticalForm>
        </ModalButton>
    );

}




