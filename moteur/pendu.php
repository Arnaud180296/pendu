<?php 
    declare(strict_types=1);

    /**
    * Calcule et affiche le double d'une valeur entière ou flottante.
    *
    * @param float (nombre flottant ou un entier qui sera converti en flottant) $valeur La valeur devant être doublée.
    *
    * @return void (vide) La fonction affiche la valeur doublée mais ne renvoie pas de valeur en dehors de son bloc.
    */


    function chooseRandomWord($words, $categoryIndex){
        $wordIndex = array_rand($words[$categoryIndex]);
        return $words[$categoryIndex][$wordIndex];
    }

    function getCategory() : array{
        /**
        * Renvoie les categories en recupérant les clefs faisant office de séparateur de categories.
        * @return array (vide) La fonction renvoie un tableau.
        */
        return array_keys(readDictionnary());
    }

    function readDictionnary() : array{
        $fileName =  dirname(__DIR__,1) . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . "dictionnaire.json";
        $jsonContent = file_get_contents($fileName);

        $words = json_decode($jsonContent, true);

        return $words;
    }

    function transformWordToHiddenForm(){

    }
?>