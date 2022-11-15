<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        ['Walking Dead', 'Zombies attack Earth', 'category_Action'],
        ['Big Bang Theory', 'Crazy scientist', 'category_Comedy'],
        ['Game of Thrones', 'Dragons and sorcery', 'category_Fantasy'],
        ['House of the Dragon', 'Prologue of Game of Thrones ', 'category_Fantasy'],
        ['The Watcher', 'Creepy house watcher', 'category_Horror'],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAMS as $value) {
            $program = new Program();
            $program->setTitle($value[0]);
            $program->setSynopsis($value[1]);
            $program->setCategory($this->getReference($value[2]));
            $manager->persist($program);
        }


        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
        ];
    }
}
