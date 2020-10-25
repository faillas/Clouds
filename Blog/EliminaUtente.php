<?php
include 'Database.php';
include 'Sessione.php';
$log=$_SESSION['LogIn'];
//nel caso l'utente fosse già loggato
if (!isset($log)){
    //reindirizzamento alla home
    echo("<script type = 'text/javascript'>alert('Non puoi cancellare il tuo account perchè non ne hai uno!')</script>");
    echo("<script type='text/javascript'>window.location.href ='http://localhost/Blog/Home.php'</script>");
}
?>
<!DOCTYPE html>
	<html lang="it">
		<head>
			<link href="https://fonts.googleapis.com/css?family=Antic+Didone" rel="stylesheet">
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link href="stile.css" rel="stylesheet" type="text/css">
            <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
			<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
			<title>Clouds Delete Account</title>
			<script src="Ajax/jquery.js" type="text/javascript"></script>
			<script src="Ajax/EliminaUtente.js" type="text/javascript"></script>
		</head>
		<body>
		<header>
                <div class="DivScrittaMenuBlog" id="MenuAlto">
                <span class='Scrittasx' id="TornaHome"><a href="Home.php"><img src='img/home.png' alt="Logo_Pagina" class='LogoHome'></a>Elimina utente</span> </div>
    		</header>
			<div class="logoclouds">
				<img class='logoc' src="img/logo.png"/>
			</div>
			<div class="quadrologin">
				<div class="titoli">
					<h1>Elimina Utente</h1>
				</div>
                <form id="eliminautente" action="Eliminazione.php" method="post">
                    <label class="Nometc" for="email">E-mail</label>
                    <input type="text" id="emaillogin" name="Email" placeholder="Indirizzo"> <br />
                    <label class="Nometc" for="pass">Password</label>
                    <input type="password" id="passlogin" name="Psw" placeholder="Password"> <br />
                    <input class="ConfElimina" type="submit" name = "Submit" value = "Elimina">
                </form>
            </div>
	            <footer>
		    </footer>
		</body>
	</html>
