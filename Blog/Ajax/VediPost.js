function ajaxLoader() {
  //cambio tema
  $("#cambiatema").on('click', function(e) {
    $.ajax({
      type: "POST",
      url: "Tema.php",
      dataType: "html",
      success: function(){
        $(window.location).attr('href','http://localhost/Blog/VediPost.php');
      },
      error: function(){
        alert("Chiamata fallita, si prega di riprovare...");
      }
    });
  })
  //Click per eliminare post
  $("#eliminapost").on('click', function(e) {
    $.ajax({
      type: "POST",
      url: "EliminaPost.php",
      dataType: "html",
      success: function(){
        $(window.location).attr('href','http://localhost/Blog/VediPost.php');
      },
      error: function(){
        alert("Chiamata fallita, si prega di riprovare...");
      }
    });
  })
    //Click per commentare
    $("#commento").on('click', function(e) {
      $.ajax({
        type: "POST",
        url: "Commento.php",
        dataType: "html",
        success: function(){
          $(window.location).attr('href','http://localhost/Blog/VediPost.php');
        },
        error: function(){
          alert("Chiamata fallita, si prega di riprovare...");
        }
      });
    })
    //Click per rimuovere commento
    $("#eliminacom").on('click', function(e) {
      $.ajax({
        type: "POST",
        url: "EliminaCommento.php",
        dataType: "html",
        success: function(){
          $(window.location).attr('href','http://localhost/Blog/VediPost.php');
        },
        error: function(){
          alert("Chiamata fallita, si prega di riprovare...");
        }
      });
    })
    //Click per postare
    $("#post").on('click', function(e) {
      $.ajax({
        type: "POST",
        url: "Post.php",
        dataType: "html",
        success: function(){
          $(window.location).attr('href','http://localhost/Blog/VediPost.php');
        },
        error: function(){
          alert("Chiamata fallita, si prega di riprovare...");
        }
      });
    })
    //Click per like
    $("#like").on('click', function(e) {
      $.ajax({
        type: "POST",
        url: "LikePost.php",
        dataType: "html",
        success: function(){
          $(window.location).attr('href','http://localhost/Blog/VediPost.php');
        },
        error: function(){
          alert("Chiamata fallita, si prega di riprovare...");
        }
      });
    })
    //Click per postare
    $("#dislike").on('click', function(e) {
      $.ajax({
        type: "POST",
        url: "DisLikePost.php",
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
