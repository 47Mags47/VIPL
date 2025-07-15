import { useForm, usePage } from '@inertiajs/react'

import { EditableText } from '@/components/forms'


export default function Index() {
    const user = usePage().props.current_user.data

    const { data, setData, put, processing } = useForm({
        name: user.name,
        email: user.email,
    })

    function onSubmit(e) {
        put(route('main.users.update', { user: user.id }), data)
    }

    return (
        <div className="dashboard-container">
            <div className="left-panel">
                <span>
                    <i className="fa-solid fa-user-circle"></i>
                </span>
            </div>
            <div className="right-panel">
                <EditableText
                    name="name"
                    label="ФИО"
                    value={data.name}
                    onChange={(e) => setData('name', e.target.value)}
                    onBlur={onSubmit}
                />
                <EditableText
                    name="email"
                    label="Email"
                    value={data.email}
                    onChange={(e) => setData('email', e.target.value)}
                    onBlur={onSubmit}
                />
            </div>
        </div>
    )
}

// import { useState } from 'react';
// import { useForm, usePage } from '@inertiajs/react';
// import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
// import Input from '@/components/forms/inputs/Input';

// import EditIco from '@/components/icons/EditIco';
// import CheckIco from '@/components/icons/CheckIco';
// import BlueButton from '@/components/buttons/BlueButton';

// export default function Index() {
//     const user = usePage().props.current_user.data;

//     const { data, setData, put, processing } = useForm({
//         name: user.name,
//         email: user.email,
//     })

//     const [editing, setEditing] = useState(false);

//     const handleSubmit = (e) => {
//         e.preventDefault()
//         put(route('main.users.update', { user: user.id }), data)
//         setEditing(false);
//     };

//     const styles = {
//         container: {
//             display: 'flex',
//             padding: '30px',
//             backgroundColor: '#fff',
//             borderRadius: '12px',
//             boxShadow: '4px 4px 32px 16px #eee',
//             maxWidth: '1700px',
//             minHeight: '700px',
//             margin: '40px auto',
//             fontFamily: 'Arial, sans-serif',
//         },
//         leftPanel: {
//             flex: '1',
//             display: 'flex',
//             justifyContent: 'center',
//             borderRight: '2px solid #eee',
//             paddingRight: '30px',
//         },
//         rightPanel: {
//             flex: '2',
//             paddingLeft: '30px',
//         },
//         avatar: {
//             fontSize: '400px',
//             color: '#888',
//         },
//         fieldContainer: {
//             display: 'flex',
//             flexDirection: 'column',
//             gap: '5px',
//             marginBottom: '15px',
//         },
//         section: {
//             display: 'flex',
//             justifyContent: 'space-between',
//             alignItems: 'center',
//             padding: '15px 20px',
//             borderBottom: '1px solid #eee',
//             backgroundColor: '#f9f9f9',
//             borderRadius: '8px',
//         },
//         userInfo: {
//             display: 'flex',
//             alignItems: 'center',
//             gap: '12px',
//             fontSize: '16px',
//             color: '#333',
//         },
//         input: {
//             border: '1px solid #ccc',
//             padding: '5px',
//             flex: 1,
//             marginLeft: '10px',
//         },
//         label: {
//             fontWeight: 'bold',
//             fontSize: '14px',
//             color: '#555',
//         },
//     };

//     function EditedField({ label, name, ico, type = 'text' }) {
//         return (
//             <div style={styles.fieldContainer}>
//                 <label style={styles.label}>{label}</label>
//                 <div style={styles.section}>
//                     <div style={styles.userInfo}>
//                         <span>{ico}</span>
//                         {editing ? (
//                             <Input
//                                 type={type}
//                                 name={name}
//                                 value={data[name]}
//                                 onChange={(e) => setData(name, e.target.value)}
//                                 style={styles.input}
//                                 autoFocus
//                             />
//                         ) : (
//                             <span>{data[name]}</span>
//                         )}
//                     </div>
//                     <div style={{ marginTop: '20px' }}>
//                         {editing ?
//                             <BlueButton
//                                 onClick={handleSubmit}
//                             >
//                                 Сохранить
//                             </BlueButton>
//                             :
//                             <BlueButton
//                                 onClick={() => setEditing(true)}
//                             >
//                                 Редактировать
//                             </BlueButton>
//                         }
//                     </div>
//                 </div>
//             </div>
//         )
//     }

//     return (
//         <AuthenticatedLayout>
//             <div className="dashboard-container">
//                 <div className="left-panel">
//                     <span>
//                         <i className="fa-solid fa-user-circle"></i>
//                     </span>
//                 </div>

//                 <div className="right-panel">
//                     <form>
//                         <EditedField
//                             label="Имя"
//                             name="name"
//                             ico={<i className="fa-solid fa-signature"></i>}
//                             type="text"
//                         />
//                         <EditedField
//                             label="Email"
//                             name="email"
//                             ico={<i className="fa-solid fa-envelope"></i>}
//                             type="email"
//                         />
//                     </form>
//                 </div>
//             </div>
//         </AuthenticatedLayout>
//     );
// }
