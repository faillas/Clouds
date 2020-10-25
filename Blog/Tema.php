<?php
    include 'Database.php';
	  include 'Sessione.php';
    //Recupero dati immessi nel form
    $Tema =$_POST['TemaBlog'];
    $blog = $_SESSION['id'];
    //Combinazione valori tema scelto
    $_SESSION['Tema']=$Tema;
    //Aggiorno dati all'interno del database
    $queryTema = "UPDATE Blog SET Nome_tema_blog='$Tema' WHERE Id_blog='$blog'";
    //Esecuzione query
    $sqlTema = mysqli_query($connessione,$queryTema);
    $_SESSION['Tema']=$Tema;
    //Chiudo la connessione e reindirizzo alla pagina creaBlog
    header("location: http://localhost/Blog/VediPost.php");
    mysqli_close($connessione);
?>
