<?php
echo '
<form action="" method="get" class="form-recherche">
  <div class="form-recherche">
    <label for="depart">ville de départ: </label>
    <input type="text" name="depart" id="depart" required>
  </div>
  <div class="form-recherche">
    <label for="arrivee">ville d\'arrivée: </label>
    <input type="text" name="arrivee" id="arrivee" required>
  </div>
  <div class="form-recherche">
    <button type="submit" action="echo(rechercheController::recherche2());" value="Recherché!">
  </div>
</form>';

?>