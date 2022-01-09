<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
       <link rel="stylesheet" href="css/app.css">
       <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
       
      <title>
        CERIcar
      </title>
   
  </head>

  <body>
    <nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
    <a class="navbar-brand" href="https://pedago.univ-avignon.fr/~uapv1801268/CERIIcar/monApplication.php?action=recherche">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="monApplication.php?action=recherche" href="#">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="monApplication.php?action=recherche">Recherche</a>
        </li>
        <?php
        if(!empty($_SESSION)){
          echo '<li class="nav-item">
          <a class="nav-link" href="#">Ajouter un voyage</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Profil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="monApplication.php?action=logout">Logout</a>
        </li>
        ';
        }
        else {
          echo '<li class="nav-item">
          <a class="nav-link" href="monApplication.php?action=signinForm">S\'enregistrer</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown link
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <form action="/monApplication.php?action=login" method="post">
              <div class="mb-3">
                <label for="exampleInputUser1" class="form-label">Nom d\'utilisateur</label>
                <input type="text" class="form-control" id="exampleInputUser1" aria-describedby="userHelp">
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
              </div>
              <button type="submit" class="btn btn-primary">Connection</button>
            </form>
          </ul>
        </li>
        ';
        }
        ?>
        
      </ul>
    </div>
  </div>
    </nav>
    <?php echo '<div class="container"><h2>' . $context->title . '</h2></div>'?>

    <div id="page">
      <?php if($context->error): ?>
      	<div id="flash_error" class="error">
        	<?php echo " $context->error !!!!!" ?>
      	</div>
      <?php endif; ?>
      <div id="page_maincontent">	
      	<?php 
        include($template_view);
        include($nameApp."/view/bandeau.php");
         ?>
      </div>
    </div>
    <script src="js/app.js"></script>
  
  </body>

</html>
