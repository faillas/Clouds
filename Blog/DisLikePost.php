<?php
	include 'Database.php';
	include 'Sessione.php';
	//Recupero l'utente loggato e il post a cui vuole levare il mi piace
	$utente = $_SESSION['Email'];
	$id = $_GET['id'];
	//Eliminazione campi vecchi database
	$queryDisLike = "DELETE FROM LikePost WHERE Post_like = '$id' AND Utente_like = '$utente'";
	//Aggiornamento campi database
	$exLike = mysqli_query($connessione,$queryDisLike);
	header("location: http://localhost/Blog/VediPost.php#corpoPost");
	//Chiudo la connessione
	mysqli_close($connessione);
?>
