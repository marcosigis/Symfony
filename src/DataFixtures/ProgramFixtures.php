<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        ['Walking Dead', 'Zombies attack Earth', 'category_Action', 'https://www.merchandisingplaza.fr/225257/2/Posters-The-Walking-Dead-Poster-The-Walking-Dead-l.jpg'],
        ['Big Bang Theory', 'Crazy scientist', 'category_Comedy', 'https://www.merchandisingplaza.fr/255318/2/Posters-Big-Bang-Theory-Poster-Big-Bang-Theory---Comic-l.jpg'],
        ['Game of Thrones', 'Dragons and sorcery', 'category_Fantasy', 'https://m.media-amazon.com/images/I/51V5BvczanL._AC_SX425_.jpg'],
        ['House of the Dragon', 'Prologue of Game of Thrones ', 'category_Fantasy', 'https://static.posters.cz/image/1300/art-photo/house-of-dragon-rhaenyra-targaryen-i139265.jpg'],
        ['The Watcher', 'Creepy house watcher', 'category_Horror', 'https://fr.web.img2.acsta.net/r_1280_720/pictures/22/10/04/09/59/4841136.jpg'],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAMS as $value) {
            $program = new Program();
            $program->setTitle($value[0]);
            $program->setSynopsis($value[1]);
            $program->setCategory($this->getReference($value[2]));
            $program->setPoster($value[3]);
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
