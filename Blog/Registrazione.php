<?php
	include 'Database.php';
	include 'Sessione.php';
	//Recupero i valori immessi nei campi di registrazione
	$nome = $_POST['Nome'];
	$cognome = $_POST['Cognome'];
	$pass = $_POST['Psw'];
	$sesso = $_POST['Sesso'];
	$emailIb = $_POST['Email'];
	$email = strtolower($emailIb);
	$paese = $_POST['Paese'];
	$data = date('Y/m/d');
	$nascita = $_POST['DataN'];
	//Query che controlla se l'email inserita è già utilizzata
	$queryEm = "SELECT Email FROM Utente";
	$exEm = mysqli_query($connessione,$queryEm);
	//Eseguo il controllo
	while($arrEm = mysqli_fetch_array($exEm)){
		if($email == $arrEm[0]){
		echo("<script type = 'text/javascript'>alert('E-mail già utilizzata!')</script>");
        echo ("<script type='text/javascript'>window.location.href ='http://localhost/Blog/SignUp.php'</script>");
    	mysqli_close($connessione);
		}
	}
	//Controllo se ci sono campi vuoti
	 if($nome==""||$cognome==""||$sesso==""||$email==""||$paese==""||$nascita ==""){
        echo("<script type = 'text/javascript'>alert('Inserisci tutti i campi!')</script>");
        echo ("<script type='text/javascript'>window.location.href ='http://localhost/Blog/SignUp.php'</script>");
        mysqli_close($connessione);
    //Controllo se la password ha una lunghezza superiore agli 8 caratteri ed inferiore ai 20
    }else if(strlen($pass)<8||strlen($pass)>20||strlen($pass)==0){
    	echo("<script type = 'text/javascript'>alert('Inserire una password che rispetta gli standard!')</script>");
        echo ("<script type='text/javascript'>window.location.href ='http://localhost/Blog/SignUp.php'</script>");
    	mysqli_close($connessione);
    //Controllo se l'email inserita è valida
    } else if(!strstr($email,'@')){
    	echo("<script type = 'text/javascript'>alert('Inserire una e-mail corretta!')</script>");
        echo ("<script type='text/javascript'>window.location.href ='http://localhost/Blog/SignUp.php'</script>");
    	mysqli_close($connessione);
    //Controllo sulla data inserita
    } else if(strlen($nascita)>10){
    	echo("<script type = 'text/javascript'>alert('Inseririsci una data valida!')</script>");
      echo("<script type='text/javascript'>window.location.href ='http://localhost/Blog/SignUp.php'</script>");
    	mysqli_close($connessione);
    //Se i campi hanno superato tutti i controlli li inserisco all'interno del database
    } else{
    	//Query per inserire le informazioni relative agli utenti
		$query_insert = "INSERT INTO Utente (Email,Password_utente,Nome,Cognome,Sesso,Data_N,Paese) VALUES ('$email','$pass', '$nome', '$cognome', '$sesso', '$nascita', '$paese')";
		//Eseguo la query
		$risultato_insert = mysqli_query($connessione,$query_insert);
		//Se la query ha esito negativo stampa un errore
		if(!$risultato_insert){
			echo("Error!");
		}
		//Se la query ha esito postivo eseguo le seguenti istruzioni
		else{
			$_SESSION['Email'] = $email;
			$_SESSION['Nome'] = $nome;
			$_SESSION['LogIn'] = "ok";
			$_SESSION['Sesso'] = $sesso;
			//reindirizzo alla pagina di home
			header("location: http://localhost/Blog/Home.php");
		}
		//Chiudo la connessione
		mysqli_close($connessione);
	}
?>
