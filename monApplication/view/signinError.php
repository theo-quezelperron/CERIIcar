<form action="/monApplication.php?action=signin" method="post">
    <div class="mb-3">
        <label for="exampleInputUser1" class="form-label">Nom d'utilisateur</label>
        <input type="text" class="form-control" id="pseudo" name="pseudo" aria-describedby="userHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputUser1" class="form-label">Nom</label>
        <input type="text" class="form-control" id="nom" name="nom" aria-describedby="userHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputUser1" class="form-label">Prénom</label>
        <input type="text" class="form-control" id="prénom" name="prénom" aria-describedby="userHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="pass" name="pass">
    </div>
     <button type="submit" class="btn btn-primary enregistrement">S'enregistrer</button>
</form>