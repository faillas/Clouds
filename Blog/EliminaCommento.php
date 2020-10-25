<?php
	include 'Database.php';
	include 'Sessione.php';
	//Recupero id commento
	$idCom = $_GET['id'];
	//Cancellazione commento nel database
	$queryCom = "DELETE FROM Commento WHERE Id_com='$idCom'";
	$exCom = mysqli_query($connessione,$queryCom);
	//reindirizzo alla pagina del blog
	header("location: http://localhost/Blog/VediPost.php");
	//Chiudo la connessione
    mysqli_close($connessione);
?>
