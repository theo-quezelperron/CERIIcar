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
            <th scope="col">Tarif trajet</th>
            <th scope="col">Tarif total</th>
            <th scope="col">Heure de départ</th>
            <th scope="col">Heure d\'arrivée</th>
        </tr>
    </thead>
    <tbody>
           ';
           var_dump($context->info1);
           echo '</br>';
           var_dump($context->info2);
           echo '</br>';    
    foreach( $context->correspondance as $data ): ?>
    <tr>
    <th scope="row">1</th>
      <td><?php echo $data["vdep"]; ?></td>
      <td><?php echo $data["varr"]; ?></td>
      <td><?php echo $data["distance"]; ?></td>
      <td><?php echo $data["nbplace"]; ?></td>
      <td><?php echo $data["tarifpp"]; ?></td>
      <td><?php echo $data["tarifg"]; ?></td>
      <td><?php echo $data["hdep"]; ?></td>
      <td><?php echo $data["harr"]; ?></td>
      <!--<td><?php //echo $data->conducteur->nom; ?></td>
      <td><?php //echo $data->conducteur->prenom; ?></td>
      <td><?php //echo $data->contraintes; ?></td>-->
    </tr>
    <?php endforeach ?>
    </tbody>
</table>
