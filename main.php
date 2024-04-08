<?php
  session_start();
  header("Access-Control-Allow-Origin: *");
	include("connection.php");
	include("functions.php");
	$user_data = check_login($con);
?>
<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Music Webplayer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="cover.css" rel="stylesheet">
  </head>
  <body class="d-flex h-100 text-center">

  <div class="cover-container d-flex w-100 h-100 p-2 mx-auto flex-column">
  <header class="mb-auto">
    <div>
      <h3 class="float-md-start mb-0">Webplayer</h3>
      <nav class="nav nav-masthead justify-content-center float-md-end">
        <a class="nav-link fw-bold py-1 px-0" aria-current="page" href="UCP.php">Control Panel</a>
        <a class="nav-link fw-bold py-1 px-0" href="logout.php">Log out</a>
      </nav>
    </div>
  </header>

  <main class="px-3 pt-5">
    <div class="episodes w-25 d-inline-block align-top mx-2">
      <button class="episode" data-spotify-id="spotify:playlist:37i9dQZEVXbMDoHDwVN2tF">TOP 50</button>
      <button class="episode" data-spotify-id="spotify:playlist:6jIYyVquAPU5q5tHaQuVVO">My Playlist</button>
      <button class="episode" data-spotify-id="spotify:playlist:64uDcllVshmD98cl3ojGbk">Trance Music</button>
      <button class="episode" data-spotify-id="" id="custom" onclick="addFavorite()">Custom Link</button>
      <form>
      <input class="w-100" type="text" id="playlist" name="playlist" placeholder="Playlist ID">
      <input class="w-100" type="text" id="description" name="playlist" placeholder="Description">
      </form>
    </div>
    <div id="jofejke"></div>

    <h1>Song player</h1>
    <div class="text-center d-flex gap-2">
    <button class="episode" id="load" style="width: 50%;">Load Random Songs</button>
    <button class="episode" style="width: 50%;" onclick="addTrack()">Add to your favorites</button>
    </div>
      <iframe style="border-radius:12px" src="https://open.spotify.com/embed/track/6VruexMGmO8zonX9LIU4cK?utm_source=generator" width="90%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy" id="jofejke"></iframe>
  </main>

  <script>
    function addTrack() {
      var xd = document.getElementById('jofejke').src.substring(37,59);
      let myFormData = new FormData();
      myFormData.append('track_id', xd);

    let configObj = {
      method: 'POST',
      body: myFormData
    }


    postData('setTracks.php', renderResult, configObj);
    }
    function addFavorite() {
    let playlist = document.getElementById('playlist').value;
    let desc = document.getElementById('description').value;
    if(playlist.length == 22 && desc.length > 0) {
      let myFormData = new FormData();
      myFormData.append('playlist_id', playlist);
      myFormData.append('description', desc);
    
    let configObj = {
      method: 'POST',
      body: myFormData
    }
    postData('setPlaylist.php', renderResult, configObj);
  }
}
  function renderResult(data) {
    console.log(data.msg);
  }
</script>

  <footer class="mt-auto text-white">
    <p>© Kullai Marcell</p>
  </footer>
  </div>
  <script src="javascripts/playlists.js"></script>
  <script src="javascripts/songs.js" defer></script>
  <script src="https://open.spotify.com/embed/iframe-api/v1" async></script>
  </body>
  </html>