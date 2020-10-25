<?php
  include 'Database.php';
	include 'Sessione.php';
	//Recupero dati post
	$utente = $_SESSION['Email'];
	$id = $_GET['id'];
	//Inserimento dei dati all'interno del database
	$queryLike = "INSERT INTO LikePost(Post_like,Utente_like) VALUES('$id','$utente')";
	$Like = mysqli_query($connessione,$queryLike);
  header("location: http://localhost/Blog/VediPost.php#corpoPost");
	//Chiusura della connessione
	mysqli_close($connessione);
?>
