<?php

namespace App\DataFixtures;

use App\Entity\Business;
use App\Entity\User;
use App\Entity\BusinessCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Collections\ArrayCollection;

class InitialData extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $adminUser = new User();
        $adminUser->setUsername('admin');
        $adminUserPasswd = '$2y$13$eFwRgEZHX9b322A4iAqreuQJPaHYOJZ0YUULt2q2MkMsVvbs094tq'; //Encoded 'admin' string
        $adminUser->setFullName('System Administrator');
        $adminUser->setEmail('admin@domain.com');
        $adminUser->setPassword($adminUserPasswd);
        $adminRoles = $adminUser->setRoles(['ROLE_ADMIN']);
        $manager->persist($adminUser);


        $categories =  new ArrayCollection();
        $businesses = new ArrayCollection();

        $categoryAuto = new BusinessCategory();
        $categoryAuto->setName('Auto');
        $categories[] = $categoryAuto;

        $categoryBeautyFitness = new BusinessCategory();
        $categoryBeautyFitness->setName('Beauty and Fitness');
        $categories[] = $categoryBeautyFitness;

        $categoryEntertainment = new BusinessCategory();
        $categoryEntertainment->setName('Entertainment');
        $categories[] = $categoryEntertainment;

        $categoryFoodDining = new BusinessCategory();
        $categoryFoodDining->setName('Food and Dining');
        $categories[] = $categoryFoodDining;

        $categoryHealth = new BusinessCategory();
        $categoryHealth->setName('Health');
        $categories[] = $categoryHealth;

        $categorySports = new BusinessCategory();
        $categorySports->setName('Sports');
        $categories[] = $categorySports;

        $categoryTravel = new BusinessCategory();
        $categoryTravel->setName('Travel');
        $categories[] = $categoryTravel;

        foreach ($categories as $category) {
            $manager->persist($category);
        }
 
        $mockBusiness01 = new Business();
        $mockBusiness01->setTitle('Goodcars inc.');
        $mockBusiness01->setTelephone('99755588');
        $mockBusiness01->setAddress('36 avenue, 2237');
        $mockBusiness01->setPostalCode('124578');
        $mockBusiness01->setCity('New York City');
        $mockBusiness01->setState('NY');
        $mockBusiness01->setDescription('Barely used and new cars');
        $mockBusiness01->addCategory($categoryAuto);
        $businesses[] = $mockBusiness01;

        $mockBusiness02 = new Business();
        $mockBusiness02->setTitle('Sportzone');
        $mockBusiness02->setTelephone('458775522');
        $mockBusiness02->setAddress('Wildboard Street, 322');
        $mockBusiness02->setPostalCode('123456');
        $mockBusiness02->setCity('Los Angeles');
        $mockBusiness02->setState('CA');
        $mockBusiness02->setDescription('Everything that ou need to pratice any sport');
        $mockBusiness02->addCategory($categorySports); 
        $businesses[] = $mockBusiness02;

        $mockBusiness03 = new Business();
        $mockBusiness03->setTitle('TravelBeuty'); 
        $mockBusiness03->setTelephone('6574445825');
        $mockBusiness03->setAddress('Immigrants Boulevard, 23');
        $mockBusiness03->setPostalCode('187222');
        $mockBusiness03->setCity('Chicago');
        $mockBusiness03->setState('IL');
        $mockBusiness03->setDescription('Being beautful and know all the world');
        $mockBusiness03->addCategory($categoryBeautyFitness);
        $mockBusiness03->addCategory($categoryTravel);       
        $businesses[] = $mockBusiness03;

        $mockBusiness04 = new Business();
        $mockBusiness04->setTitle('BurgerMax');
        $mockBusiness04->setTelephone('55455577441');
        $mockBusiness04->setAddress('Sgt. Loover, 222');
        $mockBusiness04->setPostalCode('234555');
        $mockBusiness04->setCity('Houston');
        $mockBusiness04->setState('TX');
        $mockBusiness04->setDescription('If you think meat and bread, you think BurgerMax');
        $mockBusiness04->addCategory($categoryFoodDining); 
        $businesses[] = $mockBusiness04;

        $mockBusiness05 = new Business();
        $mockBusiness05->setTitle('StandupPizza'); 
        $mockBusiness05->setTelephone('7725258877');
        $mockBusiness05->setAddress('Blv. 2233, 112');
        $mockBusiness05->setPostalCode('111222');
        $mockBusiness05->setCity('Philadelphia');
        $mockBusiness05->setState('PA');
        $mockBusiness05->setDescription('Why don\'t watch standup comedy dining well?');
        $mockBusiness05->addCategory($categoryEntertainment);
        $mockBusiness05->addCategory($categoryFoodDining); 
        $businesses[] = $mockBusiness05;

        $mockBusiness06 = new Business();
        $mockBusiness06->setTitle('VidaLife');
        $mockBusiness06->setTelephone('987774125');
        $mockBusiness06->setAddress('Raccon Vl., 332');
        $mockBusiness06->setPostalCode('120394');
        $mockBusiness06->setCity('Phoenix');
        $mockBusiness06->setState('AZ');
        $mockBusiness06->setDescription('A health lifestile from the distance of a call.');
        $mockBusiness06->addCategory($categoryHealth);  
        $businesses[] = $mockBusiness06;

        $mockBusiness07 = new Business();
        $mockBusiness07->setTitle('Cineland');
        $mockBusiness07->setTelephone('30114758245');
        $mockBusiness07->setAddress('Mojave avenue, 876');
        $mockBusiness07->setPostalCode('376343');
        $mockBusiness07->setCity('San Antonio');
        $mockBusiness07->setState('TX');
        $mockBusiness07->setDescription('Theaters, musical events and more cultural activities for you and your family.');
        $mockBusiness07->addCategory($categoryEntertainment);
        $businesses[] = $mockBusiness07;

        $mockBusiness08 = new Business();
        $mockBusiness08->setTitle('Kart n\' fun');
        $mockBusiness08->setTelephone('784457894');
        $mockBusiness08->setAddress('Main Street, 763');
        $mockBusiness08->setPostalCode('876423');
        $mockBusiness08->setCity('San Diego');
        $mockBusiness08->setState('CA');
        $mockBusiness08->setDescription('Drive fast, duel inside a championship and feel the taste of speed!');
        $mockBusiness08->addCategory($categoryAuto);
        $mockBusiness08->addCategory($categorySports); 
        $businesses[] = $mockBusiness08;

        $mockBusiness09 = new Business();
        $mockBusiness09->setTitle('100 Soccer'); 
        $mockBusiness09->setTelephone('01425789965');
        $mockBusiness09->setAddress('Ford Calffore Street, 99');
        $mockBusiness09->setPostalCode('987232');
        $mockBusiness09->setCity('Dallas');
        $mockBusiness09->setState('TX');
        $mockBusiness09->setDescription('The major company focused on soccer football of US.');
        $mockBusiness09->addCategory($categorySports); 
        $businesses[] = $mockBusiness09;

        $mockBusiness10 = new Business();
        $mockBusiness10->setTitle('AwesomeFit Night & Day'); 
        $mockBusiness10->setTelephone('8787542214');
        $mockBusiness10->setAddress('76 Avenue, 8');
        $mockBusiness10->setPostalCode('761234');
        $mockBusiness10->setCity('San Jose');
        $mockBusiness10->setState('CA');
        $mockBusiness10->setDescription('Be gourgeous with a overstanding body with your training plans.');
        $mockBusiness10->addCategory($categoryBeautyFitness);
        $businesses[] = $mockBusiness10;

        $mockBusiness11 = new Business();
        $mockBusiness11->setTitle('World Travels'); 
        $mockBusiness11->setTelephone('874588222211');
        $mockBusiness11->setAddress('Copernico Blv., 223');
        $mockBusiness11->setPostalCode('111999');
        $mockBusiness11->setCity('Jacksonville');
        $mockBusiness11->setState('FL');
        $mockBusiness11->setDescription('Explore the country, the world and also know every culture.');
        $mockBusiness11->addCategory($categoryTravel);
        $businesses[] = $mockBusiness11;

        foreach ($businesses as $business) {
            $manager->persist($business);
        }

        $manager->flush();
    }
}
