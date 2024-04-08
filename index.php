<?php 
	session_start();
	header("Access-Control-Allow-Origin: *");
	include("connection.php");
	include("functions.php");
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{
			$query = "select * from users where user_name = '$user_name' limit 1";
			$result = mysqli_query($con, $query);
			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{
					$user_data = mysqli_fetch_assoc($result);
					if($user_data['password'] === $password)
					{
						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: main.php");
						die;
					}
				}
			}
		}else
		{
        echo "<a>Wrong username or password.</a>";
		}
	}

?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>LogIn</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <!-- Custom styles for this template -->
    <link href="sign-in.css" rel="stylesheet">
<body class="d-flex justify-conten-center align-items-center">

<main class="form-signin w-100 m-auto border bg-dark">
  <form method="post" class="text-center text-white">
    <img class="mb-4" src="images/logo.png" alt="" width="72" height="72">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <div class="mb-3">
      <input type="text" class="form-control" name="user_name" placeholder="Username">
  </div>
  <div class="mb-3">
    <input type="password" class="form-control"  name="password" placeholder="Password">
  </div>

  
    <button class="btn btn-primary w-100 py-2 episode" id="button" type="submit">Sign in</button>
    <a href="signup.php">Register</a>
    <p class="mt-5 mb-3 text-white">&copy Kullai Marcell</p>
  </form>
</main>
    </body>
</html>
