import { router, usePage } from '@inertiajs/react'
import { useState } from 'react'
import GroupComponent from './formGroupComponent'
import Button from './button'

export default function AuthForm() {
    const { errors } = usePage().props
    const [values, setValues] = useState({
        email: '',
        password: '',
    })

    const handleChange = (e) => {
        setValues({
            ...values,
            [e.target.name]: e.target.value
        })
    }

    const handleSubmit = async (e) => {
        e.preventDefault();
        router.post(route('session.store'), values)
        console.log(errors);
    };

    return (
        <div className="authForm-container">
            <form onSubmit={handleSubmit} className="authForm">
                <div className="form-params">
                    <input type="hidden" name="_token" value={token()} />
                </div>
                <div className="form-errors">
                    {errors.form && <div>{errors.form}</div>}
                </div>
                <div className="form-content">
                    <GroupComponent 
                        htmlFor="email" 
                        labelName="Email:" 
                        type="email" 
                        name="email"
                        value={values.email} 
                        onChange={handleChange}
                        placeholder="example@mail.ru"
                    />  
                    <GroupComponent 
                        htmlFor="password" 
                        labelName="Password:" 
                        type="password" 
                        name="password"
                        value={values.password} 
                        onChange={handleChange}
                        placeholder="Password"
                    />
                </div>
                <Button type="submit" nameBtn="submit-btn" textBtn="Войти"/>
            </form>
        </div>
    );
}