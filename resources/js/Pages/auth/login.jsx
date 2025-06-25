import { router } from '@inertiajs/react';
import { useState } from 'react';

import GuestLayout from '@/Layouts/GuestLayout';

import VerticalForm from '@/components/form/VerticalForm';
import Input from "@/components/inputs/Input"
import handleChange from '@/handles/input/handleChange';


export default function Login() {
    const [values, setValues] = useState({
        email: '',
        password: '',
    })

    function onSubmit(e) {
        e.preventDefault()
        router.post(route('login.post'), values)
    }

    return (
        <GuestLayout>
            <VerticalForm
                header="Войти в систему"
                handleSubmit={onSubmit}
                className="auth-form"
                sbm="Войти"
                buttonName={"auth-btn"} // HACK для чего это? Убрать
            >
                <Input
                    type="email"
                    name="email"
                    label="Email"
                    value={values.email}
                    onChange={(e) => { handleChange(e, values, setValues) }}
                />
                <Input
                    type="password"
                    name="password"
                    value={values.password}
                    label="Пароль" onChange={(e) => { handleChange(e, values, setValues) }}
                />
            </VerticalForm>
        </GuestLayout>
    )
}
