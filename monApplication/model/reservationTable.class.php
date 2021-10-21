<?php
// Inclusion de la classe utilisateur
require_once "voyage.class.php";

class reservationTable {

  public static function getReservationByVoyage( $voyage )
	{
  	$em = dbconnection::getInstance()->getEntityManager() ;

	$reservationRepository = $em->getRepository('reservation');
	$reservations = $reservationRepository->findBy(array('voyage' => $voyage ));	
	
    if ($reservations == false){
		echo 'Erreur sql';
			   }
    
	return $reservations; 
	}

  
}


?>