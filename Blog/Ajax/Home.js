function ajaxLoader() {
  //login
  $("#bottone").on('click', function(e) {
    $.ajax({
      type: "POST",
      url: "Verifica.php",
      dataType: "html",
      success: function(){
        $(window.location).attr('href','http://localhost/Blog/Home.php');
      },
      error: function(){
        alert("Chiamata fallita, si prega di riprovare...");
      }
    });
  })
  //ricerca blog
  $("#cerca").on('click', function(e) {
    $.ajax({
      type: "POST",
      url: "Registrazione.php#Form",
      dataType: "html",
      success: function(){
        $(window.location).attr('href','http://localhost/Blog/Home.php');
      },
      error: function(){
        alert("Chiamata fallita, si prega di riprovare...");
      }
    });
  })
  //seleziona blog da titolo/argomento
  $("#select").on('click', function(e) {
    $.ajax({
      type: "POST",
      url: "infoBlog.php",
      dataType: "html",
      success: function(){
        $(window.location).attr('href','http://localhost/Blog/VediPost.php');
      },
      error: function(){
        alert("Chiamata fallita, si prega di riprovare...");
      }
    });
  })
    //creazione blog
    $("#crea").on('click', function(e) {
      $.ajax({
        type: "POST",
        url: "CreaBlog.php",
        dataType: "html",
        success: function(){
          $(window.location).attr('href','http://localhost/Blog/VediPost.php');
        },
        error: function(){
          alert("Chiamata fallita, si prega di riprovare...");
        }
      });
    })
}

$(document).on('ready', function() {
    ajaxLoader();
});
