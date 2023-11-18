<?php
    // a besoin du fichier 'Characters.php' pour fonctionner correctement
    require_once 'Characters.php';
    // class heros extends characters : enfant de la classe character et possède ses 
    // caractéristiques
    class heros extends characters{
        // définir les variables en privé
        // car ne doit pas les communiqués
        private $gain;
        private $malus;
        private $screem_war;

        //constructeur : défini les propriétés de la classe
        public function __construct($name, $marbles, $gain, $malus, $screem_war){
            // prend le constructeur du parent
            parent::__construct($name, $marbles);
            $this->gain = $gain;
            $this->malus = $malus;
            $this->screem_war = $screem_war;
        }

        // getter Gain : récupère le gain
        public function getGain(){
            return $this->gain;
        }
        // getter Malus : récupère le malus
        public function getMalus(){
            return $this->malus;
        }
        // getter ScreemWar : récupère le cri de victoire
        public function getScreemWar(){
            return $this->screem_war;
        }
        
        // fonction qui retourne la valeur de calcGain
        // public car elle return la nouvelle valeur marble du joueur 
        // et n'a pas les détails d'un calcul
        public function gain($name, $marbles, $marblesEnnemis, $gain){
            return $this->setMarbles($this->calcTotalGain($name, $marbles, $marblesEnnemis, $gain));
        }
        // calcul du gain accumulé ne doit pas être dévoilé donc private
        // dos de la télécommande, on veut pas que les gens
        // ont accès au détail -> private
        private function calcGain($name, $marbles, $marblesEnnemis, $gain){
            $calcGain = $marblesEnnemis + $gain;
            return $calcGain;
        }
        // calcul du marbles du joueur après rencontre ne doit pas être dévoilé
        // dos de la télécommande, on veut pas que les gens
        // ont accès au détail -> private
        private function calcTotalGain($name, $marbles, $marblesEnnemis, $gain){
            echo "Le joueur " . $name . " a gagné " . $this->calcGain($name, $marbles, $marblesEnnemis, $gain) . " marbles.<br>";
            $marblesReste = $marbles + $this->calcGain($name, $marbles, $marblesEnnemis, $gain);
            return $marblesReste;
        }

        // fonction qui retourne la valeur de calcLose
        // public car elle return la nouvelle valeur marble du joueur 
        // et n'a pas les détails d'un calcul
        public function lose($listEnnemis, $indexEnnemi, $name, $marbles, $marblesEnnemis, $malus){
            return $this->setMarbles($this->calcTotalLose($name, $marbles, $marblesEnnemis, $malus));
        }
        // calcul de la perte ne doit pas être dévoilé donc private
        // dos de la télécommande, on veut pas que les gens
        // ont accès au détail -> private
        private function calcLose($name, $marbles, $marblesEnnemis, $malus){
            $calcLose = $marblesEnnemis + $malus;
            return $calcLose;
        }
        // calcul du marbles du joueur après rencontre ne doit pas être dévoilé
        // dos de la télécommande, on veut pas que les gens
        // ont accès au détail -> private
        private function calcTotalLose($name, $marbles, $marblesEnnemis, $malus){
            $marblesReste = $marbles - $this->calcLose($name, $marbles, $marblesEnnemis, $malus);
            echo "Le joueur " . $name . " a perdu " . $this->calcLose($name, $marbles, $marblesEnnemis, $malus) . " marbles.<br>";
            return $marblesReste;
        }
        // function tricher, n'a pas de donnée sensible donc public
        public function cheat(
            $tableEnnemis, $indexEnnemis,
            $name, $marbles, $marblesEnnemis, 
            $gain){
                // appelle méthode gain
                    $this->gain($name, $marbles, $marblesEnnemis, $gain);
                    // supprime ennemis
                    array_splice($tableEnnemis, $indexEnnemis);
                    
        }

        // fonction public car elle va communiquer avec d'autre class
        // contient pas des données sensibles
        public function destiny($listEnnemis, $indexEnnemi,$name, $marbles, $marblesEnnemis, $gain, $malus){
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
            if ($destiny == $this->compareMarble($marblesEnnemis)){
                // supprime ennemis
                array_splice($listEnnemis, $indexEnnemis);
                return $this->gain($name, $marbles, $marblesEnnemis, $gain);
                // sinon : perdre
            } else {
                return $this->lose($listEnnemis, $indexEnnemi, $name, $marbles, $marblesEnnemis, $malus);
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
                return $marblesCompare;
                // si c'est pair
            } else {
                $marblesCompare = 0;
                return $marblesCompare;
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