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
        return context::SUCCESS;
    }

	public static function tableau($request, $context){
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

	public function detailCorres($request, $context){
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
			return context::SUCCESS;
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
				$op1 = 'SELECT * FROM jabaianb.voyage INNER JOIN jabaianb.trajet AS a ON a.id=voyage.trajet INNER JOIN jabaianb.utilisateur AS b ON b.id=voyage.conducteur WHERE voyage.id IN (195, 90);';
				$query1 = $em->prepare($op1);
				$query1->execute();
				if(empty($query1)){
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
							$context->alerts["Réussite"] = "Détails correctement récupérés";
							break;
					}
				}
				else {
					$context->alerts["Alerte"] = "Erreur rencontré avec la requête!";
					return context::ERROR;
				}
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
}
