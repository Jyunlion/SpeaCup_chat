const pswrField = document.querySelector( '.form input[type="password"]' ),
      toggleBtn = document.querySelector( ".form .field i" );

// @ts-ignore
toggleBtn.onclick = () =>
{
      // @ts-ignore
      if ( pswrField.type == "password" )
      {
            // @ts-ignore
            pswrField.type = "text";
            // @ts-ignore
            toggleBtn.classList.add( "active" );
      } else
      {
            // @ts-ignore
            pswrField.type = "password"
            // @ts-ignore
            toggleBtn.classList.remove( "active" );
      }
}

