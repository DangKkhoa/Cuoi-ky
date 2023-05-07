<?php 

    $email = $_SESSION['email'];
    require_once('database/database.php');
    $conn = get_connection();
    $sql = "SELECT username FROM user WHERE email = ?";
    $stm = $conn->prepare($sql);
    $stm->bind_param('s', $email);
    $stm->execute();
    $stm->bind_result($username);
    $stm->fetch();
    // $stm->close();
    // $conn->close();
?>


    