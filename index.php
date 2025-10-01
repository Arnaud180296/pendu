<?php 
    declare(strict_types=1);

    /**
    * Calcule et affiche le double d'une valeur entière ou flottante.
    *
    * @param float (nombre flottant ou un entier qui sera converti en flottant) $valeur La valeur devant être doublée.
    *
    * @return void (vide) La fonction affiche la valeur doublée mais ne renvoie pas de valeur en dehors de son bloc.
    */

    require __DIR__ . DIRECTORY_SEPARATOR . "moteur" . DIRECTORY_SEPARATOR . "pendu.php";
    

    $play = true;
    while($play){

        //initialisation de la partie
        $lives = 6;
        $usedLetters = [];
        $words = readDictionnary();


        //choix de la categorie
        echo "Choisir une catégorie selon la liste suivante : ".PHP_EOL;
        foreach(getCategory() as $key => $value){
            echo "\t-> [$key] ". $value.PHP_EOL;
        }

        $categoryIndex = readline("Choix de la catégorie : ");
        
        //Ca fonctionne si j'ecris le mot de la categorie 
        //mais j'aimerais pouvoir convertir le texte par le numero d'index
        if(isset($categoryIndex) && !strlen($categoryIndex) > 0 )
            $categoryIndex = array_rand($words);

        echo "CAT : {$categoryIndex}";
        $wordToFind = chooseRandomWord($words, $categoryIndex);

        echo "Voici la solution : {$wordToFind}".PHP_EOL;

        //tant que le mot n'est pas le bon
        echo "Vies restantes : {$lives}".PHP_EOL;
        $userInput = substr(readline("Proposez une lettre : "), 0, 1).PHP_EOL;

        $play = strtolower(readline("Rejouer ? "));
        if($play == "n"){
            echo "test";
            $play = false;
        }

    }
?>