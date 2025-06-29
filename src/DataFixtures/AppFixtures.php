<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $product = new Product();
         $product->setName("tableIkea");
         $product->setDescription("nice table");
         $product->setSize(100);

         $manager->persist($product); //tells the objectManager to
        // make the instance managed and persistent
        // the object will be entered into the db
        // as a result of the flush operation

         $product = new Product();
         $product->setName("bottle");
         $product->setDescription("blue bottle");
         $product->setSize(200);
         $manager->persist($product);

         $manager->flush(); // loads products into the db table
    }
}
