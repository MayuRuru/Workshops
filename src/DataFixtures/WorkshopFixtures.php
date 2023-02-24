<?php

namespace App\DataFixtures;

use App\Entity\Workshop;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WorkshopFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $workshop = new Workshop();
        $workshop->setTitle('Communitarian videos');
        $workshop->setStartDate(2008);
        $workshop->setDescription('We make videos in neighbourhoods together with highschool teenagers');
        $workshop->setImagePath('https://img.freepik.com/vector-premium/concepto-educacion-linea-e-learning-flat-people-watching-streaming-video-course-computadora-personajes-estudiantes-universitarios-graduacion_87771-4492.jpg?w=996');
        
        // Add data to pivot table:
        $workshop->addOrganizer($this->getReference('organizer_1'));
        $workshop->addOrganizer($this->getReference('organizer_2'));
        
        $manager->persist($workshop);

        $workshop2 = new Workshop();
        $workshop2->setTitle('TDD for beginners');
        $workshop2->setStartDate(2009);
        $workshop2->setDescription('Learn TDD in a fun way');
        $workshop2->setImagePath('https://cdn.ucberkeleybootcamp.com/wp-content/uploads/sites/106/2020/12/tes_gen_blog_code6-800x412.jpg');

        // Add data to pivot table:
        $workshop2->addOrganizer($this->getReference('organizer_3'));
        $workshop2->addOrganizer($this->getReference('organizer_4'));
     
        $manager->persist($workshop2);

        $manager->flush();
    }
}
