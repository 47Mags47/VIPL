window.openFlash = () => {
    const delay = 500
    const lifetime = 3000

    let box = $('.flash-message-box')

    box.addClass('open')
    box.find('.flash-message').each(function (i) {
        setTimeout(() => {
            $(this).addClass('open')

            setTimeout(() => {
                $(this).removeClass('open')
                if ($(this).closest('.flash-message-box').find('.flash-message.open').length === 0)
                    setTimeout(() => {
                        $(this).closest('.flash-message-box').removeClass('open')
                    }, 500);
            }, lifetime);
        }, (i + 1) * delay);
    })
}
