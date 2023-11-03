<?php

namespace App\DataFixtures;

use App\Repository\FeelingRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Emotion;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EmotionsFixtures extends Fixture implements DependentFixtureInterface
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
        $EmotionsArray = [
            ["Serein","Joie"],
            ["Confiant","Joie"],
            ["Heureux","Joie"],
            ["Créatif","Joie"],
            ["Fier","Joie"],
            ["Enthousiaste","Joie"],
            ["Euphorique","Joie"],
            ["Rejeté/Humilié","Peur"],
            ["Mal à l'aise","Peur"],
            ["Menacé","Peur"],
            ["Méfiant","Peur"],
            ["Choqué","Peur"],
            ["Angoissé/Anxieux","Peur"],
            ["Désorienté/Perdu","Peur"],
            ["Révolté","Colère"],
            ["Contrarié","Colère"],
            ["Enragé","Colère"],
            ["Vexé","Colère"],
            ["Amer","Colère"],
            ["Frustré","Colère"],
            ["Jaloux","Colère"],
            ["Blessé","Tristesse"],
            ["Dévasté","Tristesse"],
            ["Mélancolique","Tristesse"],
            ["Amorphe","Tristesse"],
            ["Soucieux","Tristesse"],
            ["Vulnérable","Tristesse"],
            ["Découragé","Tristesse"],
            ["Humilié","Honte"],
            ["Non Respecté","Honte"],
            ["Ridiculisé","Honte"],
            ["Inférieur","Honte"],
            ["Différent","Honte"],
            ["Désapprobateur","Dégoût"],
            ["Révulsé","Dégoût"],
            ["Critique","Dégoût"],
            ["Déçu","Dégoût"],
            ["Aversion","Dégoût"],
            ["Mépris","Dégoût"],
            ["Écoeuré","Dégoût"],
        ];

        foreach ($EmotionsArray as $e) {
            $emotion = new Emotion();
            $feelingToEmotion = $this->feelingRepository->findOneBy(
                ['category'=>$e[1]]
            );
            $emotion->setContent($e[0]);
            $emotion->setFeeling($feelingToEmotion);
            $manager->persist($emotion);
        }

        $manager->flush();
    }

}
