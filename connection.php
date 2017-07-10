<?php
 $config = require("./db/config.php");
try {
   $connection = new PDO('mysql:host=' . $config["localhost"] . ';dbname=' . $config["db"]
        ,$config["user"], $config["pass"]);

} catch (PDOException $e){
    die("could not connected");
  
}
