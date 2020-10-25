<?php
  include 'Sessione.php';
	include 'Database.php';
	//Recupero email utente e id blog
  $utente = $_SESSION['Email'];
	$id = $_SESSION['id'];
	//Inserimento nella tabella Follower
	$queryFollower = "INSERT INTO Follower(Blog_follower,Utente_follower) VALUES ('$id','$utente')";
	$sqlFollower = mysqli_query($connessione,$queryFollower);
  //reindirizzo alla pagina di lettura blog
  header("location: http://localhost/Blog/VediPost.php");
	//Chiudo la connessione
	mysql_close($connessione);
?>
