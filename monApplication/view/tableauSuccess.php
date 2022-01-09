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
                <th scope="col">Tarif total</th>
                <th scope="col">Heure d\'attente</th>
                <th scope="col">Nombre de voyages</th>
            </tr>
        </thead>
        <tbody>
               ';
               echo '</br>';    
        foreach( $context->correspondance_info as $data ): ?>
        <tr>
        <th scope="row"><span id='id_corres'><?php echo $data["id"]; ?></span></th>
          <td><?php echo $data["depart"]; ?>H00</td>
          <td><?php echo $data["arrivee"]; ?>H00</td>
          <td><?php echo $data["prix"]; ?>€</td>
          <td><?php echo $data["duree"]; ?>H00</td>
          <td><?php echo $data["attente"]; ?>H00</td>
          <td><?php echo $data["nb_voyage"]; ?></td>
          <td><button class="btn btn-primary detail_corres" id=<?php echo'"'.$data["id"].'"';?> data-bs-toggle="collapse" href="#collapseExample" type="button" role="button" aria-expanded="false" aria-controls="collapseExample">+ infos</button>
        </tr>
        <div class="collapse" id="collapseExample">
			<div class="card card-body collapsed-content">
				<div id="htmlContent">
				</div>
			</div>
		</div>
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
<?php }?>
