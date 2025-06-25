import { useState } from 'react';
import { router } from '@inertiajs/react'

import ModalButton from "@/components/button/ModalButton";

import VerticalForm from '@/components/form/VerticalForm';

import Input from "@/components/inputs/Input"
import EditIco from '@/components/icons/EditIco'
import BlueButton from '@/components/button/BlueButton';
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
            },
        })
    }

    const Button = ({ onClick }) => {
        return <EditIco onClick={onClick} />;
    };

    return (
        <ModalButton
            open={modalShow}
            changeState={changeEditState}
            Button={Button}
            footer={
                <BlueButton
                    type="submit"
                    form="glossary-division-edit-form"
                >
                    Отправить
                </BlueButton>
            }
        >
            <VerticalForm
                header={'Редактировать'}
                handleSubmit={onEditSubmit}
                id="glossary-division-edit-form"
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
