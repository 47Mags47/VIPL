import { router, usePage } from '@inertiajs/react';
import { useState } from 'react';

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'

import VerticalForm from '@/components/form/VerticalForm';
import Input from "@/components/inputs/Input"
import handleChange from '@/handles/input/handleChange';


export default function ResetPassword() {
    const user = usePage().props.user.data
    const [values, setValues] = useState(user.password)
    return (
        <AuthenticatedLayout>
            <VerticalForm>
                <Input
                    type="password"
                    name="password"
                    value={values}
                    label="Пароль" onChange={(e) => { handleChange(e, values, setValues) }}
                />
            </VerticalForm>
        </AuthenticatedLayout>
    )
}
