<?php require("connection.php");
    session_start();
if ($_POST) {
    $name = json_encode($_POST["name"]);
    $email = json_encode($_POST["email"]);
    $birthday = isset($_POST["education"]) ? json_encode($_POST["birthday"]) : "no birthday";
    $location = isset($_POST["education"]) ? json_encode($_POST["location"]) : "no location";
    $education = isset($_POST["education"]) ? json_encode($_POST["education"]) : "no education";
    $date = date('Y-m-d-H-i-s');
    
    $query = "SELECT * FROM users WHERE email = $email ";
    $statement = $connection->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    if($result){
        $id = $result['id'];
        $query = "UPDATE users SET name = $name , email = $email , birthday = $birthday, ";
        $query .= "location = $location, education = $education WHERE id = $id ";
        $statement = $connection->prepare($query);
        $statement->execute();
        echo "logged";
        $_SESSION["email"] = $email;
    }else{
        try {
            $query = "INSERT INTO users (name, email, birthday, location, education, register_date) ";
            $query .= " VALUES ($name, $email, $birthday, $location, $education, '$date' )";
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


