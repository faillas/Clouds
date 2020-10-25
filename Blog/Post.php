<?php
    include 'Database.php';
    include 'Sessione.php';
    //Recupero dati immessi nel form
    $data = date('Y/m/d H:i:s');
    $titoloPostIb = $_POST['TitoloPost'];
    $titoloPost = addslashes($titoloPostIb);
    $testoPiano = $_POST['TestoPost'];
    $testoPost = addslashes($testoPiano);
    //cartella in cui fare l'upload
    $cartella_upload ='Foto/';
    //array tipo di file consentiti
    $tipi_consentiti = array('gif','png','jpeg','jpg');
    //dimensione massima del file
    $max_byte = 3000000;
    // se il form è stato inviato
    if (isset($_POST['Pubblica'])) {
      //Controllo titolo e post
      if($titoloPost==""||$testoPiano==""){
          echo("<script type = 'text/javascript'>alert('Inserisci un testo e un titolo!')</script>");
          echo("<script type='text/javascript'>window.location.href ='http://localhost/Blog/VediPost.php'</script>");
          mysqli_close($connessione);
      }else if (strlen($testoPost)>500){
          echo("<script type = 'text/javascript'>alert('Testo troppo lungo!')</script>");
          echo("<script type='text/javascript'>window.location.href ='http://localhost/Blog/VediPost.php'</script>");
          mysqli_close($connessione);
      }else{
        $idBlog = $_SESSION['id'];
        $utente = $_SESSION['Email'];
        //Query per inserire i dati nel database
        $queryPost = "INSERT INTO Post (Blog_post,Titolo_post,Testo_post,Data_ora_post) VALUES ('$idBlog','$titoloPost','$testoPost','$data')";
        //Immissione dati nel database
        $Risultati = mysqli_query($connessione,$queryPost);
        //Recupero l'id del post
        $Id = "SELECT Id_Post FROM Post WHERE Blog_post = '$idBlog' AND Titolo_post = '$titoloPost' AND Testo_post = '$testoPost'";
        $queryId = mysqli_query($connessione,$Id);
        //Memorizzo l'id del post corrispondente
        while($Post = mysqli_fetch_array($queryId)){
            $idPost = $Post[0];
            };
          //se è stata inviata l'immagine
          if(isset($_FILES['image'])){
             //verifica che il tipo è fra quelli consentiti
             if(!in_array(strtolower(end(explode('.', $_FILES['image']['name']))),$tipi_consentiti)){
               echo("<script type = 'text/javascript'>alert('Il file non è in un formato consentito (png, jpg, gif)')</script>");
               echo("<script type='text/javascript'>window.location.href ='http://localhost/Blog/VediPost.php'</script>");
               mysqli_close($connessione);
                }
             //verifica che la dimensione del file non eccede quella massima
             else if($_FILES['image']['size'] > $max_byte){
               echo("<script type = 'text/javascript'>alert('Il file non deve superare 3 MB!!')</script>");
               echo("<script type='text/javascript'>window.location.href ='http://localhost/Blog/VediPost.php'</script>");
               mysqli_close($connessione);
                }
             //verifica il successo della procedura di upload nella cartella settata
             else if(!move_uploaded_file($_FILES['image']['tmp_name'], $cartella_upload.$_FILES['image']['name'])){
               echo("<script type = 'text/javascript'>alert('Ops qualcosa è andato storto nella procedura di upload!')</script>");
               echo("<script type='text/javascript'>window.location.href ='http://localhost/Blog/VediPost.php'</script>");
               mysqli_close($connessione);
             // altrimenti significa che è andato tutto ok
             }else{
               //Informazioni immagini
               $dir="Foto/";
               $Directory = $dir.basename($_FILES['image']['name']);
               $Dimensione = $_FILES['image']['size'];
               $queryClouds = "INSERT INTO Immagine (Nome_img,Contenuto,Id_post_img) VALUES('$Directory','$Dimensione','$idPost')";
               $esegui = mysqli_query($connessione,$queryClouds);
                }
             }
    }
    header("location: http://localhost/Blog/VediPost.php");
    mysqli_close($connessione);
  }
?>
