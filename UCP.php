<?php 
  session_start();
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
  <body class="d-flex h-100 ">

  <div class="cover-container d-flex w-100 h-100 p-2 mx-auto flex-column">
  <header class="mb-auto">
    <div>
      <h3 class="float-md-start mb-0">Webplayer</h3>
      <nav class="nav nav-masthead justify-content-center float-md-end">
        <a class="nav-link fw-bold py-1 px-0" aria-current="page" href="main.php">Main Page</a>
        <a class="nav-link fw-bold py-1 px-0" href="logout.php">Log out</a>
      </nav>
    </div>
  </header>

  <main class="px-3 pt-1">
   <h1 class="text-center">Welcome <?php echo $user_data['user_name']; ?></h1>
   <a>User ID: <?php echo $user_data['id']; ?></a><br>
   <a>Registration date: <?php echo $user_data['date']; ?></a>
   <br>

   <table class="table table-bordered table-dark mt-5">
      <thead>
        <tr>
          <th>Your Playlist History</th>
          <th>Date of Use</th>
          <th>Description</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
   </table>

   <table class="table table-bordered table-dark mt-5">
    <thead>
      <tr>
        <th>Your favorites songs id's</th>
        <th>Date of add</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="okoska">

    </tbody>
  </table>
  </main>

  <script>
    let configObj = {
      method: 'GET',
      mode: 'cors',
      headers: {
        'Content-Type' : 'application/json'
      }
    }
    getData('getPlaylist.php', renderTable)

    function renderTable(data) {
      for (const obj of data) {
        document.querySelector('tbody').innerHTML += `
        <tr>
        <td>${obj.playlist_id}</td>
        <td>${obj.date}</td>  
        <td>${obj.description}</td>
        </tr>
        `
      }
    }

    getData("getTracks.php", renderTable2)

    function renderTable2(data) {
      for (const obj of data) {
        document.getElementById('okoska').innerHTML += `
        <tr>
        <td>${obj.track_id}</td>
        <td>${obj.date}</td>
        <td onclick="deleteFav('${encodeURIComponent(obj.track_id)}', '${encodeURIComponent(obj.date)}')">🗑</td>
        </tr>
        `
      }
    }
    function renderResult(data) {
      console.log(data);
    }

	function deleteFav(track_id, date) {
    	var url = "deleteTracks.php?track_id=" + encodeURIComponent(track_id) + "&date=" + encodeURIComponent(date);
    	deleteData(url, renderResult);
	}

  </script>

  <footer class="mt-auto text-white">
    <p class="text-center">© Kullai Marcell</p>
  </footer>
  </div>
  </body>
  </html>