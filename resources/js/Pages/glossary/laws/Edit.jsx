import { useState } from 'react';
import { router } from '@inertiajs/react'

import ModalButton from "@/components/button/ModalButton";

import VerticalForm from '@/components/form/VerticalForm';

import Input from "@/components/inputs/Input"
import BaseButton from '@/components/button/BaseButton';
import EditIco from '@/components/icons/Edit'
import handleChange from '@/handles/input/handleChange';
import SelectComponent from '@/components/inputs/Select'
import handleSelectChange from '@/handles/input/handleSelectChange';


export default function Edit({ sources, record }) {
    const [modalShow, changeModalShow] = useState(false)
    const [values, setValues] = useState({
        code: record.code,
        name: record.name,
        source: {
            id: record.source.id,
        },
        sourcesSelect: sources.map(sources => ({
            value: sources.id,
            label: sources.name

        }))
    });

    function changeEditState(state) {
        changeModalShow(state);
    }

    function onEditSubmit(e) {
        e.preventDefault()

        router.put(route('glossary.laws.update', { law: record.id }), values, {
            onSuccess: function () {
                changeModalShow(false)
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
                    form="glossary-laws-edit-form"
                >
                    Отправить
                </BaseButton>
            }
        >
            <VerticalForm
                header={'Редактировать'}
                handleSubmit={onEditSubmit}
                id="glossary-laws-edit-form"
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
