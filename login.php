<?php 
  session_start();
  require('database/database.php');
  $conn = get_connection();
  if(isset($_SESSION['email'])) {
    header('Location: homepage.php');
  }
  
  
  
  $email = '';
  $pass = '';
  $error = '';

  if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    
    $sql = 'SELECT username, password FROM user WHERE email = ? and password = ?';
    $stm = $conn->prepare($sql);
    $stm->bind_param('ss', $email, $pass);
    $stm->bind_result($get_email, $get_pass);
    $stm->execute();
    $result = $stm->get_result();
    #have account 
    if($result->num_rows > 0) {
      $error = '';
      $_SESSION['email'] = $email;
      header("refresh:0.5;url=/cuoiki/homepage.php");
      
      
    }
    else {
        $error = 'Wrong email or password';
        // echo "<button><a style='font-size: 16px; text-decoration: none; color: black;' href='login.html'>Go back to login page</a></button>";
    }

    $stm->free_result();
    $stm->close();
  }
  
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="login.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Sen&display=swap" rel="stylesheet">
</head>
<body>
  <div class="container">

    <form class="form-signin" method="post" action="login.php">
      <h2 class="form-signin-heading">Sign In</h2>
      <div class="account-control">
        <label for="email">Email: </label><br>
        <input value="<?= $email ?>" type="email" id="_email" class="form-control" placeholder="abc@gmail.com" name="email" required=""><br>
      </div>
      <div class="account-control">
        <label for="password">Password: </label><br>
        <input value="<?= $pass ?>" type="password" id="_password" class="form-control" placeholder="Password" name="password" required="">
      </div>
      <div class="error-message">
        <?php 
          if(!empty($error)) {
            echo "<div class='error' style='padding: 8px; background-color: #f17e7e; color: red; width: 50%; margin: auto; text-align: center'><span>$error</span></div>";
          }
        ?>
      </div>
      <div class="account-control">
        <button type="submit">Sign in</button>
        Or <a href="register.php">Create one</a>
      </div>
      

    </form>

  </div>
</body>
</html>