<!-- Partie formulaire -->
<form action="" method="get" class="form-recherche">
  <div class="form-recherche">
    <input type="hidden" name="action" value="recherche" required>
  </div>
  <div class="form-recherche">
    <label for="depart">ville de départ: </label>
    <select name="depart" required>
      <?php foreach( $context->villes["depart"] as $ville ): ?>
      <option value="<?php echo $ville;?>"><?php echo $ville;?></option>
      <?php endforeach ?>
    </select>
  </div>
  <div class="form-recherche">
    <label for="arrivee">ville d\'arrivée: </label>
    <select  name="arrivee" required>
      <?php foreach( $context->villes["arrivee"] as $ville ): ?>
      <option value="<?php echo $ville;?>"><?php echo $ville;?></option>
      <?php endforeach ?>
    </select>
  </div>
  <div class="form-recherche">
    <button type="submit" value="Recherché!">GO!</button>
  </div>
</form>;

<!-- Partie affichage -->
<?php 
//Le code ne s'exécute qu'a la condition que le formulaire ai été submit.
if ($context->req != null){
echo'
<table>
    <thead>
        <tr>
            <th>Départ</th>
            <th>Arrivée</th>
            <th>Distance</th>
            <th>Places</th>
            <th>Tarif</th>
            <th>Heure de départ</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Contraintes</th>
        </tr>
    </thead>
    <tbody>
           ';    
    foreach( $context->voyages as $data ): ?>
    <tr> 
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