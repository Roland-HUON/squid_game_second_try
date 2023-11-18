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
            return $this->index = utils::random(0, count($this->listEnnemis())-1);
        }
        public function createEnnemis(){
            $e = 0;
            $ennemisList = $this->listEnnemis();
            $listEnnemies = array();
            foreach($ennemisList as $ennemis){
                $ennemis = new ennemis(
                    $ennemisList[$e],
                    utils::random(0,20),
                    utils::random(18,99)
                );
                array_push($listEnnemies, $ennemis);
                $e++;
            }
            $badGuy = $listEnnemies[$this->setIndexEnnemis()];
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
            $match = 1;
            $life = 0;
            $groupEnnemi = $this->difficulty()[1];
            echo "La difficulté choisi est " . $this->difficulty()[0]. ".<br>";
            echo "Vous incarnez le joueur " . $myPlayer->getName() . ", 
            vous possédez " . $myPlayer->getMarbles() . " marbles.<br>";
            while($match <= $groupEnnemi){
                $bad = $this->createEnnemis();
                echo "Niveau : " . $match . "<br>";
                echo "Vous avez " . $myPlayer->getMarbles() ." marbles. <br>
                Vous affrontez l'ennemi " .$bad->getName().". Il a " .$bad->getAge()." ans. <br>";
                echo "L'ennemi a " . $bad->getMarbles() . " marbles. <br>";
                if ($bad->getAge()>=70){
                    $cheat = utils::random(0,1);
                    if($cheat == 1){
                        echo "Je triche !<br>";
                        $myPlayer->cheat($this->listEnnemis(), $this->setIndexEnnemis(), 
                        $myPlayer->getName(), $myPlayer->getMarbles(), $bad->getMarbles(), 
                        $myPlayer->getGain());
                        echo "Votre joueur possède " . $myPlayer->getMarbles() . " marbles. <br>";
                        echo "Le level " . $match ." est fini.<br>";
                        if($match>$groupEnnemi){
                            $myPlayer->victory($myPlayer->getName(), $myPlayer->getScreemWar());
                        }
                        continue;
                    }
                }
                echo $myPlayer->destiny($this->listEnnemis(), $this->setIndexEnnemis(), $myPlayer->getName(), 
                $myPlayer->getMarbles(), $bad->getMarbles(), $myPlayer->getGain(),
                $myPlayer->getMalus());
                if ($myPlayer->getMarbles()<=0){
                    echo"Vous avez été tué !";
                    // possibilité de rejouer , si pas déjà fais
                    if($life == 0){
                        $life++;
                        // possibilité de rejouer dans une variable
                        $secondLife = utils::random(0,1);
                        // echo $secondLife;
                        if($secondLife == 1){
                            // si oui recommencer depuis le début
                            $level = 0;
                            $start = 0;
                            echo "Vous avez été réssuciter ! <br>";
                        } else {
                            // si pas relancer
                            // sortir de la boucle while
                            break;
                        }
                    } else {
                        // si déjà rejouer
                        // sortir de la boucle while 
                        break;
                    }
                }
                echo "Votre joueur possède " . $myPlayer->getMarbles() . " marbles. <br>";
                echo "Le level " . $match ." est fini.<br>";
                $match++;
                if($match>$groupEnnemi){
                    $myPlayer->victory($myPlayer->getName(), $myPlayer->getScreemWar());
                }

            }
        }
    }
    $fight = new game();
    $fight->rencontre();
?>