<?php
    abstract class characters{
        private $name;
        private $marbles;

        public function __construct($name, $marbles){
            $this->name = $name;
            $this->marbles = $marbles;
        }

        public function getName(){
            return $this->name;
        }

        public function getMarbles(){
            return $this->marbles;
        }
        public function setMarbles($marbles){
            return $this->marbles = $marbles;
        }

        abstract public function lose($listEnnemis, $indexEnnemi, $name, $marbles, $marblesEnnemis, $malus);
        abstract public function gain($name, $marbles, $marblesEnnemis, $gain);
    }
?>