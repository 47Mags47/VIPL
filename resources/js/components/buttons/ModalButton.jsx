// DELETE

import { useEffect, useState } from 'react';
import { Modal } from 'antd'

export default function ModalButton({
    open,
    children,
    Button,
    buttonClickHandler,
    okHandler,
    cancelHandler,
    changeState,
    footer,
    maskClosable,
    closable
}) {
    const [modalShow, changeModalShow] = useState(false);

    useEffect(() => {
        changeModalShow(open)
    }, [open])

    buttonClickHandler = buttonClickHandler ?? (() => {
        changeModalShow(true)
        changeState(true)
    })

    okHandler = okHandler ?? (() => {
        changeModalShow(false)
        changeState(false)
    })

    cancelHandler = cancelHandler ?? (() => {
        changeModalShow(false)
        changeState(false)
    })
    return (
        <>
            <Button onClick={buttonClickHandler} />
            <Modal
                className='modal'
                closable={closable}
                maskClosable={maskClosable}
                open={modalShow}
                onOk={okHandler}
                onCancel={cancelHandler}
                destroyOnHidden={true}
                footer={footer}
                width ='min-content'
            >
                {children}
            </Modal>

        </>
    )
}
