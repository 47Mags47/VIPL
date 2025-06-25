import { useState } from 'react';
import { router } from '@inertiajs/react'

import VerticalForm from '@/components/form/VerticalForm';

import Input from "@/components/inputs/Input"
import ModalButton from "@/components/button/ModalButton";
import BlueButton from '@/components/button/BlueButton';
import handleChange from '@/handles/input/handleChange';
import AddIco from '@/components/icons/AddIco'
import SelectComponent from '@/components/inputs/Select'
import handleSelectChange from '@/handles/input/handleSelectChange';


export default function Create({ roles, divisions }) {
    const [modalShow, changeModalShow] = useState(false)
    const [values, setValues] = useState({
        name: '',
        email: '',
        division_id: '',
        roles: [],
    });
    const selectOptions = {
        divisions: divisions.map(divisions => ({
            value: divisions.id,
            label: divisions.name,
        })),
        roles: roles.map(roles => ({
            value: roles.code,
            label: roles.name
        }))
    }

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
                    Отправить
                </BlueButton>
            }
        >
            <VerticalForm
                header={'Добавить пользователя'}
                handleSubmit={onAddSubmit}
                id="main-user-add-form"
            >
                <Input
                    type={"name"}
                    name={"name"}
                    label={"Имя"}
                    value={values.name}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <Input
                    type={"email"}
                    name={"email"}
                    label={"Email"}
                    value={values.email}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <SelectComponent
                    name="division_id"
                    label="Подразделение"
                    options={selectOptions.divisions}
                    value={values.division_id}
                    onChange={(value) => {
                        handleSelectChange('division_id', value, values, setValues)

                    }}
                />
                <SelectComponent
                    name="roles"
                    label="Роли"
                    options={selectOptions.roles}
                    value={values.roles}
                    onChange={(value) => handleSelectChange('roles', value, values, setValues)}
                    mode="multiple"
                />
            </VerticalForm>
        </ModalButton>
    );
}
