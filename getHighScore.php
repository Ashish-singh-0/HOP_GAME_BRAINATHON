<?php

$u_name = $_POST['userName'];


$con = new mysqli("localhost", "root", "", "dinodata");
if ($con->connect_error) {
    die("connection failed :" . $con->connect_error);

} else {
    $take = $con->prepare("SELECT highscore FROM jumpgame WHERE username = ?");
    $take->bind_param("s", $u_name);
    $take->execute();
    $result = $take->get_result();
    $highscore = $result->fetch_assoc();
    $take->close();
    echo json_encode($highscore);
}