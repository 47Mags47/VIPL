import { useState }                 from 'react'
import { router }                   from '@inertiajs/react'

import { VerticalForm, Input }      from '@/components/forms'
import BlueButton                   from '@/components/buttons/BlueButton'

import handleChange                 from '@/handles/input/handleChange'


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
