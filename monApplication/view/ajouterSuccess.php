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
        <label for="nbplace">Nombre de places: </label>
        <select class="form-select" id="nbplace" name="nbplace" required>
        <option value="1" selected>1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="exampleInputUser1" class="form-label">Heure de départ</label>
        <input class="reserverPlace" type="number" name="hdepart" value="1" min="1" max="100">
    </div>
    <div class="mb-3">
        <label for="exampleInputUser1" class="form-label">Contraintes/label>
        <input type="text" class="form-control" id="contrainte" name="contrainte" aria-describedby="userHelp">
    </div>
</form>
<button class="btn btn-primary">Ajouter</button>
</div>