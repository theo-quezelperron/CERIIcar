<?php

class mainController
{
	//Exo séance1
	public static function helloWorld($request,$context)
	{
		$context->mavariable="hello world";
		return context::SUCCESS;
	}



	public static function index($request,$context){
		
		return context::SUCCESS;
	}
	//Exo séance1
	public static function superTest($request, $context){
		$context->param1 = $_GET['param1'];
		$context->param2 = $_GET['param2'];
		return context::SUCCESS;
	}
	//Exo séance2
	public static function testModel($request, $context){
		$context->user = utilisateurTable::getUserByLoginAndPass('User1','0bc8658ea4e2f64af9d6890eace91a819f9f2046');
      $context->trajet = trajetTable::getTrajet('Marseille','Paris');
      $context->voyages = voyageTable::getVoyagesByTrajet(99);
      $context->reservations = reservationTable::getReservationByVoyage(1);
      $context->userid = utilisateurTable::getUserByID(2);
      return context::SUCCESS;
	}

	//Exo séance 3:
	//Méthode du controller permettant la recherche de voyage en prenant comme argument une ville de départ et une ville d'arrivée
	public static function recherche($request, $context){
		$context->title = "Recherchez votre voyage !";
		//Fonction permettant de peupler les select fields
		$context->villes = trajetTable::getAllVilles();
		if($context->getSessionAttribute('id')){$context->isLogged = true;}
		else {$context->isLogged = false;}
        return context::SUCCESS;
    }

	public static function tableau($request, $context){
		$context->session = false;
		if(isset($_GET["isLogged"])){
			if ($_GET["isLogged"]){
				$context->session = true;
			}
		}
        if (isset($_GET['depart']) && isset($_GET['arrivee']) && isset($_GET['nbplace'])){
			$correspondance = 999;
			$context->alerts = [];
			$context->vDep  = $_GET['depart'];
			$context->vArr  = $_GET['arrivee'];
			$context->nbp   = $_GET['nbplace'];
            
			
			if($_GET['correspondance'] == "false")
            {
                $correspondance = 1;
				$context->trajet = trajetTable::getTrajet( $_GET['depart'],$_GET['arrivee']);
				//$context->voyages = voyageTable::getVoyagesByTrajet($context->trajet->id); <- ne fonctionne pas correctement avec la table
				$em = dbconnection::getInstance()->getEntityManager()->getConnection() ;
				//SELECT * FROM jabaianb.voyage INNER JOIN jabaianb.trajet AS a ON a.id=voyage.trajet INNER JOIN jabaianb.utilisateur AS b ON b.id=voyage.conducteur WHERE trajet = 383;
        		$op = 'SELECT * FROM jabaianb.voyage INNER JOIN jabaianb.trajet AS a ON a.id=voyage.trajet INNER JOIN jabaianb.utilisateur AS b ON b.id=voyage.conducteur WHERE trajet = ' . $context->trajet->id . ' AND nbplace >= ' . $_GET['nbplace'];
        		$query = $em->prepare($op);
        		$query->execute();
				
				if(empty($query)){
					$context->voyages = -9999;
				}
				else {
					$context->voyages = $query->fetchAll();
				}
				if(!is_null($context->voyages)){
					$i = count($context->voyages);
					switch ($i){
						case null:
							$context->alerts["Alerte"] = "Erreur rencontré avec la requête!";
							break;
						case -9999:
							$context->alerts["Warning"] = "Aucun voyage disponible sur ce trajet!";
							break;
						default:
							$context->alerts["Réussite"] = count($context->voyages) > 1 ? count($context->voyages) . " voyages disponibles!" : count($context->voyages) . " voyage disponible!";
							break;
					}
				}
				else {
					$context->alerts["Alerte"] = "Erreur rencontré avec la requête!";
					return context::ERROR;
				}
				return context::SUCCESS;
            }
			else{
				$context->correspondance = voyageTable::getCorrespondances( $_GET['depart'], $_GET['arrivee'], $_GET['nbplace'], $correspondance );
				$context->correspondance_info = voyageTable::getCorrespondancesInfo();
				if(!is_null($context->correspondance_info) || $context->correspondance_info == -9999){
					$i = count($context->correspondance_info);
					switch ($i){
						case null:
							$context->alerts["Alerte"] = "Erreur rencontré avec la requête!";
							break;
						case -9999:
							$context->alerts["Warning"] = "Aucun voyage disponible sur ce trajet!";
							break;
						default:
							$context->alerts["Réussite"] = count($context->correspondance_info) > 1 ? count($context->correspondance_info) . " correspondances disponibles!" : count($context->correspondance_info) . " correspondance disponible!";
							break;
					}
				}
				else {
					$context->alerts["Alerte"] = "Erreur rencontré avec la requête!";
					return context::ERROR;
				}
				return context::SUCCESS;
			}
			}
		else
		{
		$context->vDep  = null; 
		$context->vArr  = null; 
		$context->nbp   = null; 

		$context->alerts["Alerte"] = "Erreur rencontré avec la requête!";
		return context::ERROR;
		}
	}

	public static function detailCorres($request, $context){
		//$context->session = $_SESSION;//Ne semble pas fonctionner avec Ajax ???
		$context->alerts = [];
		$context->session = false;
		if(isset($_GET["isLogged"])){
			if ($_GET["isLogged"]){
				$context->session = true;
			}
		}
		if(isset($_GET["id_corres"])){
			$em = dbconnection::getInstance()->getEntityManager()->getConnection() ;
			//SELECT * FROM jabaianb.voyage INNER JOIN jabaianb.trajet AS a ON a.id=voyage.trajet INNER JOIN jabaianb.utilisateur AS b ON b.id=voyage.conducteur WHERE trajet = 383;
			$op = 'SELECT array_agg(id) FROM tmp_correspondance WHERE id_corres = '. $_GET["id_corres"] .';';
			$query = $em->prepare($op);
			$query->execute();
			if(empty($query)){
				$context->corres_info = -9999;
			}
			else {
				$context->corres_info = $query->fetchAll();
			}
			$context->corres_info = str_replace("{", "(", $context->corres_info[0]["array_agg"]);
			$context->corres_info = str_replace("}", ")", $context->corres_info);
			if(!is_null($context->corres_info)){
				$i = count($context->corres_info);
				switch ($i){
					case null:
						$context->alerts["Alerte"] = "Erreur rencontré avec la requête!";
						break;
					case -9999:
						$context->alerts["Warning"] = "Aucun voyage disponible sur ce trajet!";
						break;
					default:
						$context->alerts["Réussite"] = "Détails correctement récupérés";
						break;
				}
				$op1 = 'SELECT voyage.id AS voyage_id, voyage.conducteur AS voyage_conducteur, voyage.trajet AS voyage_trajet, voyage.tarif AS voyage_tarif, voyage.nbplace AS voyage_nbplace, voyage.heuredepart AS voyage_heuredepart, voyage.contraintes AS voyage_contraintes, a.*, b.* FROM jabaianb.voyage INNER JOIN jabaianb.trajet AS a ON a.id=voyage.trajet INNER JOIN jabaianb.utilisateur AS b ON b.id=voyage.conducteur WHERE voyage.id IN '. $context->corres_info .';'; 
				$query1 = $em->prepare($op1);
				$query1->execute();
				if(empty($query1)){
					$context->voyages = -9999;
				}
				else {
					$context->voyages = $query1->fetchAll();
				}
				if(!is_null($context->voyages)){
					$i = count($context->voyages);
					switch ($i){
						case null:
							$context->alerts["Alerte"] = "Erreur rencontré avec la requête!";
							break;
						case -9999:
							$context->alerts["Warning"] = "Aucun voyage disponible sur ce trajet!";
							break;
						default:
							$context->alerts["Réussite"] = "Détails correctement récupérés";
							break;
					}
				}
				else {
					$context->alerts["Alerte"] = "Erreur rencontré avec la requête!";
					return context::ERROR;
				}
				return context::SUCCESS;
			}
			else {
				$context->alerts["Alerte"] = "Erreur rencontré avec la requête!";
				return context::ERROR;
			}
			
		}
		else{
			return context::ERROR;
		}
	}

	public static function login($request, $context)
    {
        if(!is_null(utilisateurTable::getUserByPseudo($_POST['cpseudo'])))
        {
            $em = dbconnection::getInstance()->getEntityManager()->getConnection() ;
            $op = 'SELECT * FROM jabaianb.utilisateur WHERE identifiant = \''. $_POST['cpseudo'] .'\';';
            $query = $em->prepare($op);
            $bool = $query->execute();
            $res = $query->fetch(PDO::FETCH_ASSOC);
            if(strcmp(sha1($_POST['cpass']), $res['pass']) == 0)
            {
				if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
                $_SESSION['id'] = $res['id'];
                $_SESSION['nom'] = $res['nom'];
                $_SESSION['prenom'] = $res['prenom'];
                $_SESSION['identifiant'] = $res['identifiant'];
				$context->alerts["Réussite"] = "Vous êtes connecté";
				if (!empty($_SESSION['id'])){$context->isLogged = true;}
                return context::SUCCESS;
            }
            $context->alerts["Alert"] = "Mot de passe/Pseudo incorrect!";
            return context::ERROR;
        }
        $context->alerts["Warning"] = "Nous ne parvenons pas à retrouver votre pseudo, êtes vous bien inscrit?";
        return context::ERROR;
    }

	public static function logout($request, $context)
	{
		session_unset();
		//unset($_SESSION);
		$context->alerts["Réussite"] = "Vous êtes déconnecté";
		return context::SUCCESS;
	}

	public static function signinForm($request, $context){
		return context::SUCCESS;
	}

	public static function signin($request,$context)
    {
		$context->alerts = [];
		if((isset($_POST['pseudo']) && $_POST['pseudo'] != "") && (isset($_POST['pass']) && $_POST['pass'] != "") && (isset($_POST['nom']) && $_POST['nom'] != "") && (isset($_POST['prenom']) && $_POST['prenom'] != ""))
		{
			if(is_null(utilisateurTable::getUserByPseudo($_POST['pseudo'])))
			{
				$em = dbconnection::getInstance()->getEntityManager()->getConnection() ;
				$op = 'INSERT INTO jabaianb.utilisateur (identifiant, pass, nom, prenom) VALUES (\'' . $_POST["pseudo"] . '\', \'' . sha1($_POST["pass"]) . '\', \'' . $_POST["nom"] . '\', \'' . $_POST["prenom"] . '\');';
				$query = $em->prepare($op);
				$bool = $query->execute();
				$context->alerts["Réussite"] = "Vous vous êtes enregistré, veuillez vous connecter maintenant!";
				return context::SUCCESS;
			}
			else
			{
				$context->alerts["Warning"] = "Identifiant déjà pris !";
				return context::ERROR;
			}
		}
        else
		{
			$context->alerts["Warning"] = "Formulaire non valide, veuillez réessayer!";
			return context::ERROR;
		}
    }

	public static function ajouter($request,$context)
	{
		return context::SUCCESS;
	}

	public static function reserverG($request, $context)
	{

        if(isset($_POST['id_corres']) and isset($_POST['nbplace']))
        {
            $dispo = voyageTable::checkCorresDispo( $_POST['id_corres'], $_POST['nbplace']);

            $context->dispo = $dispo;

            if( $dispo[0]['checkcorresdispo'] == true )
            {
                $voyages = voyageTable::getVoyageByCorresId( $_POST['id_corres'] );

                $em = dbconnection::getInstance()->getEntityManager()->getConnection() ;

                foreach ($voyages as $key => $voyage)
                {
                    $op = 'update jabaianb.voyage set nbplace = nbplace - ' . $_POST['nbplace'] . ' where id = ' . $voyage['id'] . ';';
                    $query = $em->prepare($op);
                    $bool = $query->execute();

                    $query = $em->prepare('select max( id )+1 as id from jabaianb.reservation limit 1;');
                    $query->execute();

                    $res = $query->fetch(PDO::FETCH_ASSOC);
                    $newID = $res['id'];

                    $op = 'insert into jabaianb.reservation values (' .$newID .', '.$voyage['id'].', '.$_SESSION['id'].');';
                    $query = $em->prepare($op);
                    $bool = $query->execute();
                }
				$context->alerts["Réussite"] = "L'ensemble de voyage a bien été réservé.";
                return context::SUCCESS;
            }
            else{
				$context->alerts["Warning"] = "Enregistrement impossible!";
                return context::SUCCESS;
        	}
    	}
	}

	public static function reserverSolo($request, $context){
		if(isset($_POST["id_voyage"])){

			if(isset($_POST['id_voyage']) and isset($_POST['nbplace']))
        	{
            $dispo = voyageTable::checkVoyageDispo( $_POST['id_voyage'], $_POST['nbplace']);

            $context->dispo = $dispo;

            if( $dispo[0]['checkvoyagedispo'])
            {

                $em = dbconnection::getInstance()->getEntityManager()->getConnection();
                
				$op = 'update jabaianb.voyage set nbplace = nbplace - ' . $_POST['nbplace'] . ' where id = ' . $_POST['id_voyage'] . ';';
				$query = $em->prepare($op);
				$bool = $query->execute();

				$query = $em->prepare('select max( id )+1 as id from jabaianb.reservation limit 1;');
				$query->execute();

				$res = $query->fetch(PDO::FETCH_ASSOC);
				$newID = $res['id'];

				$op = 'insert into jabaianb.reservation values (' . $newID  . ', ' . $_POST['id_voyage'] . ', ' . $_SESSION['id'] . ');';
				$query = $em->prepare($op);
				$bool = $query->execute();
			
				$context->alerts["Réussite"] = "L'ensemble de voyage a bien été réservé.";
                return context::SUCCESS;
            }
            else{
				$context->alerts["Warning"] = "Enregistrement impossible!";
                return context::SUCCESS;
        	}
			$context->alerts["Alerte"] = "Erreur rencontré avec la requête!";
			return context::ERROR;
    		}
		}
		$context->alerts["Alerte"] = "Erreur rencontré avec la requête!";
		return context::ERROR;
	}
	public static function profil($request, $context){
		if(isset($_SESSION)){$context->session = $_SESSION;}
		$em = dbconnection::getInstance()->getEntityManager()->getConnection() ;
		$op = "SELECT * FROM jabaianb.reservation JOIN jabaianb.utilisateur AS a ON a.id=reservation.voyage JOIN jabaianb.voyage AS b ON b.id=reservation.voyage JOIN jabaianb.trajet AS c ON c.id=b.trajet WHERE voyageur = " . $context->getSessionAttribute('id') . ";";
		$query = $em->prepare($op);
		$bool = $query->execute();
		$context->resa = $query->fetchAll();
		return context::SUCCESS;
	}
}
