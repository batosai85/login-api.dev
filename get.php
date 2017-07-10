<?php require("connection.php");
session_start();
$email = $_SESSION["email"];
if ($email === '') {
    header("Location:  http://login-api.dev/facebook_api.php");
} else {
    $query = "SELECT * FROM users WHERE email = $email ";
    $statement = $connection->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    echo json_encode($result);
}