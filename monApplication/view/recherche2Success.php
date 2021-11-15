

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
               
  <?php foreach( $context->voyages as $data ): ?>
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
    <?php endforeach; ?>
    </tbody>
</table>