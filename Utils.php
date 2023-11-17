<?php
    class utils{
        // function random
        // public & static car propre à la classe util
        // et doit être utiliser dans d'autres class
        // donc doit être capable de communiquer d'où public
        // renvoie un nombre entier aléatoire entre $min et $max
        public static function random($min, $max){
            return rand($min, $max);
        }
    }
?>