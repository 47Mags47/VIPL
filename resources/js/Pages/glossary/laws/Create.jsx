import { useState } from 'react';
import { router } from '@inertiajs/react'

import VerticalForm from '@/components/form/VerticalForm';

import Input from "@/components/inputs/Input"
import ModalButton from "@/components/button/ModalButton";
import BaseButton from '@/components/button/BaseButton';
import handleChange from '@/handles/input/handleChange';
import Add from '@/components/icons/Add'
import SelectComponent from '@/components/inputs/Select'
import handleSelectChange from '@/handles/input/handleSelectChange';


export default function Create({ sources }) {
    const [modalShow, changeModalShow] = useState(false)
    const [values, setValues] = useState({
        code: '',
        name: '',
        source: {
            id: '',
        },
        sourcesSelect: sources.map(sources => ({
            value: sources.id,
            label: sources.name

        }))
    });

    function changeAddState(state) {
        changeModalShow(state);
    }

    function onAddSubmit(e) {
        e.preventDefault()

        router.post(route('glossary.laws.store'), values, {
            onSuccess: function () {
                changeModalShow(false)
                // showFlash() // [ ] front добавить глобальный хелпер для вывода сообщения из Flash хранилища
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
                    form="glossary-laws-add-form"
                >
                    Добавить
                </BaseButton>
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
                    options={values.sourcesSelect}
                    value={values.source.id}
                    onChange={(value) => {
                        handleSelectChange('source.id', value, values, setValues)
                    }}
                />
            </VerticalForm>
        </ModalButton>
    );

}




