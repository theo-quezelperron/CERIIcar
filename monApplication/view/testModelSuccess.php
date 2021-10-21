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
    echo "<br>";
    echo "ID : " . $context->voyage->id . "<br>";
    echo "Nom conducteur : " . $context->voyage->conducteur->nom. "<br>";
    echo "Départ Trajet : " . $context->voyage->trajet->depart . "<br>";
    echo "Tarif : " . $context->voyage->tarif . "<br>";
    echo "Nombre de places : " . $context->voyage->nbplace . "<br>";
    echo "Heure de départ : " . $context->voyage->heuredepart . "<br>";
    echo "Contraintes : " . $context->voyage->contraintes . "<br>";
    echo "<br>";

    echo "<br>";
    echo "ID : " . $context->reservation->id . "<br>";
    echo "Départ voyage : " . $context->reservation->voyage->trajet->depart . "<br>";
    echo "Nom voyageur : " . $context->reservation->voyageur->nom . "<br>";


?>