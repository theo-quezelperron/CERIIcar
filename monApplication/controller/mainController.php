<?php

class mainController
{

	public static function helloWorld($request,$context)
	{
		$context->mavariable="hello world";
		return context::SUCCESS;
	}



	public static function index($request,$context){
		
		return context::SUCCESS;
	}

	public static function superTest($request, $context){
		$context->param1 = $_GET['param1'];
		$context->param2 = $_GET['param2'];
		return context::SUCCESS;
	}

	public static function testModel($request, $context){
		$context->user = utilisateurTable::getUserByLoginAndPass('Test','Password');
        $context->trajet = trajetTable::getTrajet('Marseille','Paris');
        $context->voyages = voyageTable::getVoyagesByTrajet(1);
        $context->reservations = reservationTable::getReservationByVoyage(1);
        $context->userid = utilisateurTable::getUserByID(1);
        return context::SUCCESS;
	}

}
