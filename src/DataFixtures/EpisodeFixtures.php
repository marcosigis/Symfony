<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    const EPISODES = [
        ['1', '1', 'Days Gone Bye', "Sheriff's deputy Rick Grimes wakes from a gunshot-inflicted coma to discover the world overrun with walkers. He goes back to his house to try and find his wife and son but meets survivor Morgan Jones and his son Duane. Deciding to separate from them, Rick heads to Atlanta with a bag of weapons to find his wife Lori and son Carl, unaware they are safe with other survivors, led by his former partner Shane. He encounters hordes of walkers and becomes trapped inside a tank."],
        ['2', '1', 'Guts', "Rick is ambushed by a walker horde but is rescued by scavenger survivor Glenn when he becomes trapped inside a tank. They meet up with the rest of the survivors and study the building to discover the best plan for escape. An unruly teammate, Merle, begins to attract walkers and attack the group and is then cuffed by Rick to a pipe. Glenn and Rick later pose as walkers to go out on the street and successfully rescue the rest of the group, but they are forced to abandon Merle and Rick's gun bag behind in the chaos."],
        ['3', '1', 'Tell It to the Frogs', "Glenn takes Rick to the survivors' camp where he finds Lori, Carl, and Shane. Lori, who had been having an affair with Shane because she believed her husband to be dead, grows resentful of Shane because she now believes Shane purposely told the lie of her husband's death. Feeling guilty and needing more weapons, Rick leads a group, including Glenn, T-Dog, and Merle's younger brother, Daryl, back to Atlanta to recover his weapons and rescue Merle. Upon arriving on the rooftop, they find out that Merle escaped by sawing off his own hand."],
        ['4', '1', 'Vatos', "In Atlanta, the rescue team tries to take Rick's weapon bag off of the street. Glenn is kidnapped by Latino survivors and the group holds a young Latino survivor to trade for Glenn's life. Rick's group briefly scuffles with the Latino survivors, only stopping the war between the two groups when he discovers the other group are protecting the residents of a nursing home. When Rick's group return to their vehicle outside of town, they realize that Merle has taken it and may exact revenge against their group. They return to camp too late to stop a walker horde from attacking, killing many of the survivors, including Andrea's sister Amy, and Carol's husband Ed."],
        ['5', '1', 'Wildfire', "After the survivors bury the dead, Rick leads the rest to the CDC facility in Atlanta against Shane's advice. The CDC appears abandoned and locked-down, and the group are at odds with Rick due to the poor decision. The facility's only survivor, Dr. Edwin Jenner, is initially reluctant but gives in to Rick's desperate pleading and allows them inside."],
        ['6', '1', 'TS-19', "Dr. Edwin Jenner of the CDC welcomes the survivors, allowing them to enjoy the amenities of the powered building while explaining what he knows about walkers. When the survivors discover that the building will self-detonate once it runs out of backup power, Dr. Jenner tries to prevent them from leaving. Rick convinces Jenner to let them go, and Jenner whispers something to Rick. They escape just before the building explodes, and the group departs the city."],

    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::EPISODES as $value) {
            $program = new Episode();
            $program->setNumber($value[0]);
            $program->setSeason($this->getReference($value[1]));
            $program->setTitle($value[2]);
            $program->setSynopsis($value[3]);
            $manager->persist($program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont EpisodeFixtures dépend
        return [
            SeasonFixtures::class,
        ];
    }
}
