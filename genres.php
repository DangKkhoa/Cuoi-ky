<?php 
    session_start();

    if(!isset($_SESSION['email'])) {
        echo "<script>alert('You need to login to continue')</script>";
        header("refresh:1;url=/cuoiki/login.php");
        die();
    }
    else {
        $email = $_SESSION['email'];
        require_once('database/database.php');
        $conn = get_connection();

        $sql = "SELECT username FROM user WHERE email = ?";

        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $email);
        $stm->execute();
        $stm->bind_result($username);
        $stm->fetch();
        $stm->close();
        $conn->close();

    }
    
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/ad1797946c.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Sen&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="awsome-icons/css/solid.css">

    <script src="js/index.js"></script>
     
  </head>
  <body>
    <header>
      <nav>
        <div class="logo-container">
          <h1 class="logo">Music<span>Universe</span></h1>
        </div>
        <div class="menu-container">
          <ul class="menu-list">
            <li class="menu-items"><a href="homepage.php">Home</a></li>
            <li class="menu-items active"><a href="genres.php">Genres</a></li>
            <li class="menu-items"><a href="artists.php" id="display-link">Artists</a></li>
            <li class="menu-items"><a href="playlists.php">Playlists</a></li>
            <li class="menu-items"><a href="albums.php">Albums</a></li>
            
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
      <form class="form-control" action="home.php" method="POST">
        <input type="search" name="music" id="" placeholder="Enter music name...">
        <button class="search-btn" type="submit"><i class="fa-solid fa-headphones"></i></button>
      </form>
      <div class="greeting">
        <h1>Welcome to My Music Website</h1>
        <p>Listen to your favorite music anytime, anywhere.</p>
      </div>
      
      <section>
        <h2 class="categories">Top Tracks</h2>
        
        
        <div class="grid-container">
          <div class="item">
            <div class ="item">
                <img src="images/chimsau.jpg" alt="Chim sau">
                <h3>Chìm sâu</h3>
                <p>MCK, Trung Trần</p>
                <audio controls>
                  <source src="songs/ChimSau_MCKTrungTran_7205660.ogg" type="audio/ogg">
                </audio>

            </div>
            <div class="reaction">
              <a href="my_playlist.php?song_id=<?php echo "$song_id" ?>" class="reaction-form"><i class="fa-solid fa-star"></i></a>
              <a href="" class="reaction-form"><i class="fa-solid fa-heart"></i></a>
            </div>
          </div>
          <div class="item">
            <div class ="item">
                <img src="images/ngu1m.jpg" alt="Ngu mot minh">
                <h3>Ngủ Một Mình</h3>
                <p>HIEUTHUHAI</p>
                <audio controls>
                  <source src="NguMotMinh-HIEUTHUHAINegavKewtiie-8267763.ogg" type="audio/ogg">
                </audio>

            </div>
            <form class="reaction-form" action="home.php" method="post">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-heart"></i>
            </form>
          </div>   
          
          <div class="item">
            <div class ="item">
                <img src="images/mono.jpg" alt="Waiting for you">
                <h3>Waiting For You</h3>
                <p>MONO</p>
                <audio controls>
                  <source src="track1.mp3" type="audio/mpeg">
                </audio>

            </div>

            <form class="reaction-form" action="home.php" method="post">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-heart"></i>
            </form>
          </div>   
          
          <div class="item">
            <div class ="item">
                <img src="images/tiny.jpg" alt="Tiny love">
                <h3>Tiny Love</h3>
                <p>Thịnh Suy</p>
                <audio controls>
                  <source src="track1.mp3" type="audio/mpeg">
                </audio>

            </div>

            <form class="reaction-form" action="home.php" method="post">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-heart"></i>
            </form>
          </div>   
          

          <div class="item">
            <div class ="item">
                <img src="images/chungtacuahientai.jpg" alt="Chúng ta của hiện tại">
                <h3>Chúng Ta Của Hiện Tại</h3>
                <p>Sơn Tùng M-TP</p>
                <audio controls>
                  <source src="track1.mp3" type="audio/mpeg">
                </audio>

            </div>

            <form class="reaction-form" action="home.php" method="post">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-heart"></i>
            </form>
          </div>   
          
        </div>
      </section>
      <section>
        <h2 class="categories">US-UK</h2>
        <div class="grid-container">
          <div class="item">
            <div class ="item">
                <img src="images/die4u.jpg" alt="Die for you">
                <h3>Die For You</h3>
                <p>The Weeknd</p>
                <audio controls>
                  <source src="track1.mp3" type="audio/mpeg">
                </audio>
            </div>

            <form class="reaction-form" action="home.php" method="post">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-heart"></i>
            </form>
          </div>   
          
          <div class="item">
            <div class ="item">
                <img src="images/sickomode.jpg" alt="Sicko Mode">
                <h3>SICKO MODE</h3>
                <p>Travis Scott,Drake</p>
                <audio controls>
                  <source src="track1.mp3" type="audio/mpeg">
                </audio>
            </div>

            <form class="reaction-form" action="home.php" method="post">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-heart"></i>
            </form>
          </div>   
          
          <div class="item">
            <div class ="item">
                <img src="images/lilnas.jpg" alt="Industry Baby">
                <h3>Industry Baby</h3>
                <p>Lil Nas X</p>
                <audio controls>
                  <source src="track1.mp3" type="audio/mpeg">
                </audio>


            </div>
            <form class="reaction-form" action="home.php" method="post">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-heart"></i>
            </form>
          </div>
          <div class="item">
            <div class ="item">
                <img src="images/humble.jpg" alt="Humble">
                <h3>HUMBLE</h3>
                <p>Kendrick Lamar</p>
                <audio controls>
                  <source src="track1.mp3" type="audio/mpeg">
                </audio>
              </div>   
            <form class="reaction-form" action="home.php" method="post">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-heart"></i>
            </form>
          </div>
          <div class="item">
            <div class ="item">
                <img src="images/paris.jpg" alt="Paris in the rain">
                <h3>Paris In The Rain</h3>
                <p>Lauv</p>
                <audio controls>
                  <source src="track1.mp3" type="audio/mpeg">
                </audio>

            </div>

            <form class="reaction-form" action="home.php" method="post">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-heart"></i>
            </form>
          </div>   
        </div>
        
        
      </section>
      
    </main>
    <footer>
      <p>&copy; 2023 My Music Website</p>
    </footer>
  </body>
</html>
