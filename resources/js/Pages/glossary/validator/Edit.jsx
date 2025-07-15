import { useState } from 'react'
import { useForm, usePage } from '@inertiajs/react'

import { AuthenticatedLayout as Layout } from '@/layouts'
import List from '@/components/List'
import { VerticalForm as Form, StringInput as Input, Select, EditableList } from '@/components/forms'
import BlueButton from '@/components/buttons/BlueButton'
import PaperclipIco from '@/components/icons/PaperclipIco'

export default function Edit() {
    const column = usePage().props.column.data

    const [showMemo, setShowMemo] = useState(false)

    const { data, setData, put, processing } = useForm({
        code: column.code,
        name: column.name,
        file_pos: column.position,
        required: column.required,
        patterns: column.patterns,
        type_id: column.type.id
    })

    // const memoList = [
    //     '"#"- число',
    //     '"." - любой символ',
    //     '"@" - любая буква',
    //     '"a" - русская строчная буква',
    //     '"А" - русская заглавная буква',
    //     '"z" - английская строчная буква',
    //     '"Z" - английская заглавная буква',
    //     '"*" - любое количество символов',
    // ]

    function onSubmit(e) {
        e.preventDefault()
        put(route('glossary.validator.update', { column: column.id }))
    }

    return (
        <Layout>
            <div className='edit-validator-container' style={{ position: 'relative' }}>
                <Form
                    header={column.name}
                    sbm="Отправить" position relative
                    handleSubmit={onSubmit}
                    processing={processing}
                >
                    <Input
                        name="code"
                        label="Код"
                        value={data.code}
                        onChange={(e) => setData('code', e.target.value)}
                        disabled
                    />
                    <Input
                        name="name"
                        label="Наименование"
                        value={data.name}
                        onChange={(e) => setData('name', e.target.value)}
                        disabled
                    />
                    <Input
                        name="file_pos"
                        label="Позиция"
                        value={data.file_pos}
                        onChange={(e) => setData('file_pos', e.target.value)}
                    />
                    <Select
                        name="type_id"
                        label="Тип"
                        list={usePage().props.types.data}
                        item_value="name"
                        value={data.type_id}
                        onChange={(value) => setData('type_id', value)}
                    />
                    <EditableList
                        label="Шаблоны"
                        name="patterns"
                        value={data.patterns}
                        onChange={(value) => setData('patterns', value)}
                    />
                </Form>
                <BlueButton
                    style={{
                        position: 'fixed',
                        top: '50%',
                        right: showMemo ? '300px' : '0px',
                        transform: 'translateY(-50%)',
                        zIndex: 50,
                        border: 'none',
                        borderRadius: '7px 0 0 7px',
                        transition: 'right 0.3s ease',
                    }}
                    type={'button'}
                    onClick={() => setShowMemo(prev => !prev)}
                >
                    <PaperclipIco />
                </BlueButton>
                <div
                    style={{
                        position: 'fixed',
                        top: '70px',
                        right: showMemo ? '0' : '-320px',
                        height: '100vh',
                        width: '300px',
                        backgroundColor: '#fff',
                        boxShadow: '-2px 0 5px rgba(0,0,0,0.1)',
                        padding: '20px',
                        zIndex: 40,
                        transition: 'right 0.3s ease',
                    }}
                >
                    <List
                        // style={{
                        //     border: 'none'
                        // }}
                        // name="memo"
                        value={[
                            '"#"- число',
                            '"." - любой символ',
                            '"@" - любая буква',
                            '"a" - русская строчная буква',
                            '"А" - русская заглавная буква',
                            '"z" - английская строчная буква',
                            '"Z" - английская заглавная буква',
                            '"*" - любое количество символов',
                        ]}
                    // itemrender={(item, index) => (
                    //     <span>{item}</span>
                    // )}
                    // render={(item) => <span>{item}</span>}
                    // hasDelete={false}
                    // hasAdd={false}
                    />
                </div>
            </div>
        </Layout>
    )
}
