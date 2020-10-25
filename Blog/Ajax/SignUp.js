function ajaxLoader() {
  //click per registrarsi
  $("#bottone").on('click', function(e) {
    $.ajax({
      type: "POST",
      url: "Registrazione.php",
      dataType: "html",
      success: function(){
        $(window.location).attr('href','http://localhost/Blog/Home.php');
      },
      error: function(){
        alert("Chiamata fallita, si prega di riprovare...");
      }
    });
  });
}

$(document).on('ready', function() {
    ajaxLoader();
});
