<?php
    session_start();
    require_once('database/database.php');
    $conn = get_connection();
    $artist_id = $_GET['aid'];
    $sql = "SELECT artistID, artistName, artistImg FROM artist where artistID = ?";
    $stm = $conn->prepare($sql);
    $stm->bind_param('i', $artist_id);
    $stm->bind_result($get_id, $get_name, $get_img);
    $stm->execute();
    $stm->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://kit.fontawesome.com/ad1797946c.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Sen&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="artist_profile.css">
    <title><?php echo "$get_name"?></title>
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
    <?php 
        require_once('database/database.php');
        $conn = get_connection();
    ?>
    <main>
        <div class="container">
            
            <div class="artist-results">
                
                
                <div class="artist-content">        
                    <img src="images/<?php echo "$get_img"?>" alt="<?php echo "$get_name"?>">
                    <p style="text-align: center; padding-top: 16px; font-size: 18px"><?php echo "$get_name"?></p>
                </div>
                <div class="artist-songs">
                    <?php 
                        $sql = "SELECT songName, songLink, genre FROM song WHERE artistID = ?";
                        $stm = $conn->prepare($sql);
                        $stm->bind_param('i', $artist_id);
                        $stm->bind_result($song_name, $song_link, $genre);
                        $stm->execute();
    
                        while($row=$stm->fetch()) {
                            ?>
                            <div class="artist-song">    
                                Song: <a style="margin: 5px 0; text-decoration: none; color: #6ba4e6; font-size: 18px" href="search.php?search_input=<?php echo "$song_name" ?>"><?php echo "$song_name" ?></a>
                                <audio controls>
                                    <source src="songs/<?php echo "$genre"?>/<?php echo "$song_link"?>" type="audio/mpeg">
                                </audio>
                                <!-- <p style="text-align: center; padding-top: 16px; font-size: 18px"><?php echo "$get_name"?></p> -->
                            </div>
                            <hr style="width: 00%">
                            <?php
                        }
                    ?>
                </div>
                        
                
            </div>
                
        </div>
    </main>

</body>
</html>