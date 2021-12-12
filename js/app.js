$("#btn_1").on("click", function(){
    console.log("clique");
    let urlString = "ajaxDispatcher.php?action=tableau&depart=" + $("#depart").val() + "&arrivee=" + $("#arrivee").val() 
    let test = $.ajax({
      url: urlString,
      method: "GET",
      processData: false,
      contentType: false,
      success: function(result){
        let parsed_content = JSON.parse(result);
        console.log(parsed_content.bandeau);
        switch (parsed_content.bandeau.class) {
          case "Alerte":
            $("#bandeau").removeClass();
            $("#bandeau").addClass("alert");
            $("#bandeau").addClass("alert-danger");
            break;
          case "Warning":
            $("#bandeau").removeClass();
            $("#bandeau").addClass("alert");
            $("#bandeau").addClass("alert-warning");
            break;
          case "Réussite":
            $("#bandeau").removeClass();
            $("#bandeau").addClass("alert");
            $("#bandeau").addClass("alert-success");
            break;
          default :
            $("#bandeau").removeClass();
            $("#bandeau").addClass("alert");
            $("#bandeau").addClass("alert-primary");
            break;
        }
        $("#bandeau").html(parsed_content.bandeau.value);
        $("#bandeau").append('<span class="closebtn" style="display: block;" onclick="this.parentElement.style.display="none";">&times;</span>');
            
        //$("#htmlResult").html(parsed_content.corps);
        document.getElementsByClassName("alert")[0].style.display = "block";
        document.getElementsByClassName("closebtn")[0].style.display = "block";
        setTimeout(function(){
          document.getElementsByClassName("alert")[0].style.display = "none";// or fade, css display however you'd like.
          document.getElementsByClassName("closebtn")[0].style.display = "none";
          //document.getElementsByClassName("alert")[0].remove();
        }, 5000);
        
      },
      error: function(result){
        $("#htmlResult").html(result);
        document.getElementsByClassName("alert")[0].style.display = "block";
        document.getElementsByClassName("closebtn")[0].style.display = "block";
        setTimeout(function(){
          document.getElementsByClassName("alert")[0].style.display = "none";// or fade, css display however you'd like.
          document.getElementsByClassName("closebtn")[0].style.display = "none";
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
  