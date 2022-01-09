<div id="htmlResult">
<form action="monApplication.php">
<div class="mb-3">
    <label for="depart">ville de départ: </label>
        <select class="form-select" id="depart" name="depart" required>
        <?php foreach( $context->villes["depart"] as $ville ): ?>
        <option value="<?php echo $ville;?>"><?php echo $ville;?></option>
        <?php endforeach ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="arrivee">ville d'arrivée: </label>
        <select class="form-select" id="arrivee" name="arrivee" required>
        <?php foreach( $context->villes["arrivee"] as $ville ): ?>
        <option value="<?php echo $ville;?>"><?php echo $ville;?></option>
        <?php endforeach ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="exampleInputUser1" class="form-label">Nombre de places</label>
        <input class="reserverPlace" type="number" name="nbplce" value="1" min="1" max="100">
    </div>
    <div class="mb-3">
        <label for="exampleInputUser1" class="form-label">Heure de départ</label>
        <input class="reserverPlace" type="number" name="hdepart" value="1" min="1" max="24">
    </div>
    <div class="mb-3">
        <label for="exampleInputUser1" class="form-label">Contraintes</label>
        <input type="text" class="form-control" id="contrainte" name="contrainte" aria-describedby="userHelp">
    </div>
    <button class="btn btn-primary" type="submit">Ajouter</button>
</form>
</div>