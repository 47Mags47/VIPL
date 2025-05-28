import GuestLayout from '@/Layouts/GuestLayout';
import VerticalForm from '@/components/form/VerticalForm';
import Input from "@/components/inputs/Input"
import HandleForm from '@/components/form/handleForm';

export default function Login() {
    const { handleInputChange } = HandleForm();
    return (
        <GuestLayout>
            <VerticalForm action={route('session.store')} header="Войти в систему">
                <Input type="email" name="email" label="Email" handleInputChange ={handleInputChange}/>
                <Input type="password" name="password" label="Пароль" handleInputChange ={handleInputChange}/>
            </VerticalForm>
        </GuestLayout>
    )
}
