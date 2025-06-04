import { useState } from 'react';
import { router } from '@inertiajs/react'

import ModalButton from "@/components/button/ModalButton";

import VerticalForm from '@/components/form/VerticalForm';

import Input from "@/components/inputs/Input"
import BaseButton from '@/components/button/BaseButton';
import handleChange from '@/handles/input/handleChange';
import TextArea from 'antd/es/input/TextArea';


export default function Edit({ record }) {
    const [modalShow, changeModalShow] = useState(false)
    const [values, setValues] = useState({
        code: record.code,
        krv: record.krv,
        name: record.name,
        kbk: record.kbk,
        periodicity: {
            id: record.periodicity.id,
        },
        law: {
            id: record.law.id,
        }
    });

    function changeEditState(state) {
        changeModalShow(state);
    }

    function onEditSubmit(e) {
        e.preventDefault()

        router.put(route('glossary.payments.update', { payment: record.id }), values, {
            onSuccess: function () {
                changeModalShow(false)
                // showFlash() // [ ] front добавить глобальный хелпер для вывода сообщения из Flash хранилища
            },
        })
    }

    return (
        <ModalButton
            open={modalShow}
            changeState={changeEditState}
            buttonText="Редактировать"
            footer={
                <BaseButton type="submit" form="glossary-payments-edit-form">Отправить</BaseButton>
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
                    name="name"
                    label="Наименование"
                    value={values.name}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <Input //DEV заменить на SELECT
                    type="number"
                    name="law_id"
                    label="Переодичность"
                    value={values.law.id}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <Input //DEV заменить на SELECT
                    type="number"
                    name="periodicity_id"
                    label="Переодичность"
                    value={values.periodicity.id}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
            </VerticalForm>
        </ModalButton>
    );
}
