</br>
<!-- Partie formulaire -->
<div class="container-fluid">
<form action="" method="get">
  <div class="mb-3">
  <input type="hidden" name="action" value="recherche" required>  
  <label for="depart">ville de départ: </label>
    <select name="depart" required>
      <?php foreach( $context->villes["depart"] as $ville ): ?>
      <option value="<?php echo $ville;?>"><?php echo $ville;?></option>
      <?php endforeach ?>
    </select>
  </div>
  <div class="mb-3">
    <label for="arrivee">ville d'arrivée: </label>
    <select  name="arrivee" required>
      <?php foreach( $context->villes["arrivee"] as $ville ): ?>
      <option value="<?php echo $ville;?>"><?php echo $ville;?></option>
      <?php endforeach ?>
    </select>
  </div>
  <div class="form-recherche">
    <button type="submit" class="btn btn-primary" value="Recherché!">GO!</button>
  </div>
</form>
</div>
<!-- Partie affichage -->
<?php 
//Le code ne s'exécute qu'a la condition que le formulaire ai été submit.
if ($context->req != null){
echo'
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Départ</th>
            <th scope="col">Arrivée</th>
            <th scope="col">Distance</th>
            <th scope="col">Places</th>
            <th scope="col">Tarif</th>
            <th scope="col">Heure de départ</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Contraintes</th>
        </tr>
    </thead>
    <tbody>
           ';    
    foreach( $context->voyages as $data ): ?>
    <tr>
    <th scope="row">1</th>
      <td><?php echo $data->trajet->depart; ?></td>
      <td><?php echo $data->trajet->arrivee; ?></td>
      <td><?php echo $data->trajet->distance; ?></td>
      <td><?php echo $data->nbplace; ?></td>
      <td><?php echo $data->tarif; ?></td>
      <td><?php echo $data->heuredepart; ?></td>
      <td><?php echo $data->conducteur->nom; ?></td>
      <td><?php echo $data->conducteur->prenom; ?></td>
      <td><?php echo $data->contraintes; ?></td>
    </tr>
    <?php endforeach; }?>
    </tbody>
</table>