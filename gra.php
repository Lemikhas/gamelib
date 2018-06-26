<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>GameLib</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>
<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">
<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
</button>
<a class="navbar-brand" href="#" onclick="changeTab(1)">GameLib</a>

<div class="collapse navbar-collapse" id="navbarsExampleDefault">
	<ul class="navbar-nav mr-auto">
		<li class="nav-item active">
			<a class="nav-link" href="#" onclick="changeTab(2)">Moje Gry</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#" onclick="changeTab(3)">Profil</a>
		</li>
</ul>
		<ul class="navbar-nav mr-right">
			<li class="nav-item active">
				<a class="nav-link" href="logout.php">Wyloguj </a>
			</li>
	</ul>
	
</div>
</nav><br>

<script>
var curTab = "1";
function changeTab(tab){
	document.getElementById(curTab).style.display = "none";
	document.getElementById(tab).style.display = "block";
	curTab=tab;
};

</script>
<!-- Zakładka Moje Gry Początek -->
	<div class="container bg-faded rounded" id="2" style="display:none;">
<?php
	echo "<h3>Witaj ".$_SESSION['user'].'<br>Twoje gry:</h3>';
?>


    <div class="container">
      <div class="row">

	  <?php

		$str = $_SESSION['gry_id'];
		$gry = explode(" ",$str);
  
try {
	$dbh = new PDO('mysql:host=localhost;dbname=gamelib', "root", "");
    foreach($gry as $gra){
	foreach($dbh->query("SELECT * FROM gry") as $row) {
		if($row['id'] == $gra){
		echo'<div class="col-md-4">';
		echo"<img src= ". $row['icon'] ." width='200px' height='300px'>";
		echo'<p><a class="btn btn-primary" href="#" role="button">Graj &raquo;</a></p>';
		echo '</div>';
		}
	}
	}
	$dbh = null;

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
      </div>
</div>
</div>
<!-- Zakładka Moje Gry Koniec -->
<!-- Zakładka Sklepu Początek -->
<div class="container bg-faded rounded" id="1"  >
<?php
	echo "<h3>Witaj ".$_SESSION['user'].'<br>Może cos kupisz?:</h3>';
?>


    <div class="container">
      <div class="row">

	  <?php

try {
	$dbh = new PDO('mysql:host=localhost;dbname=gamelib', "root", "");
	foreach($dbh->query("SELECT * FROM gry") as $row) {
		echo'<div class="col-md-4">';
		echo"<img src= ". $row['icon'] ." alt='zdjęcie' width='200px' height='300px'><form action='dodajgre.php' method='post'>";
    echo"<h3>$".$row['cena']."</h3>";
    echo"<input type='text' name='cena' value = ".$row['cena']." hidden>";
		echo'<p><button type="submit" class="btn btn-primary" href="#" role="button" name="id"  value='. $row['id'] .' >Kup &raquo;</button></p></form>';
		echo '</div>';
		}
	$dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
      </div>
</div>
</div>
<!-- Zakładka Sklepu Koniec -->
<!-- Zakładka Profil Początek -->
<div class="container bg-faded rounded" id="3" style="display:none;" >
<br>
<table class="table table-bordered">
  <tbody>
    <tr>
      <th scope="row">Login:</th>
      <td><?php echo $_SESSION['user'] ?></td>
    </tr>
    <tr>
      <th scope="row">Email:</th>
      <td><?php echo $_SESSION['email'] ?></td>
	  <td ><button type="button" class="btn btn-info" data-toggle="modal" data-target="#zmienDane">Zmień dane</button></td>
    </tr>
    <tr>
      <th scope="row">Stan konta:</th>
      <td><?php echo $_SESSION['saldo'] ?>$</td>
	  <td ><button type="button" class="btn btn-info" data-toggle="modal" data-target="#dodajSrodki">Dodaj środki</button></td>
    </tr>
    <tr>
      <th scope="row">Hasło:</th>
      <td ><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#zmianaHasla" data-whatever='filling'>Zmiana hasła</button></td>



    </tr>
  </tbody>
</table>
<br>
</div>
<!-- Zakładka Profil Koniec -->
<!-- Zmiana Hasla Początek -->
<div class="modal fade" id="zmianaHasla" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Zmiana hasła</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  			<form action="zmianahasla.php" method="post">
          <div class="form-group">
		  <label for="inputPassword" class="sr-only">hasło</label>
		  <input type="password" id="starehaslo" class="form-control" placeholder="Obecne hasło" onchange="formPassCheck()" required>
		  <br>
		  <label for="inputPassword" class="sr-only">Hasło</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Nowe hasło" name="haslo" required>
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
        <button type="submit" class="btn btn-primary" id="button" disabled>Zmień</button>
				</form>
      </div>
    </div>
  </div>
</div>
<!--Zmiana Hasla Koniec -->
<!-- Edycja Danych Użytkownika Początek -->
<div class="modal fade" id="zmienDane" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Zmiana hasła</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  			<form action="zmianadanych.php" method="post">
          <div class="form-group">
		  <label for="inputLogin" class="sr-only">Login</label>
		  <input type="text" id="inputLogin" class="form-control" placeholder="Login" name="login">
		  <br>
		  <label for="inputEmail" class="sr-only">Hasło</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email" name="email">
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
        <button type="submit" class="btn btn-primary" id="button">Zmień</button>
				</form>
      </div>
    </div>
  </div>
</div>
<!--Edycja Danych Użytkownika Koniec -->
<!-- Dodawanie środków Początek -->
<div class="modal fade" id="dodajSrodki" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Zmiana hasła</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  			<form action="dodawaniesrodkow.php" method="post">
          <div class="form-group">
		  <label for="inputNumber" class="sr-only">Kwota</label>
        <input type="number" id="inputNumber" class="form-control" placeholder="Kwota" name="iledodac" required>
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
        <button type="submit" class="btn btn-primary" id="button" >Dodaj</button>
				</form>
      </div>
    </div>
  </div>
</div>
<!-- Dodawanie środków Koniec -->
<script>
				function formPassCheck() {
   				 var x = document.getElementById("starehaslo").value;
						var y = "<?php echo $_SESSION['pass']; ?>";
						if (x==y) {
							document.getElementById("button").disabled = false;
						}else{
							document.getElementById("button").disabled = true;
						}
				}
		  </script>


	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

</body>
</html>