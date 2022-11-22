<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        ['The Walking Dead', 'The Walking Dead is an American post-apocalyptic horror television series based on the comic book series of the same name by Robert Kirkman, Tony Moore, and Charlie Adlard—together forming the core of The Walking Dead franchise. The series features a large ensemble cast as survivors of a zombie apocalypse trying to stay alive under near-constant threat of attacks from zombies known as "walkers" (among other nicknames). With the collapse of modern civilization, these survivors must confront other human survivors who have formed groups and communities with their own sets of laws and morals, sometimes leading to open, hostile conflict between them.', 'category_Action', 'https://www.themoviedb.org/t/p/w533_and_h300_bestv2/zaulpwl355dlKkvtAiSBE5LaoWA.jpg', '2010', 'USA', 'https://wallpapers.com/images/hd/the-walking-dead-rick-and-negan-2ga1a6lj6fbiyzy4-2ga1a6lj6fbiyzy4.jpg', 'https://www.youtube-nocookie.com/embed/sfAc2U20uyg'],
        ['Big Bang Theory', 'The Big Bang Theory is a comedy about brilliant physicists, Leonard and Sheldon, who are the kind of "beautiful minds" that understand how the universe works. But none of that genius helps them interact with people, especially women. All this begins to change when a free-spirited beauty named Penny moves in next door.', 'category_Comedy', 'https://www.themoviedb.org/t/p/w533_and_h300_bestv2/x4DO7mY7usT8BwLiHTUsYT7EKbc.jpg', '2007', 'USA', 'https://wallup.net/wp-content/uploads/2018/03/20/87381-Sheldon_Cooper-The_Big_Bang_Theory-748x421.jpg', 'https://www.youtube-nocookie.com/embed/rCj-Fb1OmXg'],
        ['Game of Thrones', 'Game of Thrones is roughly based on the storylines of the A Song of Ice and Fire book series by George R. R. Martin, set in the fictional Seven Kingdoms of Westeros and the continent of Essos. The series follows several simultaneous plot lines. The first story arc follows a war of succession among competing claimants for control of the Iron Throne of the Seven Kingdoms, with other noble families fighting for independence from the throne. The second concerns the exiled scion\'s actions to reclaim the throne; the third chronicles the threat of the impending winter, as well as the legendary creatures and fierce peoples of the North', 'category_Fantasy', 'https://www.themoviedb.org/t/p/w533_and_h300_bestv2/suopoADq0k8YZr4dQXcU6pToj6s.jpg', '2011', 'USA', 'https://wallpaperaccess.com/full/476729.jpg', 'https://www.youtube-nocookie.com/embed/bjqEWgDVPe0'],
        ['House of the Dragon', 'Based on material from George R. R. Martin\'s book Fire & Blood, House of the Dragon tells the story of the Dance of Dragons and the events leading up to the brutal civil war. King Viserys I Targaryen rules over an unprecedented time of peace, but questions about his succession threaten to send the realm into chaos.', 'category_Fantasy', 'https://www.themoviedb.org/t/p/w533_and_h300_bestv2/etj8E2o0Bud0HkONVQPjyCkIvpv.jpg', '2022', 'USA', 'https://image.jeuxvideo.com/medias-crop-1200-675/165901/1659014561-7660-card.jpg', 'https://www.youtube-nocookie.com/embed/DotnJ7tTA34'],
        ['The Watcher', 'The series follows the true story of a married couple who, after moving into their dream home in Westfield, New Jersey, are harassed by letters signed by a stalker who goes by the pseudonym "The Watcher".', 'category_Horror', 'https://www.themoviedb.org/t/p/w533_and_h300_bestv2/kUYeG86YRdx9ef3kCTabuuIRQ90.jpg', '2022', 'USA', 'https://www.canberratimes.com.au/images/transform/v1/crop/frm/Z4Q6sUEHdcmw72MBPYgZkU/40252276-049d-421e-bf17-4f88354034ba.jpg/r824_600_2520_1568_w1200_h678_fmax.jpg', 'https://www.youtube-nocookie.com/embed/5HDkw100sXQ'],
        ['Lucifer', 'The series focuses on Lucifer Morningstar, a handsome and powerful angel who was cast out of Heaven for his rebellion. As the Devil, Lucifer tires of the millennia he spent being the Lord of Hell, punishing people. Becoming increasingly bored and unhappy with his life in Hell, he abdicates his throne in defiance of his father (God) and abandons his kingdom for Los Angeles, where he runs his own nightclub called Lux. When he finds himself involved in a murder investigation, he meets the intriguing Detective Chloe Decker. After helping the Los Angeles Police Department (LAPD) solve the case by using his power to manipulate humans into revealing their deepest desires, Lucifer accepts a subsequent invitation to work with Chloe as a consultant to the department, and throughout the series, they encounter all sorts of supernatural beings while solving crimes together and developing their relationship.', 'category_Fantasy', 'https://www.themoviedb.org/t/p/w533_and_h300_bestv2/xZUZ9i6vVayjyhR1vRo9Bjku4h.jpg', '2016', 'USA', 'https://www.teahub.io/photos/full/31-316384_lucifer-wallpapers-4k-lucifer-wings.png', 'https://www.youtube-nocookie.com/embed/X4bF_quwNtw'],
        ['Money Heist', "Set in Madrid, a mysterious man known as the 'Professor' recruits a group of eight people, who choose city names as their aliases, to carry out an ambitious plan that involves entering the Royal Mint of Spain, and escaping with €984 million. After taking 67 people hostage inside the Mint, the team plans to remain inside for 11 days to print the money as they deal with elite police forces. In the events following the initial heist, the group's members are forced out of hiding and prepare for a second heist, with some additional members, this time aiming to escape with gold from the Bank of Spain, as they again deal with hostages and police forces.", 'category_Action', 'https://www.themoviedb.org/t/p/w533_and_h300_bestv2/gFZriCkpJYsApPZEF3jhxL4yLzG.jpg', '2017', 'Spain', 'https://www.re-thinkingthefuture.com/wp-content/uploads/2021/10/A5699-An-Architectural-Review-of-Money-Heist.jpg', 'https://www.youtube-nocookie.com/embed/_InqQJRqGW4'],
        ['Stranger Things', 'In a small town where everyone knows everyone, a peculiar incident starts a chain of events that leads to a child\'s disappearance, which begins to tear at the fabric of an otherwise-peaceful community. Dark government agencies and seemingly malevolent supernatural forces converge on the town, while a few of the locals begin to understand that more is going on than meets the eye.', 'category_Fantasy', "https://www.themoviedb.org/t/p/w533_and_h300_bestv2/56v2KjBlU4XaOv9rVYEQypROD7P.jpg", '2016', 'USA', 'https://i.insider.com/5a21872a3339b0e7038b4598?width=1200&format=jpeg', 'https://www.youtube-nocookie.com/embed/b9EkMc79ZSU'],
        ['Squid Game', 'Seong Gi-hun, a divorced father and indebted gambler who lives with his elderly mother, is invited to play a series of children\'s games for a chance at a large cash prize. Accepting the offer, he is taken to an unknown location where he finds himself among 455 other players who are all in deep financial trouble. The players are made to wear green tracksuits and are kept under watch at all times by masked guards in pink jumpsuits, with the games overseen by the Front Man, who wears a black mask and black uniform. The players soon discover that losing a game results in their death, with each death adding ₩100 million to the potential ₩45.6 billion grand prize. Gi-hun allies with other players, including his childhood friend Cho Sang-woo and North Korean defector Kang Sae-byeok, to try to survive the physical and psychological twists of the games', 'category_Action', 'https://www.themoviedb.org/t/p/w533_and_h300_bestv2/4y6kEEfdrNIUnWnmELkoc3EmgG7.jpg', '2021', 'South Korea', 'https://static.actu.fr/uploads/2021/10/squid-game-seine-maritime-netflix-ecole.jpg', 'https://www.youtube-nocookie.com/embed/oqxAJKy0ii4'],
        ['The Simpsons', 'The series is a satirical depiction of American life, epitomized by the Simpson family, which consists of Homer, Marge, Bart, Lisa, and Maggie. The show is set in the fictional town of Springfield and parodies American culture and society, television, and the human condition.', 'category_Animation', 'https://www.themoviedb.org/t/p/w533_and_h300_bestv2/hpU2cHC9tk90hswCFEpf5AtbqoL.jpg', '2010', 'USA', 'https://wallup.net/wp-content/uploads/2017/11/23/417191-The_Simpsons-Homer_Simpson-food-Duff-748x421.jpg', 'https://www.youtube-nocookie.com/embed/4rXjCfKRSIE'],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAMS as $value) {
            $program = new Program();
            $program->setTitle($value[0]);
            $program->setSynopsis($value[1]);
            $program->setCategory($this->getReference($value[2]));
            $program->setPoster($value[3]);
            $program->setSlug(urlencode(str_replace(' ', '-', $program->getTitle())));
            $program->setYear($value[4]);
            $program->setCountry($value[5]);
            $program->setBackground($value[6]);
            $program->setTrailer($value[7]);
            $manager->persist($program);
            $this->addReference('program_' . $program->getSlug(), $program);
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
