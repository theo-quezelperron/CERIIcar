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
        if (isset($_GET['depart']) && isset($_GET['arrivee'])){
			$context->trajet = trajetTable::getTrajet( $_GET['depart'],$_GET['arrivee']);
			$context->voyages = voyageTable::getVoyagesByTrajet($context->trajet->id);
			$context->alerts = [];
			if(!is_null($context->voyages)){
				$i = count($context->voyages);
				switch ($i){
					case null:
						$context->alerts["Alerte"] = "Erreur rencontré avec la requête!";
						break;
					case 0:
						$context->alerts["Warning"] = "Aucun voyage disponible sur ce trajet!";
						break;
					default:
						$context->alerts["Réussite"] = count($context->voyages) . " voyages disponibles!";
						break;
				}
			}
			else {
				$context->alerts["Alerte"] = "Erreur rencontré avec la requête!";
			}
		}
		return context::SUCCESS;
	}
}
