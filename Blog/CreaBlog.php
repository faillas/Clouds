<?php
	include 'Database.php';
	include 'Sessione.php';
	//Recupero i valori immessi nei campi di registrazione
	$utente = $_SESSION['Email'];
	$nome = $_POST['NomeBlog'];
	$argomento = $_POST['ArgoBlog'];
	$tema = $_POST['TemaBlog'];
	//controllo campi
	if($nome==""||$argomento==""||$tema==""){
			 echo("<script type = 'text/javascript'>alert('Inserisci tutti i campi!')</script>");
			 echo ("<script type='text/javascript'>window.location.href ='http://localhost/Blog/Home.php'</script>");
			 mysqli_close($connessione);
	}
	$query_insert = "INSERT INTO Blog (Nome_blog,Nome_tema_blog,Argomento) VALUES ('$nome','$tema', '$argomento')";
  //Eseguo la query
	$risultato_insert = mysqli_query($connessione,$query_insert);
	while($ide = mysqli_fetch_array($risultato_insert)){
				if (isset($Tema)){
						$id=$ide['Id_blog'];
				}
	};
	$query_insert2 = "INSERT INTO Creatore (Utente_creatore) VALUES ('$utente')";
	//Eseguo la query
	$risultato_insert2 = mysqli_query($connessione,$query_insert2);
	//Se le query hanno esito negativo stampa un errore
	if(!$risultato_insert||!$risultato_insert2){
			echo("Error!");
		}
		//Se le query ha esito positivo eseguo le seguenti istruzioni
	else{
		//reindirizzo alla pagina del blog
		header("location: http://localhost/Blog/Home.php");
	 	//Chiudo la connessione
	 	mysqli_close($connessione);
	}
?>
