<?php
// $u_name= '@ashish';
// $highscore = 100;
$u_name = $_POST['userName'];
$highscore = $_POST['hiscore'];

$con = new mysqli("localhost", "root", "", "dinodata");
if ($con->connect_error) {
    

    die("connection failed :" . $con->connect_error);

} else {
    $exist = $con->prepare("SELECT ID FROM jumpgame WHERE username = ?");
    $exist->bind_param("s",$u_name);
    $exist->execute();
    $chek = $exist->fetch();
    $exist->close();


    if ($chek) {



        $take = $con->prepare("UPDATE jumpgame SET highscore = ? WHERE username = ?");
        $take->bind_param("is", $highscore, $u_name);
        $take->execute();
        echo "updated";

        $take->close();
    }$con->close();
}


