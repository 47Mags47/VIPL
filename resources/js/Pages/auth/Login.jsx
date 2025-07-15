import { useForm } from '@inertiajs/react';
import { Link } from '@inertiajs/react'

import { GuestLayout as Layout } from '@/layouts';
import { VerticalForm as Form, StringInput as Input, CheckBox } from '@/components/forms';


export default function Login() {
    const { data, setData, post, processing } = useForm({
        login: '',
        password: '',
        remember: false,
    })

    function onSubmit(e) {
        e.preventDefault()

        post(route('login.post'), data)
    }

    return (
        <Layout>
            <Form
                header="Вход"
                sbm="Войти"
                handleSubmit={onSubmit}
                info={(
                    <p>Если вы забыли пароль, просто <Link href={route('password.request')}>восстановите</Link>  его</p>
                )}
            >
                <Input
                    name="login"
                    label="Логин или Email"
                    value={data.login}
                    onChange={(e) => setData('login', e.target.value)}
                />
                <Input
                    type="password"
                    name="password"
                    label="Пароль"
                    value={data.password}
                    onChange={(e) => setData('password', e.target.value)}
                />
                <CheckBox
                    name="remember"
                    label="Запомнить меня"
                    value={data.м}
                    onChange={(e) => setData('remember', e.target.checked)}
                />
            </Form>
        </Layout>
    )
}
