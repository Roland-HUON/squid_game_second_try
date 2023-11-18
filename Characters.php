<?php
// class abstract car possède fonction abstract
    abstract class characters{
        // définir les variables en privé
        // car ne veut pas les communiqués
        private $name;
        private $marbles;

        // constructor : défini les propriétés de la class
        public function __construct($name, $marbles){
            $this->name = $name;
            $this->marbles = $marbles;
        }
        // getterName : récupère le nom
        public function getName(){
            return $this->name;
        }
        // getterMarbles : récupère les billes
        public function getMarbles(){
            return $this->marbles;
        }
        // setterMarbles : modifies le nombre de marbles
        public function setMarbles($marbles){
            return $this->marbles = $marbles;
        }
        // abstract car les class enfants vont les définir car pas même chose pour les deux
        abstract public function lose($listEnnemis, $indexEnnemi, $name, $marbles, $marblesEnnemis, $malus);
        abstract public function gain($name, $marbles, $marblesEnnemis, $gain);
    }
?>