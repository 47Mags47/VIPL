import { useState } from "react";
import { router, usePage } from '@inertiajs/react'; 

export default function HandleForm(initialValues = { email: '', password: '' }) {
    const { errors } = usePage().props;
    const [values, setValues] = useState(initialValues);

    function handleInputChange(e) {
    const key = e.target.name;
    const value = e.target.value
    setValues(values => ({
        ...values,
        [key]: value,
    }))
  }

    const handleSubmit = (action) => (e) => { 
        e.preventDefault();
        router.post(action, values); 
    };

    return { values, errors, handleInputChange, handleSubmit };
}