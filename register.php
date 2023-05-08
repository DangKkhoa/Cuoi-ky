<?php 
    require_once('database/database.php');
    $conn = get_connection();

    $error = '';

    $username = '';
    $email = '';
    $pass = '';
    $pass_check = '';

    function user_exist($username, $email) {
        $sql = "SELECT * FROM user where username = ? or email = ?";
        $conn = get_connection();
        $stm = $conn->prepare($sql);
        $stm->bind_param('ss', $username, $email);
        $stm->execute();
        $result = $stm->get_result();

        if ($result->num_rows > 0) {
            return true;
        }

        return false;
    }
    if(isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['pwd_check'])) {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $pass = $_POST['password'];
        $pass_check = $_POST['pwd_check'];
        if($username === 'admin' or $email === 'admin@gmail.com') {
            echo "<script>alert('This account is not valid. Please try other username of email')</script>";
            header("refresh:0.1;url=/cuoiki/register.php");
        }
        elseif (user_exist($username, $email)) {
            $error = "Email or ueser has been used!";
            // echo "<button><a style='text-decoration: none; font-size: 16px; color: black;' href='register.html'>Go back to register page</a></button>";
            // die();
        }
        elseif(strlen($pass) < 6 or strlen($username) < 8) {
            $error = "Too short password or username";
            // echo "<button><a style='text-decoration: none; font-size: 16px; color: black;' href='register.html'>Go back to register page</a></button>";
            // die();
        }
    
        elseif($pass != $pass_check) {
            // echo "<p style='font-size: 16px; margin-top: 15px;'>The passwords are different. Please try again</p>";
            $error = "Passwords are different";
            // echo "<button><a style='text-decoration: none; font-size: 16px; color: black;' href='register.html'>Go back to register page</a></button>";
        } 
        else {
            $sql = "INSERT INTO user(username, email, password) VALUES (?, ?, ?)";
            $stm = $conn->prepare($sql);
            $stm->bind_param('sss', $username, $email, $pass);
    
            if(!$stm->execute()) {
                // echo "<p style='font-size: 16px; margin-top: 15px;'>Unexpected error occured. Please try again</p>";
                // echo "<button><a style='text-decoration: none; font-size: 16px; color: black;' href='register.html'>Go back to register page</a></button>";
                $error = "Unexpected error occcured. Please try again";
            }
            else {
                // echo "<p style='font-size: 16px; margin-top: 15px;'>You have successfully create a new account</p>";
                echo "<script>alert('Created account successfully. Click OK to Sign In')</script>";
                header("refresh:0.5;url=/cuoiki/login.php");        
            }
            $stm->free_result();
            $stm->close();
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Page</title>
  <link rel="stylesheet" href="register.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Sen&display=swap" rel="stylesheet">
</head>
<body>
  <div class="container">

    <form class="form-signin" method="post" action="register.php">
        <h2 class="form-signin-heading">Sign Up</h2>
        <div class="account-control">
          <label for="email">Email: </label><br>
          <input value="<?= $email ?>" type="email" id="_email" class="form-control" placeholder="abc@gmail.com" name="email" required=""><br>
        </div>

        <div class="account-control">
          <label for="username">Username: </label><br>
          <input value="<?=$username?>" type="text" id="_username" class="form-control" placeholder="6 charaters or more..." name="username" required=""><br>
        </div>
        <div class="account-control">
          <label for="password">Password: </label><br>
          <input type="password" id="_password" class="form-control" placeholder="6 charaters or more..." name="password" required="">
        </div>
        <div class="account-control">
          <label for="password">Check password: </label><br>
          <input type="password" id="_password" class="form-control" placeholder="6 charaters or more..." name="pwd_check" required="">
        </div>
        <div class="error-message">
            <?php 
              if(!empty($error)) {
                echo "<div class='error' style='padding: 8px; background-color: #f17e7e; color: red; width: 50%; margin: auto; text-align: center'><span>$error</span></div>";
              }
            ?>
        </div>
        <div class="account-control">
            <div>
                <button type="submit">Create account</button>
            </div>
            <div>
                <a href="login.php">Log in</a>
            </div>
        </div>
      

    </form>

  </div>
</body>
</html>