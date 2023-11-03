<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Feeling;

class FeelingsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $feelingsArray = [
            ["Joie","😄"],
            ["Honte","🫣"],
            ["Dégoût","🤢"],
            ["Tristesse","😢"],
            ["Colère","😡"],
            ["Peur","😨"]
        ];
        // create 20 products! Bam!
        foreach ($feelingsArray as $f) {
            $feeling = new Feeling();
            $feeling->setCategory($f[0]);
            $feeling->setEmoji($f[1]);
            $manager->persist($feeling);
        }

        $manager->flush();
    }
}