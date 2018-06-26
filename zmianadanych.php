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
$login = $_POST['login'];
$email = $_POST['email'];


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   if($login != ""){
		$sql = "UPDATE uzytkownicy SET user='$login' WHERE id='$id';";
		$conn->exec($sql);
		$_SESSION['user'] = $login;
	}
	if($email != ""){
		$sql = "UPDATE uzytkownicy SET email='$email' WHERE id='$id';";
		$conn->exec($sql);
		$_SESSION['email'] = $email;
	}
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
header('Location: gra.php');
?>