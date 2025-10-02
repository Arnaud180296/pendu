<?php 
    declare(strict_types=1);

    function chooseCategory(){
         /**
        * Calcule et affiche le double d'une valeur entière ou flottante.
        *
        * @param float (nombre flottant ou un entier qui sera converti en flottant) $valeur La valeur devant être doublée.
        *
        * @return void (vide) La fonction affiche la valeur doublée mais ne renvoie pas de valeur en dehors de son bloc.
        */
        echo "Choisir une catégorie selon la liste suivante : ".PHP_EOL;
        //echo "\t->\"Enter\" " . "Aléatoire".PHP_EOL;
        foreach(getCategory() as $key => $value){
            echo "\t-> [$key] ". $value.PHP_EOL;
        }

        return readline("Choix de la catégorie : ");
    }
    function chooseRandomWord($words, $categoryIndex){
        $wordIndex = array_rand($words[$categoryIndex]);
        return $words[$categoryIndex][$wordIndex];
    }


    function displayMenu(){
        $options = ["Jouer", "Choisir une catégorie", "Quitter"];

        foreach($options as $option){
            echo "\t -> " . $option.PHP_EOL;
        }
    }

    function displayWordProgress(array $word) : string{
        return implode($word);
    }


    function getCategory() : array{
        /**
        * Renvoie les categories en recupérant les clefs faisant office de séparateur de categories.
        * @return array (vide) La fonction renvoie un tableau.
        */
        return array_keys(readDictionnary());
    }


    function isWordFound(array $word, array $maskedWord) : bool {
        if(str_contains(implode($word), implode($maskedWord)))
            return true;
        return false;
    }

    function updateProgressWord(array $word, string $userInput, array $maskedWord): array {
    for ($i = 0; $i < count($word); $i++) {
        if ($word[$i] === $userInput) {
            $maskedWord[$i] = $userInput;
        }
    }
    return $maskedWord;
}

    function readDictionnary() : array{
        $fileName =  dirname(__DIR__,1) . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . "dictionnaire.json";
        $jsonContent = file_get_contents($fileName);

        $words = json_decode($jsonContent, true);

        return $words;
    }

    function transformWordToHiddenForm(array $word){
        return array_fill(0, count($word), '_');
    }

    
?>