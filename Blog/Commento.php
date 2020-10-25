<?php
    include 'Database.php';
	  include 'Sessione.php';
    //Recupero dati form
    $Com = $_POST['Scritto'];
    $Commento=addslashes($Com);
    $id = $_POST['Submit'];
    $utente = $_SESSION['Email'];
    $data = date('Y/m/d H:i:s');
    //Se il commento non è stato inserito
    if($Com=""){
        echo("<script type = 'text/javascript'>alert('Commento non inserito!')</script>");
         echo ("<script type='text/javascript'>window.location.href ='http://localhost/Blog/VediPost.php'</script>");
         mysqli_close($connessione);
    }
    else if (strlen($Com)>250){
        echo("<script type = 'text/javascript'>alert('Testo troppo lungo!')</script>");
        echo ("<script type='text/javascript'>window.location.href ='http://localhost/Blog/VediPost.php'</script>");
        mysqli_close($connessione);
    }else{
        //Inserimento dati nel database
        $queryCom = "INSERT INTO Commento(Utente_com,Testo_com,Data_ora_com,Post_com) VALUES('$utente','$Commento','$data','$id')";
        $sqlCom = mysqli_query($connessione,$queryCom);
        //Reindirizzamento alla pagina stessa
        header("location: http://localhost/Blog/VediPost.php");
        //Chiusura della connessione al database
    	  mysqli_close($connessione);
    }
?>
