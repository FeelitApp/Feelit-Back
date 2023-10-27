<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Repository\FeelingRepository;
use App\Entity\Need;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class NeedsFixtures extends Fixture implements DependentFixtureInterface
{
    //injection de dépendance
    private FeelingRepository $feelingRepository;
    public function __construct(FeelingRepository $feelingRepository){
        $this->feelingRepository = $feelingRepository;
    }
    public function getDependencies()
    {
        return [
            FeelingsFixtures::class,
        ];
    }
    public function load(ObjectManager $manager): void
    {
        $needsArray = [
            ["Colère","Évasion, découvrir des nouveaux endroits, sortir de sa zone de confort. ","https://i.imgur.com/2CVwy1Z.png"],
            ["Honte","Séduire, charmer, flatter son ego. ","https://i.imgur.com/Vdz7sFj.png"],
            ["Joie","Créativité, lancement d'un nouveau projet, participation à une activité. ","https://i.imgur.com/sZA08TS.png"],
            ["Dégoût","Partage, connecter avec des proches. ","https://i.imgur.com/99NVl0P.png"],
            ["Joie","Profiter du moment en pleine conscience. ","https://i.imgur.com/2HWh57u.png"],
            ["Colère","Lacher prise, aller boire un coup, aller promener ses animaux. ","https://i.imgur.com/k1exq5u.png"],
            ["Colère","Se vider la tête, se focaliser sur une tache répétitive, faire du ménage ou du tri. ","https://i.imgur.com/EPsqmVs.png"],
            ["Honte","Restauration de l'estime de soi, demander pardon, s'expliquer avec une personne en particulier. ","https://i.imgur.com/OlzUXXf.png"],
            ["Tristesse","Nouveauté, créer de nouveaux liens, établir des connexions.","https://i.imgur.com/BpWhyZ9.png"],
            ["Dégoût","Repos, calme, activité de détente. ","https://i.imgur.com/iXKsSPg.png"],
            ["Peur","Protection, réassurance, proximité intellectuelle ou physique. ","https://i.imgur.com/lIVYdtv.png"],
            ["Tristesse","Solitude, être dans le silence, limiter les stimulations sensorielles. ","https://i.imgur.com/3gHDWCI.png"],
            ["Honte","Aider, se rendre utile, participer à une bonne cause. ","https://i.imgur.com/0HA3lAl.png"],
            ["Peur","Dormir, satisfaire ses besoins primaires.","https://i.imgur.com/Q3rdHuZ.png"],
            ["Joie","Jouer, rire, lancer un jeu vidéo ou une partie de cartes entre amis. ","https://i.imgur.com/RG2inKk.png"],
            ["Colère","Se défouler, se dépenser physiquement, extérioriser. ","https://i.imgur.com/YFYRny0.png"],
            ["Joie","Célébrer, fêter sa réussite ou celle des autres. ","https://i.imgur.com/vcB6Fpc.png"],
            ["Colère","Douceur, moment cocooning, regarder un film léger.","https://i.imgur.com/dqCUNzY.png"],
            ["Dégoût","Travailler, se concentrer sur un projet, produire quelque chose. ","https://i.imgur.com/dc8O1CB.png"],
            ["Honte","Réconfort, s'épancher, avoir une oreille attentive et empathique.","https://i.imgur.com/Zw6bEOI.png"],
        ];
        // create 20 products! Bam!
        foreach ($needsArray as $n) {
            $need = new Need();
            $needToFeeling = $this->feelingRepository->findOneBy(
                ['category'=>$n[0]]
            );
            $need->setContent($n[1]);
            $need->addIdFeeling($needToFeeling);
            $need->setPicture($n[2]);
            $manager->persist($need);
        }

        $manager->flush();
    }
}
