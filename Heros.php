<?php
    class heros extends characters{
        private $gain;
        private $malus;
        private $screem_war;

        public function __construct($name, $marbles, $gain, $malus, $screem_war){
            parent::__construct($name, $marbles);
        }
    }
?>