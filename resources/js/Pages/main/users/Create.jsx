ыimport { useState } from 'react';
import { router } from '@inertiajs/react'

import VerticalForm from '@/components/form/VerticalForm';

// import Input from "@/components/inputs/Input"
import ModalButton from "@/components/button/ModalButton";
import BlueButton from '@/components/button/BlueButton';
// import handleChange from '@/handles/input/handleChange';
import AddIco from '@/components/icons/AddIco'
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
                    form="main-user-add-form"
                >
                    Добавить
                </BlueButton>
            }
        >
            <VerticalForm>
            </VerticalForm>
        </ModalButton>
    );

}




