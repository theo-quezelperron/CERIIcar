<?php

require_once "trajet.class.php";

class trajetTable {

  public static function getTrajet($depart,$arrivee)
	{
  	$em = dbconnection::getInstance()->getEntityManager() ;

	$trajetRepository = $em->getRepository('trajet');
	$trajet = $trajetRepository->findOneBy(array('depart' => $depart, 'arrivee'=> $arrivee));	
	
    
	if ($trajet == false){
		echo 'Erreur sql';
			   }
    
	return $trajet; 
	}


	//méthode getAllVilles permetde récupérer sous la forme d'un tableaux l'intégralité des villes de départ et d'arrivée
	public static function getAllVilles()
	{
	
		$em = dbconnection::getInstance()->getEntityManager() ;
  
		$trajetRepository = $em->getRepository('trajet');
		$trajet = $trajetRepository->findAll();	
	  
	  
		if ($trajet == false){
			echo 'Erreur sql';
			}
	  
		return array("depart" => array_unique(array_column($trajet, 'depart')), "arrivee" => array_unique(array_column($trajet, 'arrivee')));

	}
}
?>