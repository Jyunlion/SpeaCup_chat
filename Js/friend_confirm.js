// @ts-ignore
$( '.btnAccept' ).click( function ()
{
      // @ts-ignore
      type = $( this ).attr( 'data-type' );
      // @ts-ignore
      reqsendingfrom = $( this ).attr( 'data-reqsendingfrom' );
      // @ts-ignore
      button = $( this );
      // @ts-ignore
      $.post( `./php/action.php?action=RequestSection&sentRequest=${ reqsendingfrom }&type=${ type }`,
            function (
                  res )
            {
                  // alert(res);
                  if ( res == 'success_accepted' )
                  {
                        // console.log(button.parent());

                        // @ts-ignore
                        button.parent().parent().text( '你和 ' +
                              // @ts-ignore
                              reqsendingfrom + '是朋友了!' )
                  }
            } )
} )

// @ts-ignore
$( '.btnReject' ).click( function ()
{
      // @ts-ignore
      type = $( this ).attr( 'data-type' );
      // @ts-ignore
      reqsendingfrom = $( this ).attr( 'data-reqsendingfrom' );
      // @ts-ignore
      button = $( this );
      // @ts-ignore
      $.post( `./php/action.php?action=RequestSection&sentRequest=${ reqsendingfrom }&type=${ type }`,
            function (
                  res )
            {
                  // alert(res);
                  if ( res == 'success_Reject' )
                  {
                        // console.log(button.parent());

                        // @ts-ignore
                        button.parent().parent().text( '你拒絕了 ' +
                              // @ts-ignore
                              reqsendingfrom )
                  }
            } )
} )