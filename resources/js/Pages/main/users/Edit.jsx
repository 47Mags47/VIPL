import { useState } from 'react';
import { router } from '@inertiajs/react'

import ModalButton from "@/components/button/ModalButton";

import VerticalForm from '@/components/form/VerticalForm';

import Input from "@/components/inputs/Input"
import BaseButton from '@/components/button/BaseButton';
import EditIco from '@/components/icons/Edit'
import handleChange from '@/handles/input/handleChange';
import SelectComponent from '@/components/inputs/Select'
import handleSelectChange from '@/handles/input/handleSelectChange';


export default function Edit({ record }) {
    const [modalShow, changeModalShow] = useState(false)
    const [values, setValues] = useState({
        name: record.name,
        email: record.email,
        division: record.division,
        selectedRoleIds: record.roles.map(role => role.id),
        rolesSelect: record.roles.map(roles => ({
            value: roles.id,
            label: roles.name
        })),
        // divisionSelect: division.map(division => ({
        //     value: division.id,
        //     label: division.name
        // }))
    });

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
                    form="main-user-edit-form"
                >
                    Отправить
                </BaseButton>
            }
        >
            <VerticalForm
                header={'Редактировать'}
                handleSubmit={onEditSubmit}
                id="main-users-edit-form"
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
                {/* <SelectComponent
                    name="division[name]"
                    label="Подразделение"
                    options={values.divisionSelect}
                    value={values.division.id}
                    onChange={(value) => {
                        handleSelectChange('division.id', value, values, setValues)

                    }}
                /> */}
                <SelectComponent
                    name="roles[name]"
                    label="Роли"
                    options={values.rolesSelect}
                    value={values.selectedRoleIds}
                    onChange={(value) => handleSelectChange('selectedRoleIds', value, values, setValues)}
                    mode="multiple"
                />
            </VerticalForm>
        </ModalButton>
    );
}
