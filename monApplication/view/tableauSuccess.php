<?php
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
           var_dump($context->info1);    
    foreach( $context->correspondance as $data ): ?>
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
    <?php endforeach ?>
    </tbody>
</table>
