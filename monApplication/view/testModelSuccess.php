<?php
    
    echo "ID : " . $context->user->id . "<br>";
    echo "Identifiant : " . $context->user->identifiant . "<br>";
    echo "Password : " . $context->user->pass . "<br>";
    echo "Nom : " . $context->user->nom . "<br>";
    echo "Prénom : " . $context->user->prenom . "<br>";
    echo "Avatar : " . $context->user->avatar . "<br>";

    echo "<br>";
    echo "ID : " . $context->trajet->id . "<br>";
    echo "Départ : " . $context->trajet->depart . "<br>";
    echo "Arrivée : " . $context->trajet->arrivee . "<br>";
    echo "Distance : " . $context->trajet->distance . "<br>";
    echo "<br>";
    
    
    foreach ($context->voyages as $voyage){
		echo "<br>";
    	echo "ID : " . $voyage->id . "<br>";
    	echo "Nom conducteur : " . $voyage->conducteur->nom. "<br>";
    	echo "Départ Trajet : " . $voyage->trajet->depart . "<br>";
    	echo "Tarif : " . $voyage->tarif . "<br>";
    	echo "Nombre de places : " . $voyage->nbplace . "<br>";
    	echo "Heure de départ : " . $voyage->heuredepart . "<br>";
    	echo "Contraintes : " . $voyage->contraintes . "<br>";
        
    }
    echo "<br>";

	foreach ($context->reservations as $reservation){
    echo "<br>";
    echo "ID : " . $reservation->id . "<br>";
    echo "Départ voyage : " . $reservation->voyage->trajet->depart . "<br>";
    echo "Nom voyageur : " . $reservation->voyageur->nom . "<br>";
}

    echo "<br>";
    echo "ID : " . $context->userid->id . "<br>";
    echo "Identifiant : " . $context->userid->identifiant . "<br>";
    echo "Password : " . $context->userid->pass . "<br>";
    echo "Nom : " . $context->userid->nom . "<br>";
    echo "Prénom : " . $context->userid->prenom . "<br>";
    echo "Avatar : " . $context->userid->avatar . "<br>";
    
?>