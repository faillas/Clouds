<?php
	include 'Sessione.php';
	include'Database.php';
?>
<!DOCTYPE html>
	<html lang="it">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link href="stile.css" rel="stylesheet" type="text/css">
			<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
			<title>Clouds Home</title>
			<script src="Ajax/jquery.js" type="text/javascript"></script>
			<script src="Ajax/Home.js" type="text/javascript"></script>
		</head>
		<body>
			<header>
					<div class='DivScrittaMenuBlog' id='MenuAlto'>
			        <?php
				        if (isset($_SESSION['LogIn'])){
					        //Messaggio di benvenuto utente
					        $sesso = $_SESSION['Sesso'];
						//header utente con possibilità di eliminare l'account e uscire dalla propria sessione
					        if($sesso == 'M'){
								     echo("<span class='Scrittasx'><nobr>Benvenuto ".$_SESSION['Nome']."</nobr></span>");
							    }else{
								     echo("<span class='Scrittasx'><nobr>Benvenuta ".$_SESSION['Nome']."</nobr></span>");
								  }
							  echo("<div class='utenteheader'>
								         <a class='tst2' href='LogOut.php'>Logout</a>
								         <a href ='EliminaUtente.php' <button class='tst3'>Elimina Utente</button></a></div>
											</div>");
					      //Chiusura connessione
							  mysqli_close($connessione);
				        //Se non è loggato compare benvenuto ospite e il pulsante accedi o iscriviti
				        }else{
							   $_SESSION['Nome'] = "Ospite";
									$_SESSION['Email'] = "Ospite";
						            //header ospite con possibilità di loggarsi e registrarsi
							    echo("<span class='Scrittasx'><nobr>Benvenuto ospite</nobr></span>
					       <div class='logheader'>
							   <form id='login' action='Verifica.php' method='post'>
							<input class='inputlog' type='email'  id='emaillogin' name='Email' placeholder='Email'>
				                    	<input class='inputlog' type='password'  id='passlogin' name='Psw' placeholder='Password'>
							<input class='submitlog' type='submit' id='bottone' value='Login' name = 'Submit' value = 'Login'>
							</form>
							</div>
							<div class='signheader'>
							<a class='tst0' href='SignUp.php'>Sign-Up</a>
							</div>");
				        }
					    ?>
					    </div>
						</header>
						<div class='logoclouds'>
							<img class='logoc' src='img/logo.png'/>
						</div>
						</div>
            <div class='quadro1'>
			    	<div id="Form" class="quadroricerca">
							<?php
							if (isset($_SESSION['LogIn'])) {
								echo "<h1 class='titoli'>Cerca un blog</h1></br>";
							}else {
								echo "<h1 class='titoli'>Dai una sbirciata!</h1></br>";
							}
					                //form di ricerca blog
							?>
					                               <form action="#Form" method='post' >
									 <label class="Nometc"	for="tema">Ricerca per</label>
									    <input type="radio" name="Tema" value="Titolo">Titolo
									    <input type="radio" name="Tema" value="Argomento">Argomento</br>
									  <input type='text' id='Cerca' name='Blog' placeholder='Blog...'>
									  <input type = 'submit' id='cerca' name='su' class='bottonecerca' width='100px' height='70 px'>
									</form>
									<br/><br/>
			        <?php
							include 'Database.php';
							if(isset($_POST['su'])){
							if(isset($_POST['Tema'])&&isset($_POST['Blog'])){
								$Tema=$_POST['Tema'];
								$Stringa=$_POST['Blog'];
								echo ("<h2>Risultati della ricerca:</h2>");
								//ricerca per titolo
							  if($Tema=="Titolo"){
								 $cerca = "SELECT Id_blog, Nome_blog, Argomento FROM Blog WHERE Nome_blog LIKE '%".$Stringa."%'";
								 $sqlCerca = mysqli_query($connessione,$cerca);
								 $conta = mysqli_num_rows($sqlCerca);
								 if ($conta==0) {
										// notifica in caso di mancanza di risultati
										echo ("<p>Al momento non sono stati pubblicati blog che contengano i termini cercati.</p>");
									}else {
									        //stampa numero risultati
										echo ('<p>numero risultati ricerca:'.$conta.'</p>');
										while($row = mysqli_fetch_array($sqlCerca)) {
											 if (isset($row[0])) {
												 $id = $row['Id_blog'];
										     $nome = stripslashes($row['Nome_blog']);
												 $argomento =  $row['Argomento'];
												 $cercautore= "SELECT Utente_creatore FROM Creatore WHERE Blog_creatore='$id'";
												 $sqlcercautore = mysqli_query($connessione,$cercautore);
												 while ($row1 = mysqli_fetch_array($sqlcercautore)) {
												 	$emailautore=$row1['Utente_creatore'];
													$cercautore2= "SELECT Nome, Cognome FROM Utente WHERE Email='$emailautore'";
 												  $sqlcercautore2 = mysqli_query($connessione,$cercautore2);
													while ($row2 = mysqli_fetch_array($sqlcercautore2)) {
														$NomeAutore =  $row2['Nome'];
														$CognomeAutore =  $row2['Cognome'];
											     //stampa link dei blog da ricerca con relativo argomento
											     echo ("<ul><a href=infoBlog.php?id=".$id.">".$nome."</a></br>
												         <p><b>Argomento:</b> ".$argomento."</p>
																 <p><b>Autore:</b> ".$NomeAutore." ".$CognomeAutore."</p></ul>");
															}
														 }
										 }
									};
								 }
							 }
								//ricerca per argomento
							 if($Tema=="Argomento"){
								 $cerca1 = "SELECT Id_blog, Nome_blog, Argomento FROM Blog WHERE Argomento LIKE '%".$Stringa."%'";
								 $sqlCerca1 = mysqli_query($connessione,$cerca1);
								 $conta1 = mysqli_num_rows($sqlCerca1);
								 if ($conta1==0) {
									 // notifica in caso di mancanza di risultati
									 echo ("<p>Al momento non sono stati pubblicati argomenti che contengano i termini cercati.</p>");
								}else {
									//stampa numero risultati
									echo ('<p>numero risultati ricerca:'.$conta1.'</p>');
									 while($row1 = mysqli_fetch_array($sqlCerca1)) {
										 if (isset($row1[0])) {
											 $id = $row1['Id_blog'];
											 $nome = stripslashes($row1['Nome_blog']);
											 $argomento =  $row1['Argomento'];
											 //stampa link dei blog da ricerca con relativo argomento
											 echo ("<ul><a href=infoBlog.php?id=".$id.">".$nome."</a></br>
											 <p><b>Argomento:</b> ".$argomento."</p></br></ul>");
									 }
								};
							 }
								}
							}else {
								//nel caso non fossero stati compilati tutti i campi richiesti per la ricerca
								echo ("compilazione campi scorretta.");
							}
							}
						?>
				</div>
				<div id="crea" class="creablog">
				<form action='CreaBlog.php' method='post'>
					<?php
							if (!isset($_SESSION['LogIn'])){
							$_SESSION['Nome'] = "Ospite";
						        //nel caso dell'ospite non si possono creare blog
							echo("</br><h1 class='titoli'>Iscriviti e potrai creare il tuo primo blog!</h1></br>");
							echo("<a href='SignUp.php' class='tst1'>Sign-Up</a></br></br>");
							}else{
								//se l'utente è loggato compare il form per creare un blog
									echo("<div id='crea'>");
									echo("<h1 class='titoli'>Creane uno!</h1>");
								echo("</div>");
									echo("<h2>Nome:</h2></br>
												<input type='text' id='nomeutente' name='NomeBlog' maxlength='20' placeholder='Nome'><br />");
									echo("<h2>Argomento:</h2></br>");
									echo( "<input type='text' id='argument' Name = 'ArgoBlog' maxlength=40 value ='' placeholder='Argomento del blog...'> <br />");
									echo( "</br><h3>Scegli un Tema</h3></br>");
									//ricerca temi e creazione menu di selezione degli stessi
									$queryTemi = "SELECT Nome_tema FROM Tema";
									$sqlTemi = mysqli_query($connessione,$queryTemi);
									echo("<select class='createma' name='TemaBlog' value=''>
													 <option selected value=''>");
									//Stampa tipologie di temi con la possibilità di selezionarli
												while($Temi = mysqli_fetch_array($sqlTemi)){
															if (isset($Temi)){
																	$Tema=($Temi['Nome_tema']);
																	echo("<option value='".$Tema."'>".$Tema);
															}
														};
									echo("<select>");
									echo("</br><input class='tastocrea' type = 'submit' Name = 'Crea' value = 'Crea Blog'></br></form>");
								}
								//Chiudo la connessione
								mysqli_close($connessione);
								?>
						<br/><br/>
				</div>
			</div>
			<div class="quadroblog" id="tuoiBlog">
				<?php
					include'Database.php';
					//Blog casuali per ospiti
					if (!isset($_SESSION['LogIn'])){
						$_SESSION['Nome'] = "Ospite";
						echo("<h1 class='titoli'>Alcuni Blog che potrai vedere</h1></br>");
						//Ricerca blog casuali
						$queryCreatoreBlog = "SELECT Id_blog,Nome_blog FROM Blog LIMIT 3";
						$sqlRandom = mysqli_query($connessione,$queryCreatoreBlog);
						$conta = mysqli_num_rows($sqlRandom);
						if (!$sqlRandom) {
			                printf("Error: %s\n", mysqli_error($connessione));
			                exit();
						}else{
							//Possibilità di selezionare blog
								while($random = mysqli_fetch_array($sqlRandom)){
									if (isset($random[0])) {
										$idr = $random['Id_blog'];
										$nomer = stripslashes($random['Nome_blog']);
										echo ("<ul><a href=infoBlog.php?id=".$idr.">".$nomer."</a></br></br></ul>");									}
								};
							}
						}else{
					  //Blog Utente
						echo("</br><h1 class='titoli' id= 'Blog'> I tuoi blog </h1></br>");
						$utente = $_SESSION['Email'];
						//Selezione di tutti i blog creati
						$queryCreatore = "SELECT Id_blog,Nome_blog FROM Utente, Creatore, Blog WHERE Email = Utente_creatore AND Id_blog = Blog_creatore AND Utente_creatore = '$utente'";
						//Risultati
						$RisultatiC = mysqli_query($connessione,$queryCreatore);
						$contaC = mysqli_num_rows($RisultatiC);
						//Lista risultati
						if($contaC>0){
							while ($Creatore = mysqli_fetch_array($RisultatiC)) {
								//Assegnazione variabile dall'array
								if (isset($Creatore[0])){
									$idc = $Creatore['Id_blog'];
									$nomec = stripslashes($Creatore['Nome_blog']);
									echo ("<ul><a href=infoBlog.php?id=".$idc.">".$nomec."</a></br></br></ul>");							}
							};
						} else {
							//Nel caso non ci fossero blog creati
							echo("<p>Non hai ancora creato un blog</p>");
						}
						//Blog di cui l'utente è Follower
						echo("<h1 class='titoli'>I blog che segui</h1>");
						$queryCreatoreSeguiti = "SELECT Id_blog,Nome_blog FROM Follower, Blog WHERE Id_blog=Blog_follower AND Utente_follower = '$utente'";
						$sqlSeguiti = mysqli_query($connessione,$queryCreatoreSeguiti);
						//Conto i blog che l'utente segue
						$contaSeguiti = mysqli_num_rows($sqlSeguiti);
						if (!$sqlSeguiti) {
							   printf("Error: %s\n", mysqli_error($connessione));
							   exit();
						}else{
							//Stampa blog seguiti
							if($contaSeguiti>0){
								while($seguiti = mysqli_fetch_array($sqlSeguiti)){
									//Assegnazione variabile dall'array
									if (isset($seguiti[0])){
										$ids = $seguiti['Id_blog'];
										$nomes = stripslashes($seguiti['Nome_blog']);
										echo ("<ul> <a href=infoBlog.php?id=".$ids.">".$nomes."</a></br></br></ul>");								}
								};
								} else {
								//Nel caso non ci fossero blog seguiti
								echo("<p>Non segui nessun blog</p></br>");
							}
						}
					}
				?>
			</div>
			<footer class='footerhome'>
			</footer>
	    </body>
    </html>
