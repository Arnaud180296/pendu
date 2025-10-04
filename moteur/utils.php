<?php

    function mapIntegerToString(callable $callback, $intValue){
        for ($i=0; $i < count(array_keys($callback())); $i++) { 
            if($i === $intValue){
                return $callback()[$i];
            }
        }
    }
?>