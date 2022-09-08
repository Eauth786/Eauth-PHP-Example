<?php
include ("eauth.php");
$auth = new eauth();
$auth->init();

if (isset($_SESSION['username']))
{
    header("Location: dashboard.php");
    exit();
}
if (isset($_POST['login']))
{
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    if ($auth->signin($Username, $Password) == true)
    {
      header("Location: dashboard.php");
      exit();
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="The Unique Cutting Edge Authentication System">
    <meta name="author" content="Muhammad786">
    <title>Eauth · PHP Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <style>
                @import url('https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap');
*
{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}
              body {
        background-color: rgb(44,48,52);
        color: white;
      }
      .modal-content { background: rgb(44,48,52) !important; }
      .body-bg { background: rgb(44,48,52) !important; }
      .form-control {
        border-color: rgb(44,48,52);
        box-shadow: 0px 1px 1px rgb(44,48,52) inset, 0px 0px 8px rgb(44,48,52);
         background-color: rgb(44,48,52);
         color:gray;
    }
      .form-control:focus {
        border-color: rgb(44,48,52);
        box-shadow: 0px 1px 1px rgb(44,48,52) inset, 0px 0px 8px rgb(44,48,52);
         background-color: rgb(44,48,52);
         color:gray;
    }
    .form-control:disabled {
        border-color: rgb(44,48,52);
        box-shadow: 0px 1px 1px rgb(44,48,52) inset, 0px 0px 8px rgb(44,48,52);
         background-color: rgb(44,48,52);
         color:gray;
    }
    </style>

    
    <!-- Custom styles for this template -->
  </head>
  <body class="text-center">
    <div class="col d-flex justify-content-center">
<form method="POST">
<br>
    <img class="mb-4" src="eauth.png" alt="" width="100" height="100">
    <div class="card text-white bg-dark" style="width: 19rem;">
  <class="card-img-top" alt="...">
  <div class="card-body">
<main class="form-signin w-90 m-auto">
    <h1 class="h5 mb-3 fw-normal">Login to continue...</h1>
    <div class="form-floating">
    <input class="form-control mt-3" placeholder="Username" type="text" name="Username" required/>
    <label for="floatingPassword">Username</label>
</div>
    <div class="form-floating">
    <input class="form-control mt-3" placeholder="Password" type="password" name="Password" required/>
      <label for="floatingPassword">Password</label>
    </div>
    <button class="w-100 btn btn-lg btn-primary mt-3" name="login" type="submit">LOG IN</button>
    <a class="w-100 btn btn-lg btn-primary mt-3" href="register.php" type="button">Create Account</a>
    <p class="mt-5 mb-3 text-muted">&copy; 2021–2022</p>
</main>
  </div>
  </class>
    </div>
</form>
    </div>
  </body>
</html>
