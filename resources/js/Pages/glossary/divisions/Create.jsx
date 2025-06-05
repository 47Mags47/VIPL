import { useState } from 'react';
import { router } from '@inertiajs/react'

import VerticalForm from '@/components/form/VerticalForm';

import Input from "@/components/inputs/Input"
import ModalButton from "@/components/button/ModalButton";
import BaseButton from '@/components/button/BaseButton';
import handleChange from '@/handles/input/handleChange';
import Add from '@/components/icons/Add'


export default function Create() {
    const [modalShow, changeModalShow] = useState(false)
    const [values, setValues] = useState({
        code: '',
        name: '',
    });

    function changeAddState(state) {
        changeModalShow(state);
    }

    function onAddSubmit(e) {
        e.preventDefault()

        router.post(route('glossary.divisions.store'), values, {
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
                    className="add-btn"
                    type="submit"
                    form="glossary-divisions-add-form"
                >
                    Добавить
                </BaseButton>
            }
        >
            <VerticalForm
                header={'Добавить'}
                handleSubmit={onAddSubmit}
                id="glossary-divisions-add-form"
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
            </VerticalForm>
        </ModalButton>
    );

}




