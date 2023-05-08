<?php 
    session_start();
    require_once('database/database.php');
    $conn = get_connection();
    $is_admin = false;
    if(!isset($_SESSION['email'])) {
        header('Location: login.php');
        die();
    }
    else {
        $email = $_SESSION['email'];
        $sql = "SELECT username FROM user WHERE email = ?";

        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $email);
        $stm->execute();
        $stm->bind_result($username);
        $stm->fetch();
        $stm->close();

        
        

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
    <!-- <link rel="stylesheet" href="awsome-icons/css/solid.css"> -->
    <style>
      a {
        text-decoration: none;
      }
    </style>
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
            <li class="menu-items active"><a href="#">Home</a></li>
            <li class="menu-items"><a href="genres.php">Genres</a></li>
            <li class="menu-items"><a href="artists.php" id="display-link">Artists</a></li>
            <li class="menu-items"><a href="my_playlist.php">Playlists</a></li>
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
      <form class="form-control" action="search.php" method="GET">
        <input type="search" name="search_input" id="" placeholder="Enter music name...">
        <button class="search-btn" type="submit"><i class="fa-solid fa-headphones"></i></button>
      </form>
      <div class="greeting">
        <h1>Welcome to My Music Website</h1>
        <p>Listen to your favorite music anytime, anywhere.</p>
      </div>
      
      <section>
        <h2 class="categories">Top Tracks</h2>
        
        
        <div class="grid-container">
          <?php 
            $sql = "SELECT songID, songName, songLink, singer, songImg, category FROM song Where category LIKE '%Top track%'";
            $stm = $conn->prepare($sql);
            $stm->bind_result($song_id, $song_name, $song_link, $singer, $song_img, $category);
            $stm->execute();

            while($row=$stm->fetch()) {
              ?>
                <div class="item">
                  <div class ="item">
                      <img src="images/<?php echo "$song_img" ?>" alt="Ngu mot minh">
                      <h3><?php echo "$song_name"?></h3>
                      <p><?php echo "$singer" ?></p>
                      <audio controls>
                        <source src="songs/<?php echo "$song_link"?>" type="audio/mpeg">
                      </audio>

                  </div>
                  <div class="reaction">
                    <a href="my_playlist.php?song_id=<?php echo "$song_id" ?>" class="reaction-form"><i class="fa-solid fa-star"></i></a>
                    <a href="like_songs.php?song_id=<?php echo "$song_id" ?>" class="reaction-form"><i class="fa-solid fa-heart"></i></a>
                  </div>
                </div>   
              <?php
            }

          ?>
             
          
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
                  <source src="songs/Die For You - The Weeknd.mp3" type="audio/mpeg">
                </audio>
            </div>
            <div class="reaction">
              <form class="reaction-form" action="my_playlist.php" method="post">
                <button class="reaction"><i class="fa-solid fa-star"></i></button>
  
              </form>
              <form class="reaction-form" action="love.php">
                <button class="reaction"><i class="fa-solid fa-heart"></i></button>
              </form>
            </div>
          </div>   
          
          <div class="item">
            <div class ="item">
                <img src="images/sickomode.jpg" alt="Sicko Mode">
                <h3>SICKO MODE</h3>
                <p>Travis Scott,Drake</p>
                <audio controls>
                  <source src="songs/Travis_Scott_Ft_Drake_-_Sicko_Mode_Amebo9ja.com.mp3" type="audio/mpeg">
                </audio>
            </div>
            <div class="reaction">
              <form class="reaction-form" action="my_playlist.php" method="post">
                <button class="reaction"><i class="fa-solid fa-star"></i></button>
  
              </form>
              <form class="reaction-form" action="love.php">
                <button class="reaction"><i class="fa-solid fa-heart"></i></button>
              </form>
            </div>
          </div>   
          
          <div class="item">
            <div class ="item">
                <img src="images/lilnas.jpg" alt="Industry Baby">
                <h3>Industry Baby</h3>
                <p>Lil Nas X</p>
                <audio controls>
                  <source src="songs/Lil-Nas-X-Ft-Jack-Harlow-Industry-Baby-(TrendyBeatz.com).mp3" type="audio/mpeg">
                </audio>


            </div>
            <div class="reaction">
              <form class="reaction-form" action="my_playlist.php" method="post">
                <button class="reaction"><i class="fa-solid fa-star"></i></button>
  
              </form>
              <form class="reaction-form" action="love.php">
                <button class="reaction"><i class="fa-solid fa-heart"></i></button>
              </form>
            </div>
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
              <div class="reaction">
              <form class="reaction-form" action="my_playlist.php" method="post">
                <button class="reaction"><i class="fa-solid fa-star"></i></button>
  
              </form>
              <form class="reaction-form" action="love.php">
                <button class="reaction"><i class="fa-solid fa-heart"></i></button>
              </form>
            </div>
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
            <div class="reaction">
              <form class="reaction-form" action="my_playlist.php" method="post">
                <button class="reaction"><i class="fa-solid fa-star"></i></button>
  
              </form>
              <form class="reaction-form" action="love.php">
                <button class="reaction"><i class="fa-solid fa-heart"></i></button>
              </form>
            </div>
          </div>   
        </div>
        <script>
          var audio_playing = document.getElementsByTagName('audio');
          for(var i = 0; i < audio_playing.length; i++) {
            audio_playing[i].addEventListener('play', function() {
              for(var j = 0; j < audio_playing.length; j++) {
                if(audio_playing[j] != this) {
                  audio_playing[j].pause()
                }
              }
            })
          }
        </script>
        
      </section>
      
    </main>
    <footer>
      <p>&copy; 2023 My Music Website</p>
    </footer>
  </body>
</html>
