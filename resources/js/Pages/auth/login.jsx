import GuestLayout from '@/Layouts/GuestLayout';
import VerticalForm from '@/components/form/VerticalForm';
import Input from "@/components/inputs/Input"

export default function Login() {
    
    return (
        <GuestLayout>
            <VerticalForm action={route('session.store')} header="Войти в систему">
                <Input type="email" name="email" label="Email"/>
                <Input type="password" name="password" label="Пароль"/>
            </VerticalForm>
        </GuestLayout>
    )
}