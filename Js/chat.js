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


//隱藏聊天室窗
class InteractiveChatbox
{
    constructor ( a, b, c )
    {
        this.args = {
            button: a,
            chatbox: b
        }
        this.icons = c;
        this.state = false;
    }

    display ()
    {
        const { button, chatbox } = this.args;

        button.addEventListener( 'click', () => this.toggleState( chatbox ) )
    }

    toggleState ( chatbox )
    {
        this.state = !this.state;
        this.showOrHideChatBox( chatbox, this.args.button );
    }

    showOrHideChatBox ( chatbox, button )
    {
        if ( this.state )
        {
            chatbox.classList.add( 'chatbox--active' )
            this.toggleIcon( true, button );
        } else if ( !this.state )
        {
            chatbox.classList.remove( 'chatbox--active' )
            this.toggleIcon( false, button );
        }
    }

    toggleIcon ( state, button )
    {
        const { isClicked, isNotClicked } = this.icons;
        let b = button.children[ 0 ].innerHTML;

        if ( state )
        {
            button.children[ 0 ].innerHTML = isClicked;
        } else if ( !state )
        {
            button.children[ 0 ].innerHTML = isNotClicked;
        }
    }
}