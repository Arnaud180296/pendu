<?php 
    declare(strict_types=1);

    require __DIR__ . DIRECTORY_SEPARATOR . "moteur" . DIRECTORY_SEPARATOR . "pendu.php";
    require __DIR__ . DIRECTORY_SEPARATOR . "moteur" . DIRECTORY_SEPARATOR . "utils.php";
    

    $play = true;
    while($play){

        #region initialisation de la partie
        $lives = 6;
        $usedLetters = [];
        $words = readDictionnary();
        $categoryIndex = "";
        $counter = 1;

        #region menu
        displayMenu();
        $choice = readline("? : ");
        if($choice === "2"){
            break;
        } 
        else if($choice === "1"){
            $categoryIndex = chooseCategory();
            if(is_numeric($categoryIndex))
                $categoryIndex = mapIntegerToString('getCategory', $categoryIndex);
        }else{
            if(isset($categoryIndex) && !strlen($categoryIndex) > 0 )
            $categoryIndex = array_rand($words);
        }
        #endregion menu
        $wordToFind = str_split(chooseRandomWord($words, $categoryIndex));       
        $maskedWord = transformWordToHiddenForm($wordToFind);
        #endregion initialisation de la partie


        #region solution
        echo "La catégorie est : {$categoryIndex}".PHP_EOL;
        echo "Voici la solution : ". implode($wordToFind) .PHP_EOL;
        #endregion solution


        #region boucle de jeu
        while ($lives != 0 && !isWordFound($wordToFind, $maskedWord) ) {
            echo "Vies restantes : {$lives}".PHP_EOL;
            echo "Lettres proposées : [". implode(' - ', $usedLetters) . "]".PHP_EOL;
            echo "Mot : " . displayWordProgress($maskedWord);
            echo ("").PHP_EOL;
            
            do{
                $userInput = strtolower(substr(readline("Proposez une lettre : "), 0, 1));
                if (str_contains(implode($usedLetters), $userInput) || str_contains(implode($maskedWord), $userInput)) {
                        echo "/!\ \"{$userInput}\" à deja été utilisé /!\\".PHP_EOL;
                    }
            } while((str_contains(implode($usedLetters), $userInput) || str_contains(implode($maskedWord), $userInput)));

            echo "" . PHP_EOL;

            if (!str_contains(implode($wordToFind), $userInput)){
                $usedLetters[$counter] = $userInput;
                $lives--;
                $counter++;
                
                echo "La lettre \"$userInput\" ne se trouve pas dans le mot".PHP_EOL;
                echo "".PHP_EOL;
                continue;
            }

            echo "La lettre \"$userInput\" se trouve dans le mot".PHP_EOL;
            $maskedWord = updateProgressWord($wordToFind, $userInput, $maskedWord);

            if(isWordFound($wordToFind, $maskedWord))
                echo "c'est gagné".PHP_EOL;

            echo("").PHP_EOL;
        }
        #endregion boucle de jeu

        echo "Le mot etait ". implode($wordToFind) .PHP_EOL;

        #region rejouer
        $play = strtolower(readline("Rejouer ? "));
        if($play == "n"){
            $play = false;
        }

    }
?>