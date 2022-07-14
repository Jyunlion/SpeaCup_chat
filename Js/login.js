const form = document.querySelector( '.login form' ),
      // @ts-ignore
      continueBtn = form.querySelector( '.button input' ),
      // @ts-ignore
      errorTexT = form.querySelector( '.error-txt' );

// @ts-ignore
form.onsubmit = ( e ) =>
{
      // @ts-ignore
      e.preventDefault();  //預防傳出錯誤的資料
}

// @ts-ignore
continueBtn.onclick = () =>
{
      let xhr = new XMLHttpRequest();
      xhr.open( "POST", "php/login.php", true );
      xhr.onload = () =>
      {
            if ( xhr.readyState === XMLHttpRequest.DONE )
            {
                  if ( xhr.status === 200 )
                  {
                        let data = xhr.response;
                        if ( data == "OK" )
                        {
                              location.href = "users.php"
                        } else
                        {
                              // @ts-ignore
                              errorTexT.textContent = data;
                              // @ts-ignore
                              errorTexT.style.display = "block";
                        }
                  }
            }
      }
      //將表單資料傳至PHP
      // @ts-ignore
      let formData = new FormData( form );
      xhr.send( formData );
}
