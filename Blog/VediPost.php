<?php
  include 'Database.php';
  include 'Sessione.php';
  //recupero id e tema del blog
  $tema = $_SESSION['Tema'];
  $id=$_SESSION['id'];
  $tema = $_SESSION['Tema'];
  //recupero colori, font e sfondo del tema da database
  $queryTema = "SELECT * FROM Tema WHERE Nome_tema='$tema'";
  $sqlTema = mysqli_query($connessione,$queryTema);
  while($Tema = mysqli_fetch_array($sqlTema)){
        if (isset($Tema)){
            $nome=$Tema['Nome_tema'];
            $font=$Tema['Font'];
            $titoli=$Tema['Titolo_colore'];
            $testo=$Tema['Testo_colore'];
            $post=$Tema['Post_sfondo'];
            $pagina=$Tema['Pagina_sfondo'];
        }
  };
?>
<!DOCTYPE html>
<html lang="it">
	<head>
			<link href="https://fonts.googleapis.com/css?family=Antic+Didone" rel="stylesheet">
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
      <?php
      //nel caso il tema non fosse stato selezionato si attiva il css della home
      if ($tema=="") {
        echo ("<link href='stile.css' rel='stylesheet' type='text/css'>");
      }else {
      //nel caso il tema fosse stato selezionato, si attiva un css statico per la grafica di base
        echo ("<link href='Tema.css' rel='stylesheet' type='text/css'>");
      }
       ?>
			<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
      <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
			<title>Clouds Post</title>
      <script src="Ajax/jquery.js" type="text/javascript"></script>
      <script src="Ajax/VediPost.js" type="text/javascript"></script>
	</head>
  <header>
      <div class="DivScrittaMenuBlog" id="MenuAlto">
			<?php
			include 'Database.php';
			$utente = $_SESSION['Email'];
			$blog = $_SESSION['NomeBlog'];
			$creatore = $_SESSION['Creatore'];
      if ($blog=="") {
	//nel caso in cui si tenta di accedere a un blog senza averlo selezionato dalla home
        echo("<script type = 'text/javascript'>alert('Blog non disponibile')</script>");
    	  echo("<script type='text/javascript'>window.location.href ='http://localhost/Blog/Home.php'</script>");
      }
					echo("<span class='Scrittasxp' id='TornaHome'>
					      <a href='Home.php'><img src='img/home.png' alt='Logo_Pagina' class='LogoHome'></a>$blog</span>");
					if ($creatore==$utente){
	    //se l'utente è creatore può cambiare il tema del blog e eliminarlo
            echo("<div class='logheader'>
                 <form action='Tema.php' method='post'>");
						$queryTemi = "SELECT Nome_tema FROM Tema";
						$sqlTemi = mysqli_query($connessione,$queryTemi);
						echo("<select  class='sceltatema' name='TemaBlog' >");
						echo("<option  selected value=''>");
						//Stampa tipologie di temi con la possibilità di selezionarli
						while($Temi = mysqli_fetch_array($sqlTemi)){
									if (isset($Temi[0])){
									    $nomeTema=($Temi['Nome_tema']);
									    echo("<option value='".$nomeTema."'>".$nomeTema);
									}
								};
						echo("</select>");
						echo("<input type = 'submit' id='cambiatema' class='tastipc1' placeholder='Invia' Name = 'Cambia' value='Cambia Tema'>
						      </form>
                  </div>");
						echo("<div class='postheader'>
                  <a href ='EliminaBlog.php' class='tastipc3' id='Elimina'>Elimina Blog</a>
                  </div>");
						}
            //pulsante per seguire
           if (isset($_SESSION['LogIn'])) {
           if ($utente!=$creatore) {
	     //l'utente loggato può salvare nei propri blog seguiti, quello che sta vedendo
             $queryFollower = "SELECT Utente_follower FROM Follower WHERE Blog_follower='$id' AND Utente_follower= '$utente'";
             $sqlFollower = mysqli_query($connessione,$queryFollower);
             $conta = mysqli_num_rows($sqlFollower);
             if ($conta==1) {
               echo("<div class='seguiheader'><a href ='AntiFollower.php' class='tastipc4' id='follower'>Smetti di seguire</a></div>");
             }else {
               echo("<div class='seguiheader'><a href ='Follower.php' class='tastipc4' id='antifollower'>Segui</a></div>");
             }
           }
           }
				?>
				</div>
		</header>
		<body>
      <style>
      body{
       font-family: <?php echo $font; ?>;
       width:100%;
       height: 100%;
       margin: 0;
       color: <?php echo $testo; ?>;
       background: url("Temi/<?php echo $tema; ?>.jpg");
       background-repeat: no-repeat;
       background-color: <?php echo $pagina; ?>;
       background-attachment: fixed;
       background-size: cover;
       background-position: center;}


      .DivScrittaMenuBlog{
       position: fixed;
       top: 0;
       left: 0;
       right: 0;
       z-index: 9999;
       width:100%;
       background-color:rgba(<?php echo $post; ?>);
       color: <?php echo $titoli; ?>;
       padding: 1% 1% 1% 1%;
       font-family: <?php echo $font; ?>;
       font-size: 2em;
       border-bottom: 2px solid black}

      .quadropost{

        background-color: rgba(<?php echo $post; ?>);
        box-sizing: content-box;
        text-align: center;
        padding:1% 1% 1% 1%;
        font-family: <?php echo $font; ?>;
        border: 5px solid #000000;
        border-radius: 15px;}

      .quadropostimm{

        background-color: rgba(<?php echo $post; ?>);
        box-sizing: content-box;
        text-align: center;
        padding:1% 1% 1% 1%;
        font-family: <?php echo $font; ?>;
        border: 5px solid #000000;
        border-radius: 15px;}

      .titoli {
       color: <?php echo $titoli; ?>;
       font-size: 1.8em;
       text-decoration: underline;}
      </style>
      <div class="quadropag">
        <?php
        //PAGINAZIONE POST
        $x_pag = 1;
        // Recupero il numero di pagina corrente.
        $pag = isset($_GET['pag']) ? $_GET['pag'] : 1;
        // Controllo se $pag è valorizzato e se è numerico. In caso contrario il valore è 1
        if (!$pag || !is_numeric($pag)) $pag = 1;
        // mysql_num_rows per contare il totale delle righe presenti all'interno della tabella agenda
        $query = "SELECT Id_post FROM Post WHERE Blog_post='$id'";
        $sql = mysqli_query($connessione,$query);
        $all_rows = mysqli_num_rows($sql);
        // Definisco il numero totale di pagine
        $all_pages = ceil($all_rows / $x_pag);
        // Calcolo da quale record iniziare
        $first = ($pag - 1) * $x_pag;
         ?>
      </div>
			<div class="quadropost" id="post">
					<div id="corpoPost">
						<?php
            //ZONA VISUALIZZAZIONE POST
            // utilizzando LIMIT per partire da $first e contare fino a $x_pag, recupero i dati dei post
	      $queryPost = "SELECT * FROM Post WHERE Blog_post='$id' ORDER BY Data_ora_post DESC LIMIT $first, $x_pag";
              $sqlPost = mysqli_query($connessione,$queryPost);
              $conta = mysqli_num_rows($sqlPost);
              if ($conta==0) {
		//nel caso non ci fossero post pubblicati
                echo ("<h3>Il Blog non ha post da visualizzare</h3>");
              }else {
                //Stampa titolo, data e testo
                while($Post = mysqli_fetch_array($sqlPost)){
                  if(isset($Post[0])){
                    $idPost = $Post['Id_post'];
                    $data= $Post['Data_ora_post'];
                    $blogPost = $Post['Blog_post'];
                    $titPost = stripslashes($Post['Titolo_post']);
                    $tesPost= stripslashes($Post['Testo_post']);
                    echo ("<h1 class='titoli'>".$titPost."</h1>
                           <p>".$data."</p></br>
                           <p>".$tesPost."</p></br>");
                    //recupero immagine
                    $queryImg = "SELECT * FROM Immagine WHERE Id_post_img='$idPost'";
                    $sqlImg = mysqli_query($connessione,$queryImg);
                    $contaImg = mysqli_num_rows($sqlImg);
                    if ($contaImg>0) {
                      while ($Img = mysqli_fetch_array($sqlImg)) {
                        $idImg= $Img['Id_img'];
                        $idPostimg = $Img['Id_post_img'];
                        $contenuto= $Img['Contenuto'];
                        $NomeImg= $Img['Nome_img'];
                        echo "<div class='quadroimm'><img class='imm' src='".$NomeImg."'></br></div>";
                      };
                    }
                    //recupero like del post
                    if(!isset($_SESSION['LogIn'])){
                        echo("<p>Per poter commentare, postare e dare like</p></br><a href = 'SignUp.php' class='tastisign'>Iscriviti</a></br>");
                    }else {
                      $like = "SELECT Utente_like FROM LikePost WHERE Post_like='$idPost'";
                      $sqllike = mysqli_query($connessione,$like);
                      $likers= mysqli_num_rows($sqllike);
                      if ($likers==0) {
			  //nel caso non ci fossero like al post
                          echo("<p>Metti like per Primo!<p>");
                          echo("<div class='areamipiace'>
                               <a class='bottonedislike' href=LikePost.php?id=".$idPost."><img src='img/dislike.png' width='50px' height='50px'></img></a>
                               </div>");
                      }
                      //controllo se l'utente ha dato like al singolo post
                      while($liker = mysqli_fetch_array($sqllike)){
                        if (isset($liker)) {
                          $Like = $liker['Utente_like'];
                          if ($Like==$utente) {
		            //possibilità di revocare un like, solo se l'utente è loggato
                            echo("<p>Non mi piace più</p>
                                  <div class='areamipiace'>
                                  <a class='bottonelike' href=DisLikePost.php?id=".$idPost."><img src='img/like.png' width='50px' height='50px'></img></a>
                                   </div>");
                          }else {
			    //possibilità di mettere un like, solo se l'utente è loggato
                            echo("<p>mi piace!</p>
                                  <div class='areamipiace'>
                                  <a class='bottonedislike' href=LikePost.php?id=".$idPost."><img src='img/dislike.png' width='50px' height='50px'></img></a>
                                  </div>");
                          }
                      }
                    };
	            //numero di like del post
                    if ($likers==1) {
                      echo("<p>Piace a ".$likers." utente<p>");
                    }
                    if ($likers>1) {
                      echo("<p>Piace a ".$likers." utenti<p>");
                    }
                    //Possibilità per il creatore di eliminare il post
                    if($utente==$creatore){
                      echo("<a class='eliminacom' href=EliminaPost.php?id=".$idPost."><img src='img/delete.png' width='50px' height='50px'></img></a>");
                    }
                    //form per commentare, solo per utenti loggati
                    echo("<h2 id='sez'>Commenta</h2>
                        <form action='Commento.php' method='post'>
                          <textarea class='insertcomment' name='Scritto'  placeholder='commento...' id = 'Textcom' maxlength='250' value=''></textarea></br>
                          <input class='bottonecomm' type='submit' id= 'commento' name='Submit' value='".$idPost."'>
                         </form>");
                    }
                    //recupero commenti post
                    $querycom = "SELECT Testo_com,Id_com,Data_ora_com,Utente_com FROM Commento WHERE Post_com='$idPost' ORDER BY Data_ora_com DESC";
                    $sqlcom = mysqli_query($connessione,$querycom);
                    $contacom = mysqli_num_rows($sqlcom);
                    if ($contacom==0) {
		      //nel caso non ci fossero commenti
                      echo ("<h4>Il post non ha commenti da visualizzare</h4>");
                    }
                    while ($com = mysqli_fetch_array($sqlcom)) {
                      $Idcom= $com['Id_com'];
                      $Datacom= $com['Data_ora_com'];
                      $scrittore= $com['Utente_com'];
                      $Testo = stripslashes($com['Testo_com']);
		      //stampa commento
                      echo ("<p>".$Datacom."</p>");
                      echo ("<h4>".$Testo."</h4>");
                      //credito commentatore
                      $queryscrittore = "SELECT Nome, Cognome FROM Utente WHERE Email='$scrittore'";
                      $sqlscrittore = mysqli_query($connessione,$queryscrittore);
                      while ($scrit = mysqli_fetch_array($sqlscrittore)) {
                        $nome=$scrit['Nome'];
                        $cognome= $scrit['Cognome'];
                        echo ("<p>Scritto da ".$nome." ".$cognome."</p>");
                        if($utente==$scrittore||$utente==$creatore){
			      //possibilità per l'autore di eliminare il commento
                              echo("<a class='eliminacom' href=EliminaCommento.php?id=".$Idcom."><img src='img/delete.png' width='60px' height='60px'></img></a>");
                      }
                    };
                  };
                  }
                };
              }
              ?>
             </div>
           </div>
              <div class="quadropostimm">
              <?php
              include 'Database.php';
              $id=$_SESSION['id'];
              //FORM IMMISSIONE POST
                if(isset($_SESSION['LogIn'])){
                  echo("<form action='Post.php' method='post' enctype='multipart/form-data'>");
                  echo("<h1 class='titoli'>Pubblica un post</h1>");
                  //campi per l'immissione di un post
                  echo("<h3 id = 'block'>Titolo:</h3><br/>");
                  echo("<textarea class='insertcomment' rows ='1' cols = '40' placeholder='Scrivi il titolo' name = 'TitoloPost' id = 'titlePost' value ='' maxlength='40'></textarea><br/>");
                  echo("<h3 id = 'block'>Testo:</h3></br>");
                  echo("<textarea class='insertcomment' rows ='10' cols = '59'  placeholder='Scrivi il testo' name = 'TestoPost' id = 'TextPost' maxlength='500' size='40' value =''></textarea><br/>");
                  echo("<p id = 'limitazione'>Il testo inserito deve essere massimo di 500 caratteri.</p>");
                  echo("<h2>Inserisci un'immagine</h2>");
                  echo("<h6>Dimensione max: 3 MB. Formati consentiti: jpg, png, gif.</h6>");
                  echo("<input type='file' name='image' size='40'/></br>");
                  echo("</br></br><input class = 'tastocrea' type = 'submit' id='post' name = 'Pubblica' value = 'Pubblica'></form>");
                }else {
                  //nel caso l'utente sia ospite, invito a registrarsi
                 echo("</br><h2 class='titoli'>Registrati al nostro sito per scrivere cosa ne pensi!</h2></br>");
                 echo("<a href='SignUp.php' class='tst1'>Sign-Up</a></br></br>");
                 echo("</br><h2 class='titoli'>Se invece sei già registrato</h2></br>");
                 echo("<a href='Home.php' class='tst1'>Log-In</a></br></br>");
                }
              ?>
            </div>
	<footer class='footerpost'>
		<div class="paginazione">
             <?php
             //PAGINAZIONE POST
             if ($all_pages > 1){
	       //stampa link per tornare al post precedente
               if ($pag > 1){
                 echo ("<a class='pag' href=\"".$_SERVER['PHP_SELF']."?pag=".($pag - 1)."\">");
                 echo ("Indietro</a>&nbsp;");
               }
               //ciclo di tutti i post con stampa dei link degli stessi
               for ($p=1; $p<=$all_pages; $p++) {
		 //un post a pagina
                 echo ("<a class='pag' href=\"".$_SERVER['PHP_SELF']."?pag=".$p."\">");
                 echo ($p."</a>&nbsp;");
               }
	       //stampa link per andare al post successivo
               if ($all_pages > $pag){
                 echo ("<a class='pag' href=\"".$_SERVER['PHP_SELF']."?pag=".($pag + 1)."\">");
                 echo ("Avanti</a>");
               }
             }
              ?>
           </div>
	</footer>
		</body>
	</html>
