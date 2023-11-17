<?php
    require_once 'Heros.php';
    require_once 'Ennemis.php';
    require_once 'Utils.php';
    class game{
        private $indexHero;
        private $indexEnnemis;
        private $indexDifficulty;

        public function setIndexHero(){
            return $this->indexHero = utils::random(0, 2); 
        }
        public function createHero(){
            $h = 0;
            $listeNomHero = array(
                "Seong Gi-hun",
                "Kang Sae-byeok",
                "Cho Sang-woo", 
            );
            $listeMarblesHero = array(15,25,35);
            $listeGainHero = array(2,1,0);
            $listeMalusHero = array(1,2,3);
            $listeScreemWar = array(
                "Yes !!!",
                "HAHAHA",
                "Okay...",
            );
            $listHero = array();
            foreach($listeNomHero as $hero){
                $hero = new heros(
                    $listeNomHero[$h],
                    $listeMarblesHero[$h],
                    $listeGainHero[$h],
                    $listeMalusHero[$h],
                    $listeScreemWar[$h]
                );
                array_push($listHero, $hero);
                $h++;
            }
            $player = $listHero[$this->setIndexHero()];
            return $player;
        }
        public function listEnnemis(){
            $listeNomEnnemis = array(
                "Victor", "Steve", "Louis", "Silvain", "Luc",
                "Antoine", "Marc", "Julius", "Henry", "Franck",
                "Bruno", "Jeremy", "Pierre", "Antoine", "Léo",
                "Kleine", "Larry","Jean","Jack","Julius"
            );
            return $listeNomEnnemis;
        }
        public function setIndexEnnemis(){
            return $this->index = utils::random(0, count($this->listEnnemis)-1);
        }
        public function createEnnemis(){
            $e = 0;
            $listEnnemies = array();
            foreach($listeNomEnnemis as $ennemis){
                $ennemis = new ennemis(
                    $this->listEnnemis()[$e],
                    utils::random(0,20),
                    utils::random(18,99)
                );
                array_push($listEnnemies, $ennemis);
                $e++;
            }
            $badGuy = $listEnnemies[$this->setIndexEnnemis];
            return $badGuy;
        }

        public function setIndexDifficulty(){
            return $this->indexDifficulty = utils::random(0,2);
        }

        public function difficulty(){
            $totalEnnemis = array(5,10,20);
            $nbrEnnemis = $totalEnnemis[$this->setIndexDifficulty()];
            $nameDifficulty = array ("facile", "difficile", "impossible");
            $chooseDifficulty = $nameDifficulty[$this->setIndexDifficulty()];
            $playedDifficulty = array($chooseDifficulty, $nbrEnnemis);
            return $playedDifficulty;
        }
        public function rencontre(){
            $myPlayer = $this->createHero();
            $this->difficulty();
            $match = 0;
            echo "La difficulté choisi est " . $this->difficulty()[0];
            echo "Vous incarnez le joueur " . $myPlayer->getName(); ", 
            vous possédez " . $myplayer->getMarbles() . " marbles.<br>";
            while($match <= $this->difficulty()[1]){
                $bad = $this->createEnnemis();
                $match++;
                echo "Niveau : " . $match . "<br>";
                echo "Vous avez " . $myPlayer->getMarbles() ." marbles. <br>
                Vous affrontez l'ennemi " .$bad->getName().". Il a " .$bad->getAge()." ans";
                $myplayer->cheat($bad->getAge(), $this->listEnnemis(), $this->setIndexEnnemis, );

            }
        }
    }
    $fight = new game();
    $fight->rencontre();
?>