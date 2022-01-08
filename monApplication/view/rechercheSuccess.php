</br>
<!-- Partie formulaire -->
<div class="container-fluid">
<form>
  <div class="mb-3">
  <label for="depart">ville de départ: </label>
    <select class="form-select" id="depart" name="depart" required>
      <?php foreach( $context->villes["depart"] as $ville ): ?>
      <option value="<?php echo $ville;?>"><?php echo $ville;?></option>
      <?php endforeach ?>
    </select>
  </div>
  <div class="mb-3">
    <label for="arrivee">ville d'arrivée: </label>
    <select class="form-select" id="arrivee" name="arrivee" required>
      <?php foreach( $context->villes["arrivee"] as $ville ): ?>
      <option value="<?php echo $ville;?>"><?php echo $ville;?></option>
      <?php endforeach ?>
    </select>
  </div>
  <div class="mb-3">
    <select class="form-select" id="nbplace" name="nbplace" required>
      <option value="1" selected>1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
    </select>
  </div>
  <div class="mb-3 form-check">
  <input class="form-check-input" type="checkbox" value="true" id="corres">
  <label class="form-check-label" for="flexCheckDefault">
    Correspondance
  </label>
</div>
</form>
<div class="form-recherche">
    <button id="btn_1" class="btn btn-primary" value="Recherché!">GO!</button>
  </div>
</div>

<div id="htmlResult"></div>
