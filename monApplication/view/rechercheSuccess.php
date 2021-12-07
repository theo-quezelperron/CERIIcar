</br>
<!-- Partie formulaire -->
<div class="container-fluid">
<form>
  <div class="mb-3">
  <label for="depart">ville de départ: </label>
    <select id="depart" name="depart" required>
      <?php foreach( $context->villes["depart"] as $ville ): ?>
      <option value="<?php echo $ville;?>"><?php echo $ville;?></option>
      <?php endforeach ?>
    </select>
  </div>
  <div class="mb-3">
    <label for="arrivee">ville d'arrivée: </label>
    <select id="arrivee" name="arrivee" required>
      <?php foreach( $context->villes["arrivee"] as $ville ): ?>
      <option value="<?php echo $ville;?>"><?php echo $ville;?></option>
      <?php endforeach ?>
    </select>
  </div>
</form>
<div class="form-recherche">
    <button id="btn_1" class="btn btn-primary" value="Recherché!">GO!</button>
  </div>
</div>

<div id="htmlResult"></div>
<script>
$("#btn_1").click(function(){
  let urlString = "ajaxDispatcher.php?action=tableau&depart=" + $("#depart").val() + "&arrivee=" + $("#arrivee").val() 
  let test = $.ajax({
    url: urlString,
    method: "GET",
    success: function(result){
      $("#htmlResult").html(result);
      document.getElementsByClassName("alert")[0].style.visibility = "visible";
      setTimeout(function(){
        document.getElementsByClassName("alert")[0].style.visibility = "hidden";// or fade, css display however you'd like.
        document.getElementsByClassName("alert")[0].remove();
      }, 5000);
      
    },
    error: function(result){
      $("#htmlResult").html(result);
      document.getElementsByClassName("alert")[0].style.visibility = "visible";
      setTimeout(function(){
        document.getElementsByClassName("alert")[0].style.visibility = "hidden";// or fade, css display however you'd like.
        document.getElementsByClassName("alert")[0].remove();
      }, 5000);
      
    }
  })
  console.log(test);
  
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

</script>