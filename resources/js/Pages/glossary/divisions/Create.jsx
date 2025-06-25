import { useState } from 'react';
import { router } from '@inertiajs/react'

import VerticalForm from '@/components/form/VerticalForm';

import Input from "@/components/inputs/Input"
import ModalButton from "@/components/button/ModalButton";
import BlueButton from '@/components/button/BlueButton';
import handleChange from '@/handles/input/handleChange';
import AddIco from '@/components/icons/AddIco'


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
                    form="glossary-division-add-form"
                >
                    Добавить
                </BlueButton>
            }
        >
            <VerticalForm
                header={'Добавить'}
                handleSubmit={onAddSubmit}
                id="glossary-division-add-form"
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




