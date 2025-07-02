import { useState } from 'react'

import { usePage } from '@inertiajs/react'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'

import Input from '@/components/inputs/Input'
import EditIco from '@/components/icons/EditIco'
import CheckIco from '@/components/icons/CheckIco'



export default function Index() {
    const user = usePage().props.user.data

    const [values, setValues] = useState({
        email: user.email,
        name: user.name,
        last_name: 'Фамилия',
        mid_name: 'Отчество'
    })
    function EditedField(props) {
        const [editing, setEditing] = useState(null)
        const handleSave = (e) => {
            e.preventDefault()

            setEditing(null)
        }

        return (
            <div style={styles.section}>
                <div style={styles.userInfo}>
                    <span>
                        {props.ico}
                    </span>
                    {editing ?
                        <Input
                            type={props.type}
                            name={props.name}
                            value={props.value}
                            onChange={(e) => props.onChange(e.target.value)}
                            style={styles.input}
                            autoFocus
                        />
                        :
                        <span>{props.value}</span>
                    }
                </div>
                {editing ?
                    <CheckIco onClick={e => handleSave(e)} />
                    :
                    <EditIco onClick={() => setEditing(true)} />
                }
            </div>
        )
    }

    const styles = {
        container: {
            display: 'flex',
            padding: '30px',
            backgroundColor: '#fff',
            borderRadius: '12px',
            boxShadow: '4px 4px 32px 16px #eee',
            maxWidth: '1700px',
            minHeight: '700px',
            margin: '40px auto',
            fontFamily: 'Arial, sans-serif',
        },
        leftPanel: {
            flex: '1',
            display: 'flex',
            justifyContent: 'center',
            borderRight: '2px solid #eee',
            paddingRight: '30px',

        },
        rightPanel: {
            flex: '2',
            paddingLeft: '30px',
        },
        avatar: {
            fontSize: '400px',
            color: '#888',
        },
        section: {
            display: 'flex',
            justifyContent: 'space-between',
            alignItems: 'center',
            padding: '15px 20px',
            borderBottom: '1px solid #eee',
            backgroundColor: '#f9f9f9',
            borderRadius: '8px',
            marginBottom: '15px',
        },
        userInfo: {
            display: 'flex',
            alignItems: 'center',
            gap: '12px',
            fontSize: '16px',
            color: '#333',
        },
        input: {
            border: '1px solid #ccc',
            padding: '5px',
            flex: 1,
            marginLeft: '10px'
        }
    }

    const resetPassword = () => {
        e.preventDefault()

        router.post(route('main.users.reset-password', { user: user.id }))
    }

    return (
        <AuthenticatedLayout>
            <div className='dashboard-container' style={styles.container}>
                <div className="left-panel" style={styles.leftPanel}>
                    <span style={styles.avatar}>
                        <i className="fa-solid fa-user-circle"></i>
                    </span>
                </div>
                <div className="right-panel" style={styles.rightPanel}>
                    <EditedField
                        ico={(<i className="fa-solid fa-signature"></i>)}
                        label='213'
                        type={'text'}
                        name={'last_name'}
                        value={values.last_name}
                        onChange={(newValue) => setValues(prev => ({ ...prev, last_name: newValue }))}
                    />
                    <EditedField
                        ico={<i className="fa-solid fa-signature"></i>}
                        type={'text'}
                        name={'Имя'}
                        value={values.name}
                        onChange={(newValue) => setValues(prev => ({ ...prev, name: newValue }))}
                    />
                    <EditedField
                        ico={<i className="fa-solid fa-signature"></i>}
                        type={'text'}
                        name={'Отчество'}
                        value={values.mid_name}
                        onChange={(newValue) => setValues(prev => ({ ...prev, mid_name: newValue }))}
                    />
                    <EditedField
                        ico={<i className="fa-solid fa-envelope"></i>}
                        type={'email'}
                        name={'email'}
                        value={values.email}
                        onChange={(newValue) => setValues(prev => ({ ...prev, email: newValue }))}
                    />
                    <div className='password-container' style={styles.section}>
                        <div style={styles.userInfo}>
                            <span>
                                <i className="fa-solid fa-lock"></i>
                            </span>
                            <span>*********</span>
                        </div>
                        <EditIco onClick={() => { }} />
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
