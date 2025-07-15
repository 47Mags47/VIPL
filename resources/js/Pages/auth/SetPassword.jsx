import { useState }             from "react"
import { router }               from "@inertiajs/react"

import {GuestLayout as Layout}  from "@/layouts"

import { VerticalForm, Input }  from "@/components/forms"

import handleChange             from '@/handles/input/handleChange'


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
        <Layout>
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
        </Layout>
    )
}
