<?php
include ("eauth.php");
$auth = new eauth();

if (!isset($_SESSION['username']))
{
    header("Location: index.php");
    exit();
}
if (isset($_POST['logout']))
{
    session_reset();
    session_destroy();
    header("Location: index.php");
    exit();
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
    <p>Username: <?php echo $_SESSION['username']?></p>
    <p>Rank: <?php echo $_SESSION['rank']?></p>
    <p>Create Date: <?php echo $_SESSION['createdate']?></p>
    <p>Expire Date: <?php echo $_SESSION['expiredate']?></p>
    <p>Hardware ID: <?php echo $_SESSION['hwid']?></p>
    <!-- <p>Variable: <?php //echo $auth->grabVariable("your variable id here")?></p> -->
    <button class="w-100 btn btn-lg btn-primary mt-3" name="logout" type="submit">Sign out</button>
</main>
  </div>
  </class>
    </div>
</form>
    </div>
  </body>
</html>
