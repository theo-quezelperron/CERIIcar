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
            ';
            if($context->session){ echo '<th scope="col">Place</th>';} echo '
        </tr>
    </thead>
    <tbody>
           ';    
    foreach( $context->voyages as $data ): ?>
    <tr>
    <th scope="row">1</th>
      <td><?php echo $data["depart"]; ?></td>
      <td><?php echo $data["arrivee"]; ?></td>
      <td><?php echo $data["distance"]; ?>Km</td>
      <td><?php echo $data["voyage_nbplace"]; ?></td>
      <td><?php echo $data["voyage_tarif"]; ?>€</td>
      <td><?php echo $data["voyage_heuredepart"]; ?>H00</td>
      <td><?php echo $data["nom"]; ?></td>
      <td><?php echo $data["prenom"]; ?></td>
      <td><?php echo $data["voyage_contraintes"]; ?></td>
      <?php 
      if($context->session){
          echo '<td><input class="reserverPlace" type="number" name="nbplace" value="1" min="1" max="100"></td>';
          echo '<td><button class="btn btn-primary reserverS" data-value=' . $data["voyage_id"] . '">Réserver</button></td>';
      }?>    
    </tr>
    <?php endforeach ?>
    </tbody>
</table>
<?php }
else {
    echo 'Oups something went wrong!';
}
?>