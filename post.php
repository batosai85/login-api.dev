<?php require("connection.php");
    session_start();
if ($_POST) {
    $name = json_encode($_POST["name"]);
    $email = json_encode($_POST["email"]);
    $birthday = $education = isset($_POST["education"]) ? (json_encode($_POST["birthday"])) : "no birthday";
    $location = $education = isset($_POST["education"]) ? (json_encode($_POST["location"])) : "no location";
    $education = $education = isset($_POST["education"]) ? (json_encode($_POST["education"])) : "no education";
    
    $query = "SELECT * FROM users WHERE email = $email ";
    $statement = $connection->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    if($result){
        echo "logged";
        $_SESSION["email"] = $email;
    }else{
        try {
            $query = "INSERT INTO users (name, email, birthday, location, education) ";
            $query .= " VALUES ($name, $email, $birthday, $location, $education )";
            $statement = $connection->prepare($query);
            $statement->execute();
            $_SESSION["email"] = $email;
            echo "logged";
        }catch (PDOException $e){
           echo "Something went wrong";
        }
    }
} else {
    echo "Something went wrong. Error 404.";
}


