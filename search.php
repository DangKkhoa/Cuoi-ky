<?php 
    session_start();
    $input = '';
    if(!isset($_SESSION['email'])) {
        echo "<script>alert('You need to login to continue')</script>";
        header("refresh:1;url=/cuoiki/login.php");
        die();
    }
    else {
        $input = '';
        if(!empty($_GET['search_input'])) {
            $input = htmlspecialchars($_GET['search_input']);
        }

    }

    
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="search.css">
    <script src="https://kit.fontawesome.com/ad1797946c.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Sen&display=swap" rel="stylesheet">
    <title><?= $input ?></title>
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
            <li class="menu-items"><a href="genres.php">Genres</a></li>
            <li class="menu-items"><a href="artists.php" id="display-link">Artists</a></li>
            <li class="menu-items"><a href="playlists.php">Playlists</a></li>
            <li class="menu-items"><a href="albums.php">Albums</a></li>
            
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
    <?php 
        require_once('database/database.php');
        $conn = get_connection();
    ?>
    <main>
        <div class="container">
            <h2>SEARCH RESULT FOR: <span style="color: #214976"><?php echo "$input"?></span></h2>
            <ul class="search-results">
                <li class="search-items"><h2>Artists:</h2></li>
                <div class="artist-list">

                
                <?php 
            
                    $input .= "%";
                    $sql = "SELECT artistID, artistName, artistImg FROM artist WHERE artistName LIKE ?";
                    $stm = $conn->prepare($sql);
                    $stm->bind_param('s', $input);
                    $stm->bind_result($get_id, $get_name, $get_img);
                    $stm->execute();

                    while($row=$stm->fetch()) {
                        ?>
                        <div class="artist-content">        
                            <a href="artist.php?aid=<?php echo "$get_id";?>"><img src="images/<?php echo "$get_img"?>" alt="<?php echo "$get_name"?>"></a>
                            <p style="text-align: center; padding-top: 16px; font-size: 18px"><?php echo "$get_name"?></p>
                        </div>
                        <?php
                    }

                    
                    
                ?>
                </div>
                <li class="search-items"><h2>Songs:</h2></li>
                <div class="song-list">

                
                <?php 
                    // echo "$input";
                    $sql = "SELECT songName, songLink, singer FROM song WHERE songName LIKE ? OR singer LIKE ?";
                    $stm = $conn->prepare($sql);
                    $stm->bind_param('ss', $input, $input);
                    $stm->bind_result($song_name, $song_link, $singer);
                    $stm->execute();
                    while($row=$stm->fetch()) {
                        ?>
                        <div class="song-content">
                            <div class="song-info">
                                <span>Artist: <?php echo "$singer"?></span>
                                <span><?php echo "$song_name"?></span>
                            </div>
                            <audio controls>
                                <source src="songs/<?php echo "$song_link"?>" type="audio/mpeg">
                            </audio>
                        </div>
                        
                        <?php
                    }
                ?>
                </div>
                
            </ul>
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
        </div>
    </main>


</body>

</html> 