<?php
	//Pagina php per l'eliminazione della sessione
	include 'Sessione.php';
	session_unset();
	session_destroy();
	header('location:http://localhost/Blog/Home.php');
  exit;
?>
