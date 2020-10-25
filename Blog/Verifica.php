<?php
//inclusione file necessari db con relativo script di accesso
include "Database.php";
include "Sessione.php";
//Se è stato compilato il form
if(isset($_POST)){
  //Recupero valori immessi nei campi di registrazione
  $email = $_POST['Email'];
  $password = $_POST['Psw'];
  //Controllo per vedere se si sono inseriti i campi relativi a email e password
  if($email==""||$password==""){
    //Generazione di un alert
        echo("<script type = 'text/javascript'>alert('Nome o password non inseriti!')</script>");
        echo ("<script type='text/javascript'>window.location.href ='http://localhost/Blog/Home.php'</script>");
        mysqli_close($connessione);
    }else{
      //Query per recuperare l'utente registrato che ha email e password uguali a quelle inserite
    $query = "SELECT * FROM Utente WHERE Email = '$email' AND Password_utente = '$password' ";
    $result = mysqli_query($connessione,$query);
    $array = mysqli_fetch_array($result);
    $conta = mysqli_num_rows($result);
    //Se esiste un utente con l'email e la password inserita allora eseguo il login e memorizzo in sessione il nome e l'email
    if ($conta == 1) {
      $_SESSION['Email'] = $array['Email'];
      $_SESSION['Nome'] = $array['Nome'];
      $_SESSION['Sesso'] = $array['Sesso'];
      $_SESSION['LogIn'] = "ok";
      $_SESSION['IdBlog'] = "";
      //Reindirizzo alla pagina home e chiudo la connessione
      header("location: http://localhost/Blog/Home.php");
      mysqli_close($connessione);
    } else { //Se email o password non corrispondono nel database genero un alert
      echo("<script type = 'text/javascript'>alert('Utente non registrato o credenziali non valide!')</script>");
      echo ("<script type='text/javascript'>window.location.href ='http://localhost/Blog/Home.php'</script>");
      //Chiudo la connessione
      mysqli_close($connessione);
    }
    }
}
?>
