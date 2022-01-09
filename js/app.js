$("#btn_1").on("click", function(){
    console.log("clique");
    let urlString = "ajaxDispatcher.php?action=tableau&depart=" + $("#depart").val() + "&arrivee=" + $("#arrivee").val() + "&nbplace=" + $("#nbplace").val() + "&correspondance=" + ($("#correspondance").is(":checked") ? $("#correspondance").val() : 'false');
    let test = $.ajax({
      url: urlString,
      method: "GET",
      processData: false,
      contentType: false,
      success: function(result){
        console.log(result);
        $("#htmlResult").html(result.corps);
        switch (result.bandeau["class"]) {
          case "Alerte":
            $("#bandeau").removeClass();
            $("#bandeau").addClass("alert alert-danger fade show");
            break;
          case "Warning":
            $("#bandeau").removeClass();
            $("#bandeau").addClass("alert alert-warning fade show");
            break;
          case "Réussite":
            $("#bandeau").removeClass();
            $("#bandeau").addClass("alert alert-success fade show");
            break;
          default :
            $("#bandeau").removeClass();
            $("#bandeau").addClass("alert alert-primary fade show");
            break;
        }
        $("#bandeau").html(result.bandeau[value]);
        $("#bandeau").append('<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>');
         
        document.getElementsByClassName("alert")[0].style.display = "block";
        setTimeout(function(){
          document.getElementsByClassName("alert")[0].style.display = "none";// or fade, css display however you'd like.
        }, 10000);
        
      },
      error: function(result){
        let parsed_content = JSON.parse(result);
        $("#htmlResult").html(result.corps);
        document.getElementsByClassName("alert")[0].style.display = "block";
        setTimeout(function(){
          document.getElementsByClassName("alert")[0].style.display = "none";// or fade, css display however you'd like.

        }, 10000);
        
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
  