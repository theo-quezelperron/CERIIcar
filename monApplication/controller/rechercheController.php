<?php

class rechercheController{

    public static function recherche($request, $context){
        
        return context::SUCCESS;
    }

    public static function recherche2($request, $context){
        $context->trajet = trajetTable::getTrajet( $_GET['depart'],$_GET['arrivee']);
        return context::SUCCESS;
    }

}
?>