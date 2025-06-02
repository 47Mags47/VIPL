import { useState } from 'react';
import BaseButton from './BaseButton'
import { Modal } from 'antd'

export default function ModalButton({ children, buttonText, okHandle, closeHandle, openHandler, okText, cancelText }) {

    const [isModalOpen, setIsModalOpen] = useState(false);

    function open() {
        setIsModalOpen(true);
        if (openHandler !== undefined) openHandler()
    }

    function onCancel(handle) {
        setIsModalOpen(false);
        if (closeHandle !== undefined) closeHandle()
    }

    function onOk(handle) {
        if (okHandle !== undefined) okHandle()
    }

    return (
        <>
            <BaseButton onClick={open}>{buttonText}</BaseButton>

            <Modal
                open={isModalOpen} //bool

                onOk={onOk} // fn
                onCancel={onCancel} // fn

                okText={okText} // str
                cancelText={cancelText} //str

                destroyOnHidden={true} //bool
            >
                {children}
            </Modal>
        </>
    )
}