import { useEffect, useState } from 'react';
import BaseButton from './BaseButton'
import { Modal } from 'antd'

export default function ModalButton({
    open,
    children,
    buttonText,
    buttonClickHandler,
    okHandler,
    cancelHandler,
    changeState,
    footer
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
            <BaseButton onClick={buttonClickHandler}>{buttonText}</BaseButton>

            <Modal
                open={modalShow}
                onOk={okHandler}
                onCancel={cancelHandler}
                destroyOnHidden={true}
                footer={footer}
            >
                {children}
            </Modal>
        </>
    )
}
