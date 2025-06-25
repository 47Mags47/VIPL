import { useState } from 'react';
import { router } from '@inertiajs/react'

import ModalButton from "@/components/button/ModalButton";

import VerticalForm from '@/components/form/VerticalForm';

import Input from "@/components/inputs/Input"
import BlueButton from '@/components/button/BlueButton';
import EditIco from '@/components/icons/EditIco'
import handleChange from '@/handles/input/handleChange';
import SelectComponent from '@/components/inputs/Select'
import handleSelectChange from '@/handles/input/handleSelectChange';


export default function Edit({ sources, record }) {
    const [modalShow, changeModalShow] = useState(false)
    const [values, setValues] = useState({
        code: record.code,
        name: record.name,
        source_id: record.source.id,
    });
    const selectOptions = {
        sources: sources.map(sources => ({
            value: sources.id,
            label: sources.name
        }))
    }



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

    const Button = ({ onClick }) => {
        return <EditIco onClick={onClick} />
    };

    return (
        <ModalButton
            open={modalShow}
            changeState={changeEditState}
            Button={Button}
            footer={
                < BlueButton
                    type="submit"
                    form="glossary-laws-edit-form"
                >
                    Отправить
                </BlueButton >
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
                    options={selectOptions.sources}
                    value={values.source_id}
                    onChange={(value) => {
                        handleSelectChange('source_id', value, values, setValues)
                    }}
                />
            </VerticalForm>
        </ModalButton >
    );
}
