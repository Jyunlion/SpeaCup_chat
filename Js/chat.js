const form = document.querySelector( ".typing-area" ),
    // @ts-ignore
    incoming_id = form.querySelector( ".incoming_id" ).value,
    // @ts-ignore
    inputField = form.querySelector( ".input-field" ),
    // @ts-ignore
    sendBtn = form.querySelector( "button" ),
    chatBox = document.querySelector( ".chat-box" );

// @ts-ignore
form.onsubmit = ( e ) =>
{
    e.preventDefault();
}

// @ts-ignore
inputField.focus();
// @ts-ignore
inputField.onkeyup = () =>
{
    // @ts-ignore
    if ( inputField.value != "" )
    {
        // @ts-ignore
        sendBtn.classList.add( "active" );
    } else
    {
        // @ts-ignore
        sendBtn.classList.remove( "active" );
    }
}

// @ts-ignore
sendBtn.onclick = () =>
{
    let xhr = new XMLHttpRequest();
    xhr.open( "POST", "php/insert-chat.php", true );
    xhr.onload = () =>
    {
        if ( xhr.readyState === XMLHttpRequest.DONE )
        {
            if ( xhr.status === 200 )
            {
                // @ts-ignore
                inputField.value = "";  //輸入後清空
                scrollToBottom();
            }
        }
    }
    // @ts-ignore
    let formData = new FormData( form );
    xhr.send( formData );
}

//限制更新
// @ts-ignore
chatBox.onmouseenter = () =>
{
    // @ts-ignore
    chatBox.classList.add( "active" );
}

// @ts-ignore
chatBox.onmouseleave = () =>
{
    // @ts-ignore
    chatBox.classList.remove( "active" );
}

setInterval( () =>
{
    let xhr = new XMLHttpRequest();
    xhr.open( "POST", "php/get-chat.php", true );
    xhr.onload = () =>
    {
        if ( xhr.readyState === XMLHttpRequest.DONE )
        {
            if ( xhr.status === 200 )
            {
                let data = xhr.response;
                // @ts-ignore
                chatBox.innerHTML = data;
                // @ts-ignore
                if ( !chatBox.classList.contains( "active" ) )
                {
                    scrollToBottom();
                }
            }
        }
    }
    xhr.setRequestHeader( "Content-type", "application/x-www-form-urlencoded" );
    xhr.send( "incoming_id=" + incoming_id );
}, 500 );

function scrollToBottom ()
{
    // @ts-ignore
    chatBox.scrollTop = chatBox.scrollHeight;
}
