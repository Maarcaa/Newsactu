<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoryFixtures extends Fixture
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    # : void ne renvoie rien (il signifie vide)
    {
        $categories = [
            'Politique',
            'Société',
            'Sport',
            'Cinéma',
            'Santé',
            'Mode',
            'Sciences',
            'Musique',
            'Hi-Tech',
            'Ecologie',
            'Gaming'
        ];

        foreach($categories as $cat) {
        

            $category = new Category();

            $category->setName($cat);
            $category->setAlias($this->slugger->slug($cat));

            $category->setCreatedAt(new DateTime());
            $category->setUpdatedAt(new DateTime());

            # La méthode persist() exécute les requêtes SQL en BDD.

            $manager->persist($category);
        }

        # La méthode flush() n'est pas dans la boucle foreach() pour une raison :
        # => cette méthode "vide" l'objet $manager (c'est un container).
        $manager->flush();
    }
}
