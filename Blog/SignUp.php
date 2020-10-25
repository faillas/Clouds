<?php
include 'Database.php';
include 'Sessione.php';
$log=$_SESSION['LogIn'];
//nel caso l'utente fosse già loggato
if (isset($log)){
    //reindirizzamento alla home
    echo("<script type = 'text/javascript'>alert('Utente registrato')</script>");
    echo("<script type='text/javascript'>window.location.href ='http://localhost/Blog/Home.php'</script>");
}
?>
<!DOCTYPE html>
	<html lang='it'>
		<head>
			<link href='https://fonts.googleapis.com/css?family=Antic+Didone' rel='stylesheet'>
			<meta charset='UTF-8'>
			<meta name='viewport' content='width=device-width, initial-scale=1'>
			<link href='stile.css' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Muli' rel='stylesheet'>
      <link rel='shortcut icon' href='img/favicon.ico' type='image/x-icon'>
			<title>Clouds Sign Up</title>
			<script src='Ajax/jquery.js' type='text/javascript'></script>
			<script src='Ajax/SignUp.js' type='text/javascript'></script>
		</head>
		<body>
			<header>
        <div class='DivScrittaMenuBlogr' id='MenuAlto'>
        <span class='Scrittasx' id='TornaHome'><a href='Home.php'><img src='img/home.png' alt='Logo_Pagina' class='LogoHome'></a>Area Registrazione</span></div>
      </header>
			<div class='logoclouds'>
				<img class='logoc' src='img/logo.png'/>
			</div>
			<div class='quadroregi'>
          <h1 class='titoli'>Registrazione</h1>
        <form name='Registrazione' action='Registrazione.php' method='post'>
          <label class='Nometc' for='nome'>Nome</label>
          <input class='testoreg' type='text' id='nomeutente' name='Nome' maxlength='20' placeholder='Nome'> <br />
          <label class='Nometc' for='cognome'>Cognome</label>
          <input class='testoreg' type='text' id='cognomeutente' name='Cognome' maxlength='20' placeholder='Cognome'> <br />
          <label class='Nometc'	for='sesso'>Sesso</label>
          <input type='radio' name='Sesso' value='M'> M
          <input type='radio' name='Sesso' value='F'> F<br>
          <label class='Nometc' for='email'>E-mail</label>
          <input class='emailreg' type='email' id='emailutente' name='Email' maxlength='40' placeholder='Indirizzo di posta elettronica'> <br />
          <label class='Nometc' for='paese'>Paese di residenza</label>
          <input type='text' placeholder='Paese' name='Paese' maxlength='40'>
          <label class='Nometc' for='datanascita'>Data di nascita</label>
          <input type = 'text' onfocus='(this.type='date')' id='datautente' name='DataN' placeholder='gg-mm-aaaa'> <br /><br />
          <label class='Nometc' for='password'>Password </br>(8-20 caratteri)</label>
          <input type='password' id='passutente' name='Psw' maxlength='20' placeholder='Scegli...'> <br /><br />
          <div class='areaclickreg'><input type='submit' class='signup' id= 'bottone' name='Submit' value='Sign up'> </div>
        </div>
        </form>
        </div>
		<footer>
	        </footer>
	  </body>
	</html>
