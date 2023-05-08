<?php 
    session_start();

    if(!isset($_SESSION['email'])) {
        echo "<script>alert('You need to login to continue')</script>";
        header("refresh:1;url=/cuoiki/login.php");
        die();
    }
    
    
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="genre.css">
    <script src="https://kit.fontawesome.com/ad1797946c.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Sen&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="awsome-icons/css/solid.css">

    <script src="js/index.js"></script>
     
  </head>
  <body>
    <?php include('navbar.php'); ?>
    <header>
      <nav>

        <div class="logo-container">
          <h1 class="logo">Music<span>Universe</span></h1>
        </div>
        <div class="menu-container">
          <ul class="menu-list">
            <li class="menu-items"><a href="homepage.php">Home</a></li>
            <li class="menu-items active">
              <a href="genres.php" class="dropdown-link">Genres</a>
              <div class="dropdown-menu">
                <a href="#">Genre 1</a>
                <a href="#">Genre 2</a>
                <a href="#">Genre 3</a>
    <!-- Add more genres as needed -->
              </div>
              <script>
                const navbar = document.querySelector('nav');
                const dropdownLink = document.querySelector('.dropdown-link');
                const dropdownMenu = document.querySelector('.dropdown-menu');
                  
                dropdownLink.addEventListener('mouseenter', (e) => {
                  // Get the cursor position
                  const cursorX = e.clientX;
                  const cursorY = e.clientY;
                
                  // Get the position of the navbar
                  const navbarTop = navbar.offsetTop;
                
                  // Set the position of the dropdown menu
                  dropdownMenu.style.display = 'block';
                  dropdownMenu.style.left = cursorX + 'px';
                  dropdownMenu.style.top = navbarTop + navbar.offsetHeight + 'px';
                });
                
                dropdownLink.addEventListener('mouseleave', () => {
                  dropdownMenu.style.display = 'none';
                });



              </script>
            </li>
            <li class="menu-items">
              <a href="artists.php" id="display-link">Artists</a>
              
            </li>
            <li class="menu-items"><a href="playlists.php">Playlists</a></li>
            <li class="menu-items"><a href="albums.php">Albums</a></li>
            <?php 
                if($username === 'admin') {
                    ?>
                    <li class="menu-items"><a href="users.php">Users</a></li>
                    <?php
                }
            ?>
          </ul>
        </div>
        <div class="profile-container">
          <div class="profile">
            <!-- <img class="avatar" src="\cuoiki\cuoiki\45923332.jpg" alt=""> -->
            <div class="avatar" style="text-align: center ">
              <i class="fa-solid fa-circle-user"></i>
            </div>
            <div class="user" style="margin-bottom: 5px;">
                Hi, <span class="username" style="font-size: 15px; color: #6ba4e6"><?= $username ?></span>
            </div>
          </div>
          <div class="account-options" style="margin-left: 10px;">
            <a href="logout.php">Log out</a>
          </div>
        </div>
        
      </nav>
    </header>
    <main>
      
      
    </main>
    
  </body>
</html>
