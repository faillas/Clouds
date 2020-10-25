<?php
	//Pagina php per l'eliminazione dell'utente
  include 'Sessione.php';
  include 'Database.php';
  $utente = $_SESSION['Email'];
  //Recupero valori immessi nei campi di registrazione
  $email = $_POST['Email'];
  $password = $_POST['Psw'];
  $utente= $_SESSION['Email'];
  $querypass = "SELECT Password_utente FROM Utente WHERE Email = '$utente'";
  $Risultatipass = mysqli_query($connessione,$querypass);
  while ($Pass = mysqli_fetch_array($Risultatipass)) {
  //Assegnazione variabile dall'array
     $PassUtente = $Pass['Password_utente'];
     }
  //Controllo per vedere se i campi inseriti coincidono con email e password utente
  if($email==$utente&&$PassUtente==$password){
    //elimino l'utente da tutte le tabelle dove è presente
    $queryFollower = "DELETE FROM Follower WHERE Utente_follower ='$utente'";
    $sqlFollower = mysqli_query($connessione,$queryFollower);
    $queryLike = "DELETE FROM LikePost WHERE Utente_like ='$utente'";
    $sqllike = mysqli_query($connessione,$queryLike);
    $queryCom = "DELETE FROM Commento WHERE Utente_com ='$utente'";
    $sqlCom = mysqli_query($connessione,$queryCom);
    $queryBlog = "SELECT Blog_creatore FROM Creatore WHERE Utente_creatore = '$utente'";
    $sqlBlog = mysqli_query($connessione,$queryBlog);
      while ($id = mysqli_fetch_array($sqlBlog)) {
         $idBlog=($id['Blog_creatore']);
         $queryid = "DELETE FROM Blog WHERE Id_blog = '$idBlog'";
         $sqlElimina = mysqli_query($connessione,$queryBlog);
      };
    session_unset();
    session_destroy();
    $queryBlog = "DELETE FROM Utente WHERE Email = '$utente'";
    $sqlElimina = mysqli_query($connessione,$queryBlog);
    header('location:http://localhost/Blog/Home.php');
    mysqli_close($connessione);
  }else {
        echo("<script type = 'text/javascript'>alert('Email o/e Password non corretti!')</script>");
        echo ("<script type='text/javascript'>window.location.href ='http://localhost/Blog/EliminaUtente.php'</script>");
        mysqli_close($connessione);
  }
?>
