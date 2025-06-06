import { useState } from 'react';
import { router } from '@inertiajs/react'

import ModalButton from "@/components/button/ModalButton";

import VerticalForm from '@/components/form/VerticalForm';

import Input from "@/components/inputs/Input"
import EditIco from '@/components/icons/Edit'
import BaseButton from '@/components/button/BaseButton';
import handleChange from '@/handles/input/handleChange';


export default function Edit({ record }) {
    const [modalShow, changeModalShow] = useState(false)
    const [values, setValues] = useState({
        code: record.code,
        name: record.name,
    });


    function changeEditState(state) {
        changeModalShow(state);
    }

    function onEditSubmit(e) {
        e.preventDefault()

        router.put(route('glossary.divisions.update', { division: record.id }), values, {
            onSuccess: function () {
                changeModalShow(false)
                // showFlash() // [ ] front добавить глобальный хелпер для вывода сообщения из Flash хранилища
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
                    form="glossary-divisions-edit-form"
                >
                    Отправить
                </BaseButton>
            }
        >
            <VerticalForm
                header={'Редактировать'}
                handleSubmit={onEditSubmit}
                id="glossary-divisions-edit-form"
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
