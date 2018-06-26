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
$gra = $_POST['id'];
$cena = $_POST['cena'];
$gry = $_SESSION['gry_id']." ".$gra;
$saldo = $_SESSION['saldo'] - $_POST['cena'];

if($saldo<0){
echo'
<!-- Dodawanie środków Początek -->
<div class="modal fade" id="dodajSrodki" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Błąd!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3>Za mało pieniędzy!</h3>
        <h2>Dodaj środki!</h2>
        </div>
        <form action="gra.php" method="post">
      <div class="modal-footer">
        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
				</form>
      </div>
    </div>
  </div>
</div>
<!-- Dodawanie środków Koniec -->
';
}else{
    $_SESSION['saldo'] = $saldo;
    $_SESSION['gry_id'] = $gry;
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE uzytkownicy SET gry_id='$gry', saldo='$saldo' WHERE id='$id'";
    $conn->exec($sql);
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
header('Location: gra.php');
}
?>