<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gamelib";

$id = $_SESSION['id'];
$haslo = $_POST['haslo'];
$_SESSION['pass'] = $haslo;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE uzytkownicy SET pass='$haslo' WHERE id='$id'";
    // use exec() because no results are returned
    $conn->exec($sql);
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
header('Location: gra.php');
?>