import { useState } from 'react';
import { router, Link } from '@inertiajs/react'

import ModalButton from "@/components/button/ModalButton";

import VerticalForm from '@/components/form/VerticalForm';

import Input from "@/components/inputs/Input"
import BlueButton from '@/components/button/BlueButton';
import RedButton from '@/components/button/RedButton';
import EditIco from '@/components/icons/EditIco'
import handleChange from '@/handles/input/handleChange';
import SelectComponent from '@/components/inputs/Select'
import handleSelectChange from '@/handles/input/handleSelectChange';


export default function Edit({ roles, divisions, record }) {
    const [modalShow, changeModalShow] = useState(false)
    const [values, setValues] = useState({
        name: record.name,
        email: record.email,
        division_id: record.division?.id,
        roles: record.roles.map(roles => roles.code),
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

    function changeEditState(state) {
        changeModalShow(state);
    }

    function onEditSubmit(e) {
        e.preventDefault()

        router.put(route('main.users.update', { user: record.id }), values, {
            onSuccess: function () {
                changeModalShow(false)
            },
        })
    }

    function resetPassword(e) {
        e.preventDefault()

        if (confirm(`Вы уверены, что хотите сбросить пароль для ${record.name}`)) {
            router.post(route('main.users.reset-password', { user: record.id }), {}, {
                onSuccess: function () {
                    changeModalShow(false)
                },
            })
        }
    }

    const Button = ({ onClick }) => {
        return <EditIco onClick={onClick} />
    };

    return (
        <ModalButton
            open={modalShow}
            changeState={changeEditState}
            Button={Button}
            footer={
                <>
                    <RedButton
                        onClick={resetPassword}
                    >
                        Сбросить пароль
                    </RedButton>

                    <BlueButton
                        type="submit"
                        form="main-user-edit-form"
                    >
                        Сохранить
                    </BlueButton>

                </>
            }
        >
            <VerticalForm
                header={'Редактировать'}
                handleSubmit={onEditSubmit}
                id="main-user-edit-form"
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
