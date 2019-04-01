<?php

session_start();
require "database.php";
$labelError = "";

// Get email and password if form has been submitted
if(!empty($_POST)) {
    $email = htmlspecialchars($_POST['email']);
	  $password = htmlspecialchars($_POST['password']);
	  $password_hash = MD5($password);
    $labelError = "";
    
    // verify email and password
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM customers WHERE email = ? AND password_hash = ? LIMIT 1";
    $q = $pdo->prepare($sql);
    $q->execute(array($email,$password_hash));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    // If username and password match db send user to customers.php
    if($data){
        $_SESSION["email"] = $email;
        header("Location: customers.php ");
    }
    // Otherwise display error
    else{
        Database::disconnect();
        $labelError = "Incorrect username/password";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset='UTF-8'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</head>

<body>
    <div class="container">

      <div class="row justify-content-center">
          <h3>Login</h3>
      </div>

      <div class="row justify-content-center">
        <form id="loginForm" method="post" action="login.php">
          <div class="form-group" id="login-form">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="email@email.com">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password"placeholder="Password">
          </div>
          <button type="submit" class="btn btn-primary" name="submitButton" id="submitButton">Submit</button>
          <a class="btn btn-secondary" href="join.php">Join</a>
        </form>
      </div>

      <div>
        <?php
          echo "<br>";
          echo "<span style='color: red;' class='help-inline'>";
          echo "&nbsp;&nbsp;" . $labelError;
          echo "</span>";
          echo "<br>";
        ?>
      </div>
    </div>
  </body>  
</html>