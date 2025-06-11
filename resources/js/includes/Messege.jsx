const Message = (type, content, messageApi) => {

    messageApi[type]({
        content,
    })
}
export default Message