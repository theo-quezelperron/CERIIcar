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
				//$context->voyages = voyageTable::getVoyagesByTrajet($context->trajet->id);
				$em = dbconnection::getInstance()->getEntityManager()->getConnection() ;
        		$op = 'SELECT * FROM jabaianb.voyage WHERE trajet = ' . $context->trajet->id . ' AND nbplace >= ' . $_GET['nbplace'];
        		$query = $em->prepare($op);
        		$bool = $query->execute();
				if ($bool == false){
					$context->voyages = null;
				}
				if(empty($query))
					{
						$context->voyages = 9999;
				}
				else {
					$context->voyages = $query->fetchAll();
				}
				if(!is_null($context->voyage)){
					$i = count($context->voyage);
					switch ($i){
						case null:
							$context->alerts["Alerte"] = "Erreur rencontré avec la requête!";
							break;
						case 9999:
							$context->alerts["Warning"] = "Aucun voyage disponible sur ce trajet!";
							break;
						default:
							$context->alerts["Réussite"] = count($context->voyage) > 1 ? count($context->voyage) . " voyages disponibles!" : count($context->voyages) . " voyage disponible!";
							break;
					}
				}
				else {
					$context->alerts["Alerte"] = "Erreur rencontré avec la requête!";
					return context::ERROR;
				}
            }
			else{
				$context->correspondance = voyageTable::getCorrespondances( $_GET['depart'], $_GET['arrivee'], $_GET['nbplace'], $correspondance );
				$context->corres_info = voyageTable::getCorrespondancesInfo();
				if(!is_null($context->correspondance) || $context->correspondance == 9999){
					$i = count($context->correspondance);
					switch ($i){
						case null:
							$context->alerts["Alerte"] = "Erreur rencontré avec la requête!";
							break;
						case 9999:
							$context->alerts["Warning"] = "Aucun voyage disponible sur ce trajet!";
							break;
						default:
							$context->alerts["Réussite"] = count($context->correspondance) > 1 ? count($context->correspondance) . " correspondances disponibles!" : count($context->voyages) . " correspondance disponible!";
							break;
					}
				}
				else {
					$context->alerts["Alerte"] = "Erreur rencontré avec la requête!";
					return context::ERROR;
				}
			}


			// if(is_null($context->correspondance) || is_null($context->voyage))
			// {
			// 	$context->alerts["Alerte"] = "Erreur rencontré avec la requête!";
			// 	return context::ERROR;
			// }

			return context::SUCCESS;
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
}
