<?php
    require_once 'Characters.php';
    class heros extends characters{
        private $gain;
        private $malus;
        private $screem_war;

        public function __construct($name, $marbles, $gain, $malus, $screem_war){
            parent::__construct($name, $marbles);
            $this->gain = $gain;
            $this->malus = $malus;
            $this->screem_war = $screem_war;
        }
        
        // fonction qui retourne la valeur de calcGain
        // public car elle return et n'a pas les détails d'un calcul
        public function gain($name, $marbles, $marblesEnnemis, $gain){
            return calcGain($name, $marbles, $marblesEnnemis, $gain);
        }
        // calcul du gain ne doit pas être dévoilé donc private
        // dos de la télécommande, on veut pas que les gens
        // ont accès au détail -> private
        private function calcGain($name, $marbles, $marblesEnnemis, $gain){
            $calcGain = $marblesEnnemis + $gain;
            echo "Le joueur " . $name . " a gagné " . $calcGain . " marbles.<br>";
            $marblesReste = $marbles + $calcGain;
            return $marblesReste;
        }

        // fonction qui retourne la valeur de calcLose
        // public car elle return et n'a pas les détails d'un calcul
        public function lose($listEnnemis, $indexEnnemi, $name, $marbles, $marblesEnnemis, $malus){
            return calcLose($listEnnemis, $indexEnnemi, $name, $marbles, $marblesEnnemis, $malus);
        }
        // calcul de la perte ne doit pas être dévoilé donc private
        // dos de la télécommande, on veut pas que les gens
        // ont accès au détail -> private
        private function calcLose($name, $marbles, $marblesEnnemis, $malus){
            $calcLose = $marblesEnnemis + $malus;
            echo "Le joueur " . $name . " a perdu " . $calcLose . " marbles.<br>";
            $marblesReste = $marbles - $calcLose;
            return $marblesReste;
        }
        public function cheat(
            $ageEnnemis, $tableEnnemis, $indexEnnemis,
            $name, $marbles, $marblesEnnemis, 
            $gain){
            if ($ageEnnemis >= 70){
                $cheat = utils::random(0,1);
                if($cheat == 1){
                    echo "Je triche !";
                    gain($name, $marbles, $marblesEnnemis, $gain);
                    array_splice($tableEnnemis, $indexEnnemis,);
                }
            }
        }

        // fonction public car elle va communiquer avec d'autre class
        // contient pas des données sensibles
        public function destiny($name, $marbles, $marblesEnnemis, $gain, $malus){
            // choix du joueur entre pair ou impair
            $destiny = utils::random(0,1);
            if($destiny == 1){
                echo "Vous avez choisi : Impair !<br>";
            } else {
                echo "Vous avez choisi : Pair !<br>";
            }
            // compare si le choix du joueur et la valeur de 
            // compareMarble (ennemi pair ou impair) concorde
            // si oui : gagner
            if ($destiny == compareMarble($marblesEnnemis)){
                gain($name, $marbles, $marblesEnnemis, $gain);
                // sinon : perdre
            } else {
                lose($name, $marbles, $marblesEnnemis, $malus);
            }
        }

        // fonction qui trouve si l'ennemi a un nombre pair
        // ou impair de marbles
        // dos de la télécommande, on veut pas que les gens
        // ont accès au détail -> private
        private function compareMarble($marblesEnnemis){
            $reste = $marblesEnnemis % 2;
            // si c'est impair
            if($reste == 1){
                $marblesCompare = 1;
                return $marbles;
                // si c'est pair
            } else {
                $marblesCompare = 0;
                return $marbles;
            }
        }

        // public car va communiquer dans d'autre class 
        // information pas sensible
        // echo que le joueur a remporté le jeu
        public function victory($name, $screem_war){
            echo $screem_war . " Le joueur " . $name . " remporté 45,6 milliards de Won sud-coréen !";
        }
    }
?>