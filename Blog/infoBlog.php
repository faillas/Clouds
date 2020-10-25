<?php
	include 'Database.php';
	include 'Sessione.php';
	//Recupero valore id blog
	$id = $_GET['id'];
	$utente = $_SESSION['Email'];
	$_SESSION['id']=$id;
  if(!isset($_GET['id'])){
		echo("<script type = 'text/javascript'>alert('seleziona un blog')</script>");
	  echo ("<script type='text/javascript'>window.location.href ='http://localhost/Blog/Home.php'</script>");
	  mysqli_close($connessione);
	}else{
    //recupero dati blog
		$cerca = "SELECT Nome_blog, Nome_tema_blog, Utente_creatore
		          FROM Blog, Creatore
		          WHERE Id_blog='$id' AND
		          Blog_creatore='$id'";
		$sqlCerca = mysqli_query($connessione,$cerca);
		while($row = mysqli_fetch_array($sqlCerca)){
		//salvataggio dati blog
			if (isset($row[0])) {
				$NomeBlog = stripslashes($row['Nome_blog']);
				$Tema= stripslashes($row['Nome_tema_blog']);
				$Creatore= stripslashes($row['Utente_creatore']);
		}
	};
  $_SESSION['NomeBlog'] = $NomeBlog;
  $_SESSION['Tema'] = $Tema;
  $_SESSION['Creatore'] = $Creatore;
  //reindirizzo alla pagina di lettura blog
  header("location: http://localhost/Blog/VediPost.php");
  //Chiudo la connessione
	mysqli_close($connessione);
	}
?>
