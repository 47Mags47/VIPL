import { useState } from 'react';
import { router } from '@inertiajs/react'

import VerticalForm from '@/components/form/VerticalForm';

import Input from "@/components/inputs/Input"
import ModalButton from "@/components/button/ModalButton";
import BaseButton from '@/components/button/BaseButton';
import EditIco from '@/components/icons/Edit'
import handleChange from '@/handles/input/handleChange';
import handleSelectChange from '@/handles/input/handleSelectChange';
import SelectComponent from '@/components/inputs/Select';


export default function Edit({ files, record }) {
    const [modalShow, changeModalShow] = useState(false)
    const [values, setValues] = useState({
        last_name: record.last_name,
        first_name: record.first_name,
        middle_name: record.middle_name,
        d_rojd: record.d_rojd,
        snils: record.snils,
        account: record.account,
        summ: record.summ,
        pasp: record.pasp,
    });
    
    function changeEditState(state) {
        changeModalShow(state);
    }

    function onEditSubmit(e) {
        e.preventDefault()
        router.put(route('payments.file.recipients.update', { file: files.id, recipient: record.id }), values, {
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
                    form="payment-recipients-edit-form"
                >
                    Отправить
                </BaseButton>
            }
        >
            <VerticalForm
                header={'Редактировать'}
                handleSubmit={onEditSubmit}
                id="payment-recipients-edit-form"
            >
                <Input
                    type={"text"}
                    name={"last_name"}
                    label={"Фамилия"}
                    value={values.last_name}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <Input
                    type="text"
                    name="first_name"
                    label="Имя"
                    value={values.first_name}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <Input
                    type="text"
                    name="middle_name"
                    label="Отчество"
                    value={values.middle_name}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <Input
                    type="date"
                    name="d_rojd"
                    label="Дата рождения"
                    value={values.d_rojd}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <Input
                    type="text"
                    name="snils"
                    label="СНИЛС"
                    value={values.snils}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <Input
                    type="text"
                    name="account"
                    label="Счет"
                    value={values.account}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <Input
                    type="text"
                    name="summ"
                    label="Сумма"
                    value={values.summ}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <Input
                    type="text"
                    name="pasp"
                    label="Счет"
                    value={values.pasp}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
            </VerticalForm>
        </ModalButton>
    );
}
