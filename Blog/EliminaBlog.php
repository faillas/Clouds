<?php
  include 'Database.php';
	include 'Sessione.php';
	//Recuper l'id del Blog
	$idBlog = $_SESSION['id'];
  $utente = $_SESSION['Creatore'];
  $nome = $_SESSION['NomeBlog'];
	//Cancello il blog dalla tabella blog
	$queryBlog = "DELETE FROM Blog WHERE Id_blog = '$idBlog'";
	$sqlElimina = mysqli_query($connessione,$queryBlog);
  $queryc = "DELETE FROM Creatore WHERE  Blog_creatore = '$idBlog'";
  $exc = mysqli_query($connessione,$queryc);
  $queryf = "DELETE FROM Follower WHERE Blog_follower ='$idBlog'";
  $exf = mysqli_query($connessione,$queryf);
  $queryp = "DELETE FROM Post WHERE Blog_post ='$idBlog'";
  $exp = mysqli_query($connessione,$queryp);
  $_SESSION['Creatore']="";
  $_SESSION['id']="";
  $_SESSION['NomeBlog']="";
  $_SESSION['Tema']="";
  header("location: http://localhost/Blog/Home.php");
	//Chiudo la connessione
  mysqli_close($connessione);
?>
