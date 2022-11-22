<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    const SEASONS = [
        ['1', '2010', 'When sheriff\'s deputy Rick Grimes of King County, Georgia, wakes from a coma, he discovers the world has been overrun by zombies ("walkers"). After befriending Morgan Jones, Rick travels alone to Atlanta before finding his wife Lori, son Carl, and his police partner and best friend Shane Walsh in the woods with other survivors. After being attacked by walkers at night, the whole group travels back to Atlanta to the Centers for Disease Control (CDC) building, but find from the sole remaining scientist that no cure yet exists for the pandemic.', 'program_The-Walking-Dead'],
        ['2', '2011', "Rick's group, searching for Carol's missing daughter, Sophia, takes shelter at a farm run by Hershel Greene. Tensions with Hershel's family worsen after it is discovered that he has a barn full of walkers: former friends and family members. Rick learns that Shane and Lori were romantically involved while he was in a coma, and that Lori is pregnant. Shane and Rick's friendship deteriorates, until Rick is forced to kill Shane in self-defense. The commotion attracts walkers to the farm, forcing Rick's group and Hershel's family to evacuate.", 'program_The-Walking-Dead'],
        ['3', '2012', "Eight months after fleeing the farm, Rick's group—sans Andrea, but with Hershel's family—finds a remote prison, which they make their new home after clearing it of walkers. Lori is killed from an emergency C section, and Rick starts to become unhinged and hallucinate. Andrea was rescued by Michonne and the two discover Woodbury, a fortified town led by a deceitful man known as 'the Governor' who seeks to destroy the group at the prison. Rick's group launches a raid that destroys Woodbury, but the Governor kills Andrea and escapes. The remaining citizens of Woodbury move into the prison.", 'program_The-Walking-Dead'],
        ['4', '2013', "Several months after the Governor's attack, a deadly flu kills many of the people at the prison. The Governor finds Martinez, his former right-hand man and kills him, taking over his group before leading them into the prison. Rick's group is forced to separate and flee, while Hershel and the Governor are killed. The survivors, divided, face off against the undead and make new acquaintances. They all find numerous signs pointing to a safe haven called Terminus. Group by group, they reunite at Terminus, but Rick's group, sans Carol, is captured for an unknown purpose.", 'program_The-Walking-Dead'],
        ['5', '2014', "The residents of Terminus have become cannibals. Carol leads a charge that frees Rick's group. Some of the group are captured by a group of corrupt cops based out of Grady Memorial Hospital. After the group migrates to Virginia, a stranger named Aaron approaches, inviting them to join the fortified community of Alexandria, led by Deanna Monroe. They quickly realize the residents are ill-prepared to do what it takes to survive. Rick becomes attracted to Jessie Anderson and discovers she has an abusive husband. Deanna signals Rick to execute the man after he kills her husband as Morgan arrives unexpectedly.", 'program_The-Walking-Dead'],
        ['6', '2015', "The residents of Alexandria trust Rick's group to protect the town. A group known as the Wolves use a zombie horde to attack Alexandria, and Deanna and the entire Anderson family (among others) are killed. While recovering, Alexandria learns of a community called the Hilltop. A man called Jesus invites them to trade supplies with Hilltop if they can help end the threat of the extortionist Saviors led by a man named Negan. Although Rick's group decimate one Savior outpost, they are later caught by Negan and forced to submit to him.", 'program_The-Walking-Dead'],
        ['7', '2016', "Negan brutally murders Glenn and Abraham, initiating his rule over Alexandria. His actions initially lead Rick to submit, but Michonne persuades him to fight back. They encounter a community called the Scavengers and ask them for help. Carol and Morgan befriend King Ezekiel, the leader of the Kingdom, while Maggie and Sasha rally the Hilltop. Rosita and Eugene make a bullet to kill Negan. When the bullet is blocked by Lucille, Negan's baseball bat, Negan forcefully recruits Eugene as a Savior. The Saviors and turncoat Scavengers attack Alexandria but are repelled by Sasha's sacrifice and the aid of Kingdom and Hilltop soldiers.", 'program_The-Walking-Dead'],
        ['8', '2017', "Rick, Maggie, and Ezekiel rally their communities into war against Negan and the Saviors. Losses are heavy on both sides and many of the Kingdom's soldiers are killed. Alexandria falls to a Savior attack, and Carl is bitten by a walker. Before euthanizing himself, Carl convinces Rick to end the war and restart society anew. Negan attempts to wipe out Rick and his allies in a final battle, but Eugene thwarts his plan by sabotaging the Saviors' bullets. Rick then wounds Negan. Against Maggie's wishes, Negan is spared and imprisoned, ending the war.", 'program_The-Walking-Dead'],
        ['9', '2018', "Eighteen months after Negan's downfall, Rick proposes building a bridge to ease trading, but this leads to more resentment. Rick is seemingly killed when he destroys the bridge to prevent an invasion of walkers. Six years later, his absence triggers discourse between the communities, and a new walker-controlling threat named the Whisperers demand the survivors do not trespass in their territory. Their leader, Alpha, has acquired a large horde of walkers that she will unleash if they do so. After her daughter Lydia abandons her mother's group for the Kingdom's, Alpha disowns her and massacres many residents during a fair.", 'program_The-Walking-Dead'],
        ['10', '2019', "Alpha begins breaking down the communities with seemingly random walker attacks and acts of sabotage. Under Carol's orders, Negan infiltrates the Whisperers and assassinates Alpha. Her right-hand man Beta takes command of the Whisperers, but he and the horde are defeated by the survivors. Eugene leads a group to West Virginia to meet a new group of survivors. Meanwhile, Michonne travels north to search for Rick after finding evidence he survived his apparent death.", 'program_The-Walking-Dead'],
        ['11', '2020', "Eugene's group convinces the Commonwealth, a large, prosperous community with a strict class system, to lend aid and refuge to the Coalition. Maggie is suspicious of the Commonwealth's true intentions and is proven correct when Director of Operations Lance Hornsby begins subjugating the communities by force.", 'program_The-Walking-Dead'],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SEASONS as $value) {
            $season = new Season();
            $season->setNumber($value[0]);
            $season->setYear($value[1]);
            $season->setDescription($value[2]);
            $season->setProgram($this->getReference($value[3]));
            $manager->persist($season);
            $this->addReference($value[0], $season);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont SeasonFixtures dépend
        return [
            ProgramFixtures::class,
        ];
    }
}
