<?php
if (!is_null($context->voyages)){
    echo '
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
      <td><?php echo $data["depart"]; ?></td>
      <td><?php echo $data["arrivee"]; ?></td>
      <td><?php echo $data["distance"]; ?></td>
      <td><?php echo $data["nbplace"]; ?></td>
      <td><?php echo $data["tarif"]; ?></td>
      <td><?php echo $data["heuredepart"]; ?></td>
      <td><?php echo $data["nom"]; ?></td>
      <td><?php echo $data["prenom"]; ?></td>
      <td><?php echo $data["contraintes"]; ?></td>
    </tr>
    <?php endforeach ?>
    </tbody>
</table>
<?php }
else {
    echo 'Oups something went wrong!';
}
?>