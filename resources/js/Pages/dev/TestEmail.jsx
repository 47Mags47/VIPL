import { useState } from 'react';
import { router } from '@inertiajs/react'

import VerticalForm from '@/components/form/VerticalForm';
import Input from "@/components/inputs/Input"
import BlueButton from '@/components/button/BlueButton';

import handleChange from '@/handles/input/handleChange';


export default function TestEmail() {
    const [values, setValues] = useState({
        email: ''
    })

    function onAddSubmit(e){
        e.preventDefault()

        router.post(route('dev.test-email-post'), values)
    }

    return (
        <VerticalForm handleSubmit={onAddSubmit}>
            <Input
                type={"email"}
                name={"email"}
                label={"Email"}
                value={values.email}
                onChange={(e) => { handleChange(e, values, setValues) }}
            />
            <BlueButton type="submit">Отправить</BlueButton>
        </VerticalForm>
    )
}
