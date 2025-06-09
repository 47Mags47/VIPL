import { useState } from 'react';


import ModalButton from "@/components/button/ModalButton";
import BaseButton from '@/components/button/BaseButton';
import Add from '@/components/icons/Add'


export default function Create() {
    const [modalShow, changeModalShow] = useState(false)
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
        <> Здесь будет страничка загрузки данных в бд</>
        </ ModalButton>
    )
}