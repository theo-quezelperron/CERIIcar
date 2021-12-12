$("#btn_1").on("click", function(){
    console.log("clique");
    let urlString = "ajaxDispatcher.php?action=tableau&depart=" + $("#depart").val() + "&arrivee=" + $("#arrivee").val() 
    let test = $.ajax({
      url: urlString,
      method: "GET",
      success: function(result){
        console.log(result);
        $("#htmlResult").html(result);
        document.getElementsByClassName("alert")[0].style.visibility = "visible";
        setTimeout(function(){
          document.getElementsByClassName("alert")[0].style.visibility = "hidden";// or fade, css display however you'd like.
          //document.getElementsByClassName("alert")[0].remove();
        }, 5000);
        
      },
      error: function(result){
        $("#htmlResult").html(result);
        document.getElementsByClassName("alert")[0].style.visibility = "visible";
        setTimeout(function(){
          document.getElementsByClassName("alert")[0].style.visibility = "hidden";// or fade, css display however you'd like.
          //document.getElementsByClassName("alert")[0].remove();
        }, 5000);
        
      }
    })
    
  });
  // }).done(function(response){
  //         let data = JSON.stringify(response);
  //         elert(data);
  //     })
  
  //     //Ce code sera exécuté en cas d'échec - L'erreur est passée à fail()
  //     //On peut afficher les informations relatives à la requête et à l'erreur
  //     .fail(function(error){
  //         alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
  //     });
  