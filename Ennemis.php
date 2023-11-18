<?php
    class ennemis extends characters{
        private $age;

        public function __construct($name, $marbles, $age){
            parent::__construct($name, $marbles);
            $this->age = $age;
        }

        // public car ne contient pas de donnée sensible
        // retourne l'âge de l'ennemi
        public function getAge(){
            return $this->age;
        }

        // public car ne contient pas de donnée sensible
        // retourne le gain initial de l'ennemi
        public function gain($name, $marbles, $marblesEnnemis, $gain){
            return getMarbles();
        }

        // public car ne contient pas de donnée sensible
        // supprime/tue l'ennemi et met ses marbles à 0
        public function lose($listEnnemis, $indexEnnemi, $name, $marbles, $marblesEnnemis, $malus){
            array_splice($listEnnemis, $indexEnnemi, 1);
            return setMarbles(0);
        }
    }
?>