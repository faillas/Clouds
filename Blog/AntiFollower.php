<?php
  include 'Sessione.php';
	include 'Database.php';
	//Recupero email utente e id blog
  $utente = $_SESSION['Email'];
	$id = $_SESSION['id'];
	//Inserimento nella tabella Follower
	$queryAntiFollower = "DELETE FROM Follower WHERE Utente_follower='$utente' AND Blog_follower='$id'";
	$sqlAntiFollower = mysqli_query($connessione,$queryAntiFollower);
  //reindirizzo alla pagina di lettura blog
  header("location: http://localhost/Blog/VediPost.php");
	//Chiudo la connessione
	mysql_close($connessione);
?>
