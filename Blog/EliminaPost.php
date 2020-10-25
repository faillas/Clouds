<?php
  include 'Database.php';
	include 'Sessione.php';
	//Accesso ed eliminazione dati database
	$idPost = $_GET['id'];
	$queryPost = "DELETE FROM Post WHERE Id_post = '$idPost'";
	$exPost = mysqli_query($connessione,$queryPost);
  $querylike = "DELETE FROM LikePost WHERE Post_like = '$idPost'";
  $exlike = mysqli_query($connessione,$querylike);
  $querycom = "DELETE FROM Commento WHERE Post_com = '$idPost'";
  $excom = mysqli_query($connessione,$querycom);
  $queryimg = "DELETE FROM Immagine WHERE Id_post_img = '$idPost'";
  $eximg = mysqli_query($connessione,$queryimg);
  //reindirizzo alla pagina del blog
  header("location: http://localhost/Blog/VediPost.php");
	//Chiudo la connessione
    mysqli_close($connessione);
?>
