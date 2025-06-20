import { useState } from 'react';
import { router } from '@inertiajs/react'

import VerticalForm from '@/components/form/VerticalForm';

// import Input from "@/components/inputs/Input"
import ModalButton from "@/components/button/ModalButton";
import BaseButton from '@/components/button/BaseButton';
// import handleChange from '@/handles/input/handleChange';
import Add from '@/components/icons/Add'
// import SelectComponent from '@/components/inputs/Select'
// import handleSelectChange from '@/handles/input/handleSelectChange';


export default function Create({ record }) {
    const [modalShow, changeModalShow] = useState(false)
    const [values, setValues] = useState({});

    function changeAddState(state) {
        changeModalShow(state);
    }

    function onAddSubmit(e) {
        e.preventDefault()

        router.post(route('main.users.store'), values, {
            onSuccess: function () {
                changeModalShow(false)
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
                    form="main-user-add-form"
                >
                    Добавить
                </BaseButton>
            }
        >
            <VerticalForm>   
            </VerticalForm>
        </ModalButton>
    );

}




