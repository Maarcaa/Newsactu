<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RenderController extends AbstractController
{
    public function renderCategoriesInNav(EntityManagerInterface $entityManager): Response
    {
        $categories = $entityManager->getRepository(Category::class)->findBy(['deletedAt' => null]);

        return $this->render('rendered/categories_in_nav.html.twig', [
            'categories' => $categories
        ]);
    }

    public function renderCategoriesInFoot(EntityManagerInterface $entityManager): Response
    {
$categories = $entityManager->getRepository(Category::class)->findBy(['deletedAt' => null]);

        return $this->render('rendered/categories_in_footer.html.twig', [
            'categories' => $categories
        ]);
    }
}


