<?php
    // a besoin de tous ces fichiers pour fonctionner correctement
    require_once 'Heros.php';
    require_once 'Ennemis.php';
    require_once 'Utils.php';
    class game{
        // définir les variables en privé
        // car ne doit pas les communiqués
        private $indexHero;
        private $indexEnnemis;
        private $indexDifficulty;

        // setter indexhero : va générer & retourner la valeur de l'index héro
        public function setIndexHero(){
            return $this->indexHero = utils::random(0, 2); 
        }
        // fonction création de héro
        public function createHero(){
            // index
            $h = 0;
            // tableau de nom
            $listeNomHero = array(
                "Seong Gi-hun",
                "Kang Sae-byeok",
                "Cho Sang-woo", 
            );
            // tableau de marbles
            $listeMarblesHero = array(15,25,35);
            // tableau de gain
            $listeGainHero = array(2,1,0);
            // tableau de malus
            $listeMalusHero = array(1,2,3);
            // tableau de cri de guerre
            $listeScreemWar = array(
                "Yes !!!",
                "HAHAHA",
                "Okay...",
            );
            // tableau vide où je vais stocker mes héros après les avoir instanciés
            $listHero = array();
            foreach($listeNomHero as $hero){
                // instancier les héros
                $hero = new heros(
                    $listeNomHero[$h],
                    $listeMarblesHero[$h],
                    $listeGainHero[$h],
                    $listeMalusHero[$h],
                    $listeScreemWar[$h]
                );
                // les mettre dans le tableau vide $listHero
                array_push($listHero, $hero);
                // augmenter l'index
                $h++;
            }
            // choix du héro du joueur 
            $player = $listHero[$this->setIndexHero()];
            // retourner le héros du joueur
            return $player;
        }
        // function qui a le tableau des ennemis
        public function listEnnemis(){
            // tableau des noms des ennemis
            $listeNomEnnemis = array(
                "Victor", "Steve", "Louis", "Silvain", "Luc",
                "Antoine", "Marc", "Julius", "Henry", "Franck",
                "Bruno", "Jeremy", "Pierre", "Antoine", "Léo",
                "Kleine", "Larry","Jean","Jack","Julius"
            );
            // retourner le tableau
            return $listeNomEnnemis;
        }
        // function qui retourne & génère un nombre qui sera l'index ennemis
        public function setIndexEnnemis(){
            return $this->index = utils::random(0, count($this->listEnnemis())-1);
        }
        // function création ennemis
        public function createEnnemis(){
            // index
            $e = 0;
            // stocke tableau nom ennemis dans une variable
            $ennemisList = $this->listEnnemis();
            // tableau vide qui stockera les ennemis après instance
            $listEnnemies = array();
            foreach($ennemisList as $ennemis){
                // instancier les ennemis
                $ennemis = new ennemis(
                    $ennemisList[$e],
                    utils::random(0,20),
                    utils::random(18,99)
                );
                // les mettre dans le tableau
                array_push($listEnnemies, $ennemis);
                // augmenter l'index
                $e++;
            }
            // choisi l'ennemi instancier a combattre parmis ceux dans le tableau 
            $badGuy = $listEnnemies[$this->setIndexEnnemis()];
            // retourne cette ennemis
            return $badGuy;
        }

        // function qui renvoie & génère un nombre pour le choix de la difficulté
        public function setIndexDifficulty(){
            return $this->indexDifficulty = utils::random(0,2);
        }

        // function difficulté
        public function difficulty(){
            // tableau du nombre d'ennemi à combattre en fonction de la difficulté
            $totalEnnemis = array(5,10,20);
            $nbrEnnemis = $totalEnnemis[$this->setIndexDifficulty()];
            // tableau nom de la difficulté
            $nameDifficulty = array ("facile", "difficile", "impossible");
            $chooseDifficulty = $nameDifficulty[$this->setIndexDifficulty()];
            // rassembler les éléments de la difficulté 
            $playedDifficulty = array($chooseDifficulty, $nbrEnnemis);
            // retourne cette difficulté
            return $playedDifficulty;
        }

        //function qui gère les combats
        public function rencontre(){
            // stocke le héro du joueur
            $myPlayer = $this->createHero();
            // nombre match
            $match = 1;
            // nombre vie (pour relancer)
            $life = 0;
            // nombre d'ennemi total a affronté
            $groupEnnemi = $this->difficulty()[1];
            // difficulté actuelle
            echo "La difficulté choisi est " . $this->difficulty()[0]. ".<br>";
            // nom du héros incarné par le joueur
            echo "Vous incarnez le joueur " . $myPlayer->getName() . ", 
            vous possédez " . $myPlayer->getMarbles() . " marbles.<br>";
            // boucle while (total combat)
            while($match <= $groupEnnemi){
                // récupère l'ennemi instancié choisi
                $bad = $this->createEnnemis();
                // niveau/match actuel
                echo "Niveau : " . $match . "<br>";
                // dit le marble actuel du joueur
                // le nom de l'ennemi qu'on affronte
                // ainsi que le marble que l'ennemi possède
                echo "Vous avez " . $myPlayer->getMarbles() ." marbles. <br>
                Vous affrontez l'ennemi " .$bad->getName().". Il a " .$bad->getAge()." ans. <br>";
                echo "L'ennemi a " . $bad->getMarbles() . " marbles. <br>";
                // si ennemi a 70 ans
                if ($bad->getAge()>=70){
                    // génère un nombre aléatoire pour décider si on triche
                    $cheat = utils::random(0,1);
                    // si on décide de tricher
                    if($cheat == 1){
                        echo "Je triche !<br>";
                        // active function cheat (voir Heros.php)
                        $myPlayer->cheat($this->listEnnemis(), $this->setIndexEnnemis(), 
                        $myPlayer->getName(), $myPlayer->getMarbles(), $bad->getMarbles(), 
                        $myPlayer->getGain());
                        // dire le nombre de marbles que le joueur a
                        echo "Votre joueur possède " . $myPlayer->getMarbles() . " marbles. <br>";
                        // dire le match/manche/rencontre actuel est fini
                        echo "Le level " . $match ." est fini.<br>";
                        // si match > ennemis affronté alors c'est fini
                        if($match>$groupEnnemi){
                            // appelle function victory
                            $myPlayer->victory($myPlayer->getName(), $myPlayer->getScreemWar());
                            // fin de la boucle while
                            break;
                        }
                        // reviens au début de la boucle while
                        continue;
                    }
                }
                // affronte l'ennemi compare et dis si on gagne ou perd le combat
                $myPlayer->destiny($this->listEnnemis(), $this->setIndexEnnemis(), $myPlayer->getName(), 
                $myPlayer->getMarbles(), $bad->getMarbles(), $myPlayer->getGain(),
                $myPlayer->getMalus());
                // si joueur n'a plus de marbles
                // alors meurt
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
                // dire les marbles actuelle du joueur
                echo "Votre joueur possède " . $myPlayer->getMarbles() . " marbles. <br>";
                // dire que le match actuelle est fini
                echo "Le level " . $match ." est fini.<br>";
                // match est incrémenter de 1
                $match++;
                // si plus de match que d'ennemis affronté alors fini
                if($match>$groupEnnemi){
                    // appelle function victory
                    $myPlayer->victory($myPlayer->getName(), $myPlayer->getScreemWar());
                }

            }
        }
    }
    // instancier la classe game et stocke dans variable fight
    $fight = new game();
    // faire la function rencontre
    $fight->rencontre();
?>