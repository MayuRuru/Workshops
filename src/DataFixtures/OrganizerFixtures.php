<?php

namespace App\DataFixtures;

use App\Entity\Organizer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrganizerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $organizer = New Organizer();
        $organizer->setName('Teleduca');
        $organizer->setCity('Barcelona');
        $manager->persist($organizer);

        $organizer2 = New Organizer();
        $organizer2->setName('Codesai');
        $organizer2->setCity('Girona');
        $manager->persist($organizer2);

        $organizer3 = New Organizer();
        $organizer3->setName('Enginy');
        $organizer3->setCity('Gelida');
        $manager->persist($organizer3);

        $organizer4 = New Organizer();
        $organizer4->setName('Digital');
        $organizer4->setCity('Tarragona');
        $manager->persist($organizer4);
       
        $manager->flush();

        $this->addReference('organizer_1', $organizer);
        $this->addReference('organizer_2', $organizer2);
        $this->addReference('organizer_3', $organizer3);
        $this->addReference('organizer_4', $organizer4);
    }
}
