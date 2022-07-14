
// @ts-ignore
function sendAction ( constant, user_id )
{
      // alert(unique_id);
      // @ts-ignore
      $.post( `./php/action.php?action=sendReq&user_id=${ user_id }`, function ( res )
      {
            // alert(res);
            if ( res == 'Request send, saved into DB' )
            {
                  // @ts-ignore
                  $( '#sendReq' ).hide()
                  // @ts-ignore
                  $( '#sendReq' ).parent().html( '邀請成功，等待對方確認!' )
            }
      } )
}



// @ts-ignore
function cancelAction ( constant, user_id )
{
      // alert(unique_id);
      // @ts-ignore
      $.post( `./php/action.php?action=cancelReq&user_id=${ user_id }`, function ( res )
      {
            // alert(res);
            if ( res == 'Request send, delete from DB' )
            {
                  // @ts-ignore
                  $( '#cancelReq' ).hide()
                  // @ts-ignore
                  $( '#cancelReq' ).parent().html( '已取消好友!' )
            }
      } )
}

