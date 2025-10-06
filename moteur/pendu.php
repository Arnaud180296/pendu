<?php 
    declare(strict_types=1);

    function chooseCategory(){
         /**
        * Affiche la liste des categories disponible et retourne le choix de l'utilisateur. (Non respect du principe de Single Responsability).
        * @return string (chaine) retourne le choix de l'utilisateur sous forme de chaine de caractères.
        */
        echo "Choisir une catégorie selon la liste suivante (index / texte): ".PHP_EOL;
        //echo "\t->\"Enter\" " . "Aléatoire".PHP_EOL;
        foreach(getCategory() as $key => $value){
            echo "\t-> [$key] ". $value.PHP_EOL;
        }

        return readline("Choix de la catégorie : ");
    }
    function chooseRandomWord($words, $categoryIndex){
        /**
        * Permet de selectionner un mot dans un json en fonction de la categorie.
        * @return string (chaine) retourne une chaine de caractère.
        */
        $wordIndex = array_rand($words[$categoryIndex]);
        return $words[$categoryIndex][$wordIndex];
    }


    function displayMenu(){
        /**
        * Se charge d'afficher les options d'initialisation d'une partie de pendu.
        */
        $options = ["Jouer", "Choisir une catégorie", "Quitter"];

        foreach($options as $key => $option){
            echo "\t {$key}-> " . $option.PHP_EOL;
        }
    }

    function displayWordProgress(array $word) : string{
        /**
        * Renvoie l'etat de progression du mot en transformant le tableau en une chaine de caractères.
        * @param array ($word) tableau de caractères.
        * @return string (chaine) retourne une chaine de caractère.
        */
        return implode($word);
    }


    function getCategory() : array{
        /**
        * Renvoie les categories, triées par ordre alphabetique, en recupérant les clefs faisant office de séparateur de categories.
        * @return array (vide) La fonction renvoie un tableau.
        */
        $categories = array_keys(readDictionnary());
        sort($categories);
        return $categories;
    }


    function isWordFound(array $word, array $maskedWord) : bool {
        /**
         * Compare le mot à trouver avec le mot entre par le joueur afin de determiner si le mot a ete deviné
         * @param array ($word) tableau de string
         * @param array ($maskedWord) tableau de string
         * 
         * @return (boolean) Renvoie true si $maskedWord correspond à $word
         */
        if(str_contains(implode($word), implode($maskedWord)))
            return true;
        return false;
    }

    function updateProgressWord(array $word, string $userInput, array $maskedWord): array {
        /**
         * Se charge de mettre à jour l'etat du mot à trouver.
         * @param array ($word) tableau de string
         * @param string ($userInput) chaine de caractere 
         * @param array ($maskedWord) tableau de string
         * 
         * @return (array) Renvoie un tableau de chaine de caracteres.
         */
        for ($i = 0; $i < count($word); $i++) {
            if ($word[$i] === $userInput) {
                $maskedWord[$i] = $userInput;
            }
    }
    return $maskedWord;
}

    function readDictionnary() : array{
        /**
         * Lit le contenu du fichier json
         * @return (array) le contenu du ficher sous forme de tableau associatif
         */
        $fileName =  dirname(__DIR__,1) . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . "dictionnaire.json";
        $jsonContent = file_get_contents($fileName);

        $words = json_decode($jsonContent, true);

        return $words;
    }

    function transformWordToHiddenForm(array $word) : array{
        /**
         * Cree un tableau rempli d'underscore d'une taille equivalente à la taille du parametre d'entre.
         * @param array ($word) chaine de caractere
         * @return (array) Renvoie un tableau rempli
         */
        return array_fill(0, count($word), '_');
    }

    
?>