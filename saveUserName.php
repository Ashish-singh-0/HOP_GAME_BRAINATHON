<?php
$u_name = $_POST['userName'];


$con = new mysqli("localhost", "root", "", "dinodata");
if ($con->connect_error) {
    die("connection failed :" . $con->connect_error);

} else {
    $exist = $con->prepare("SELECT ID FROM jumpgame WHERE username = ?");
    $exist->execute([$u_name]);
    $chek = $exist->fetch();
    $exist->close();


    if (!$chek) {

        $tab = $con->prepare("insert into jumpgame(username) values(?)");
        $tab->bind_param("s", $u_name);
        $tab->execute();

        $tab->close();

    } $con->close();
    // else {
    //     $take = $con->prepare("SELECT highscore FROM jumpgame WHERE username = ?");
    //     $take->bind_param("s", $u_name);
    //     $take->execute();
    //     $result = $take->get_result();
    //     $highscore = $result->fetch_assoc();
    //     $take->close();
    // }
}