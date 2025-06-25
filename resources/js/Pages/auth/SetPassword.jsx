import { useState } from "react"

import GuestLayout from "@/Layouts/GuestLayout"
import VerticalForm from "@/components/form/VerticalForm"
import Input from "@/components/inputs/Input"

import handleChange from '@/handles/input/handleChange';
import { router } from "@inertiajs/react";

export default function SetPassword() {
    const [values, setValues] = useState({
        password: '',
        password_confirmation: '',
    })

    function onSubmit(e){
        e.preventDefault()

        router.post(route('password.update'), values)
    }

    return (
        <GuestLayout>
            <VerticalForm header="Установите пароль" handleSubmit={onSubmit} sbm="Отправить">
                <Input
                    type="password"
                    label="Пароль"
                    name="password"
                    value={values.password}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <Input
                    type="password"
                    label="Повторите пароль"
                    name="password_confirmation"
                    value={values.password_confirmation}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
            </VerticalForm>
        </GuestLayout>
    )
}
