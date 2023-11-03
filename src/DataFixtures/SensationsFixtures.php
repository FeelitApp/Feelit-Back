<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Repository\FeelingRepository;
use App\Entity\Sensation;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SensationsFixtures extends Fixture implements DependentFixtureInterface
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
        $sensationsArray = [
            ["Joie","Ma respiration est ample, fluide, mes épaules sont relachées. "],
            ["Colère","Mes mâchoires sont serrées, ma respiration est rapide, saccadée, j'ai chaud."],
            ["Tristesse","J'ai les larmes aux yeux, ma gorge est nouée, j'ai un poids sur l'estomac."],
            ["Honte","J'ai des nausées, des frissons, les mains froides, j'évite le regard des autres."],
            ["Joie","Mon débit de parole est rapide, je parle plus fort que d'habitude, je fais des mouvements brusques. "],
            ["Honte","J'ai envie de disparaître ou de me cacher, mes mains sont moites et mes jambes tremblent. "],
            ["Tristesse","Mes membres sont comme anesthésiés, je me sens vide et mes pensées sont confuses. "],
            ["Peur","Je me sens globalement bien, mais j'ai quelques tensions dans la nuque. "],
            ["Joie","J'ai envie de rire aux éclats, je déborde d'énergie, je suis hypersensible à mon environnement. "],
            ["Tristesse","J'en ai plein le dos, je me sens fatigué, démotivé et sans énergie. "],
            ["Peur","J'ai la migraine, je me sens désorientée et plus capable de réfléchir. "],
            ["Honte","Mon souffle est coupé, j'ai l'impression que mon coeur tombe dans ma poitrine. "],
            ["Dégoût","Mon rythme cardiaque est élevé, le sang circule rapidement dans mon corps."],
            ["Joie","Je me sens juste bien. "],
            ["Tristesse","Je me sens juste mal."],
        ];

        foreach ($sensationsArray as $s) {
            $sensation = new Sensation();
            $sensationToFeeling = $this->feelingRepository->findOneBy(
                ['category'=>$s[0]]
            );
            $sensation->setContent($s[1]);
            $sensation->setFeeling($sensationToFeeling);
            $manager->persist($sensation);
        }

        $manager->flush();
    }
}