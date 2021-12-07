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
