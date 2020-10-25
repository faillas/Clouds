<?php
	//Salvo con delle variabili le credenziali per l'accesso al database
	$host = 'localhost';
	$admin = 'root';
	$password = '';
	$database = 'CloudsBlog';
	//Connessione al database server
	$connessione = mysqli_connect($host, $admin, $password, $database);
	//Caso di connessione non riuscita
	if(!$connessione) {
		die("Connection failed: ".mysqli_connect_error());
	}
	//Seleziono il database
	mysqli_select_db($connessione, $database)
	or die ("Impossibile connettersi al database $database");
?>