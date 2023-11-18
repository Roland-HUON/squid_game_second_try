<?php
// class ennemis extends characters : enfant de la classe character et possède ses 
// caractéristiques
    class ennemis extends characters{
        // définir la variable en privé
        // car ne doit pas les communiqués
        private $age;

        // constructor : défini les propriétés de la classe
        public function __construct($name, $marbles, $age){
            // prend le constructeur du parent
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