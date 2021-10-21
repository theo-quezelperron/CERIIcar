<?php
// Inclusion de la classe utilisateur
require_once "voyage.class.php";

class voyageTable {

  public static function getVoyagesByTrajet( $trajet ) 
	{
  	$em = dbconnection::getInstance()->getEntityManager() ;

	$voyageRepository = $em->getRepository('voyage');
	$voyage = $voyageRepository->findBy(array('trajet' => $trajet->id ));	
	
    if ($trajet == false){
		echo 'Erreur sql';
			   }
    
	return $voyage; 
	}
    
}