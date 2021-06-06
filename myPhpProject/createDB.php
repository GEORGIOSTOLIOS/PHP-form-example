<!DOCTYPE html>
<html lang="en"></html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Create DB</title>
  </head>
  <body>
    
  <?php
    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$servername", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";

        $sql = "CREATE DATABASE IF NOT EXISTS myDB";
        $conn->query($sql);
        echo "<br>Database created successfully";
        $conn->query("use myDB");

        $sql = "CREATE TABLE IF NOT EXISTS Data (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL,
            email VARCHAR(30) NOT NULL,
            likesHipHop VARCHAR(10) NOT NULL,
            likesRock VARCHAR(10) NOT NULL,
            likesPop VARCHAR(10) NOT NULL,
            occupation VARCHAR(30) NOT NULL
        )";
        $conn->query($sql);
        echo "<br>Table created successfully";


    } catch(PDOException $e) {
       echo "Connection failed: " . $e->getMessage();
    }
    ?>

  </body>
</html>