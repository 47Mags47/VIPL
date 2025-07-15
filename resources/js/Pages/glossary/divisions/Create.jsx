import { useForm }                                              from '@inertiajs/react'

import { AuthenticatedLayout as Layout }                        from '@/layouts';
import { VerticalForm as Form, StringInput as Input }   from '@/components/forms';


export default function Create() {
    const { data, setData, post, processing } = useForm({
        code: '',
        name: '',
    })

    function onSubmit(e) {
        e.preventDefault()

        post(route('glossary.divisions.store'), data)
    }

    return (
        <Layout>
            <Form
                header={'Новое подразделение'}
                sbm="Отправить"
                handleSubmit={onSubmit}
                processing={processing}
            >
                <Input
                    name="code"
                    label="Код"
                    value={data.code}
                    onChange={(e) => setData('code', e.target.value)}
                />
                <Input
                    name="name"
                    label="Наименование"
                    value={data.name}
                    onChange={(e) => setData('name', e.target.value)}
                />
            </Form>
        </Layout>
    )
}




