import { useState } from "react";
import { router, usePage } from '@inertiajs/react'; 

export default function HandleForm(initialValues = { email: '', password: '' }) {
    const { errors } = usePage().props;
    const [values, setValues] = useState(initialValues);

    const handleInputChange = (e) => {
        const { name, value } = e.target;
        setValues(prev => ({ ...prev, [name]: value }));
    };

    const handleSubmit = (action) => (e) => { 
        e.preventDefault();
        router.post(action, values); 
    };

    return { values, errors, handleInputChange, handleSubmit };
}