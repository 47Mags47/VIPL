import { router, usePage } from '@inertiajs/react'
import { useState } from 'react'

export default function AuthForm() {
    const { errors } = usePage().props

    const [values, setValues] = useState({
        email: '',
        password: '',
    })

    function handleChange(e) {
        setValues(values => ({
            ...values,
            [e.target.id]: e.target.value,
        }))
    }

    const handleSubmit = async (e) => {
        e.preventDefault();

<<<<<<< HEAD
        router.post(route('session.store'), values)
        console.log(errors);

    };
=======
        // if (!validateForm()){
            // return
        // }
        setIsSubmitting(true)

        try{
            // axios.post(route('session.store', {
            //     _token: token()
            // }))

            $.ajax({
                method: 'POST',
                url: route('session.store'),
                data: {
                    _token: token(),
                    email: 'admin@test.ru',
                    password: 'admin'
                },

                success: function(response){
                    // location.assign()
                    console.log(response);
                    
                },
                error: function(response){
                    console.log(response);
                    
                    // $.each(response.responseJSON.errors, function(i, error){
                    //     console.log(i, error);
                        
                    // })
                    // console.log(response.errors);
                    
                }
            })

            // перенаправление на страницу со списком
        }
        
        catch{
            console.error('Error', error);
            setErrors({
                ...errors,
                server: {err}
            });
        } finally {
            setIsSubmitting(false)
        }
>>>>>>> ca3ae35 (форма авторизации)

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
                    <div className="form-group">
                        <label htmlFor="email">Email:</label>
                        <input type="email" id="email" name="email" value={values.email} onChange={handleChange} placeholder="example@mail.ru" />
                        {errors.email && <div>{errors.email}</div>}
                    </div>
                    <div className="form-group">
                        <label htmlFor="password">Пароль:</label>
                        <input type="password" id="password" onChange={handleChange} name="password" />
                    </div>
                </div>
                <div className="form-buttons">
                    <button type="submit" className="submit-btn">
                        Войти
                    </button>
                </div>
            </form>
        </div>
    );
}
