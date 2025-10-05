<?php

    function mapIntegerToString(callable $callback, $intValue) : string{
        /**
        * Se charge de convertir le numero de la categorie sous forme d'entier vers la version string de la categorie
        * @param array ($callback) represente une methode qui retourne un tableau.
        * @param int ($intValue) represente le numero à faire correspondre en chaine.
        * @return string () retourne une chaine de caractère.
        */
        for ($i=0; $i < count(array_keys($callback())); $i++) { 
            if($i == $intValue){
                return $callback()[$i];
            }
        }

        return "Une erreur est survenue...";
    }
?>