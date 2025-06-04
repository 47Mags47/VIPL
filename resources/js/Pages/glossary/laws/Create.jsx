import { useState } from 'react';
import { router } from '@inertiajs/react'

import VerticalForm from '@/components/form/VerticalForm';

import Input from "@/components/inputs/Input"
import ModalButton from "@/components/button/ModalButton";
import BaseButton from '@/components/button/BaseButton';
import handleChange from '@/handles/input/handleChange';


export default function Create() {
    const [modalShow, changeModalShow] = useState(false)
    const [values, setValues] = useState({
        code: '',
        name: '',
        source:{
            id: '',
        }
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
            open={modalShow}
            changeState={changeAddState}
            buttonText="Добавить"
            footer={
                <BaseButton type="submit" form="glossary-laws-add-form">Добавить</BaseButton>
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
                <Input //DEV заменить на SELECT
                    type="number"
                    name="source_id"
                    label="Вид финансирования"
                    value={values.source.id}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
            </VerticalForm>
        </ModalButton>
    );

}




