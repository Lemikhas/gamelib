<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gamelib";

$login = $_POST['login'];
$email = $_POST['email'];
$haslo = $_POST['haslo'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO uzytkownicy (user, pass, email)
    VALUES ('$login', '$haslo', '$email')";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
header('Location: index.php');
?>