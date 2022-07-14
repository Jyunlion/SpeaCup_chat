const searchBar = document.querySelector( '.users .search input' ),
      searchBtn = document.querySelector( '.users .search button' ),
      // @ts-ignore
      usersList = document.querySelector( '.users .users-list' );

// @ts-ignore
searchBtn.onclick = () =>
{
      // @ts-ignore
      searchBar.classList.toggle( "show" );
      // @ts-ignore
      searchBar.focus();
      // @ts-ignore
      searchBtn.classList.toggle( "active" );
      // @ts-ignore
      if ( searchBar.classList.contains( "active" ) )
      {
            // @ts-ignore
            searchBar.value = "";
            // @ts-ignore
            searchBar.classList.remove( "active" );
      }
}


// @ts-ignore
searchBar.onkeyup = () =>
{
      // @ts-ignore
      let searchTerm = searchBar.value;
      if ( searchTerm != "" ) //避免一直更新畫面
      {
            // @ts-ignore
            searchBar.classList.add( "active" );
      } else
      {
            // @ts-ignore
            searchBar.classList.remove( "active" );
      }
      let xhr = new XMLHttpRequest();
      xhr.open( "POST", "php/search.php", true );
      xhr.onload = () =>
      {
            if ( xhr.readyState === XMLHttpRequest.DONE )
            {
                  if ( xhr.status === 200 )
                  {
                        let data = xhr.response;
                        // @ts-ignore
                        usersList.innerHTML = data;
                  }
            }
      }
      xhr.setRequestHeader( "Content-type", "application/x-www-form-urlencoded" );
      xhr.send( "searchTerm=" + searchTerm );
}

setInterval( () =>
{
      let xhr = new XMLHttpRequest();
      xhr.open( "GET", "php/users.php", true );
      xhr.onload = () =>
      {
            if ( xhr.readyState === XMLHttpRequest.DONE )
            {
                  if ( xhr.status === 200 )
                  {
                        let data = xhr.response;
                        // @ts-ignore
                        if ( !searchBar.classList.contains( "active" ) )//避免一直更新畫面
                        {
                              // @ts-ignore
                              usersList.innerHTML = data;
                        }
                  }
            }
      }
      xhr.send();
}, 500 );