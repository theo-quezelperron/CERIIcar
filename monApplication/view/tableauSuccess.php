<?php if (!is_null($context->correspondance)){
    echo'
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Heure de départ</th>
                <th scope="col">Heure d\'arrivée</th>
                <th scope="col">Prix</th>
                <th scope="col">Durée</th>
                <th scope="col">Heure d\'attente</th> 
                <th scope="col">Nombre de voyages</th>
            </tr>
        </thead>
        <tbody>
               ';
    echo '</br>';
    echo '<div class="collapse" id="collapseExample">
                <div class="card card-body collapsed-content">
                    <div id="htmlContent">
                    </div>
                </div>
            </div>';
        foreach( $context->correspondance_info as $data ): ?>
        <tr>
        <th scope="row"><?php echo $data["id"]; ?></th>
          <td><?php echo $data["depart"]; ?>H00</td>
          <td><?php echo $data["arrivee"]; ?>H00</td>
          <td><?php echo $data["prix"]; ?>€</td>
          <td><?php echo $data["duree"]; ?>H00</td>
          <td class="text-center"><?php echo $data["attente"]; ?>H00</td>
          <td><?php echo $data["nb_voyage"]; ?></td>
          <td><button class="btn btn-primary detail_corres" id=<?php echo'"'.$data["id"].'"';?> data-bs-toggle="collapse" href="#collapseExample" type="button" role="button" aria-expanded="false" aria-controls="collapseExample">+ infos</button>
          <?php 
            if($context->session){
                echo '<td><button class="btn btn-primary reserverG" id="reser' . $data["id"] . '" data-value=' . $data["id"] . '">Réserver</button></td>';
            }?> 
        </tr>
        <?php endforeach ?>
        </tbody>
    </table>    
<?php }?>
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
    <th scope="row"><span id='id_trajet'><?php echo $data["id"]; ?></span></th>
      <td><?php echo $data["depart"]; ?></td>
      <td><?php echo $data["arrivee"]; ?></td>
      <td><?php echo $data["distance"]; ?></td>
      <td><?php echo $data["voyage_nbplace"]; ?></td>
      <td><?php echo $data["tarif"]; ?></td>
      <td><?php echo $data["voyage_heuredepart"]; ?></td>
      <td><?php echo $data["nom"]; ?></td>
      <td><?php echo $data["prenom"]; ?></td>
      <td><?php echo $data["voyage_contraintes"]; ?></td>
      <?php if($context->session){
          echo '<td><input class="reserverPlace" type="number" name="nbplace" value="1" min="1" max="100"></td>';
          echo '<td><button class="btn btn-primary reserverS" data-value=' . $data["voyage_id"] . '">Réserver</button></td>';
      }?>
    </tr>
    <?php endforeach ?>
    </tbody>
</table>
<?php }?>
