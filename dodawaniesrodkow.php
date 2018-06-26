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
$kwota = $_SESSION['saldo'] + $_POST['iledodac'];



try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE uzytkownicy SET saldo='$kwota' WHERE id='$id'";
    // use exec() because no results are returned
    $conn->exec($sql);
	$_SESSION['saldo'] = $kwota;
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
header('Location: gra.php');
?>