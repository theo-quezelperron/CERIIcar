<?php

require_once "trajet.class.php";

class trajetTable {

  public static function getTrajet($depart,$arrivee)
	{
  	$em = dbconnection::getInstance()->getEntityManager() ;

	$trajetRepository = $em->getRepository('trajet');
	$trajet = $trajetRepository->findBy(array('depart' => $depart, 'arrivee'=> $arrivee));	
	
    
	if ($trajet == false){
		echo 'Erreur sql';
			   }
    
	return $trajet; 
	}
}
?>