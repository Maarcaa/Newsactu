<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     * @Route("/{cat_alias}/{article_alias}_{id}", name="show_article", methods={"GET"})
     */
    public function showArticle(Article $article): Response
    {
        return $this->render("article/show_article.html.twig", [
            'article' => $article
        ]);
    }# end function showArticle()

    // Symfony comprend que le alias doit etre recuperer de $category car il s'agit du 11er parametre de la function

    /**
     * @Route("/voir-article/{alias}", name="show_articles_from_category", methods={"GET"})
     */
public function showArticleFromCategory(Category $category, EntityManagerInterface $entityManager): Response
{
    $articles = $entityManager->getRepository(Article::class)->findBy([
        'category' => $category->getId(),
        'deletedAt' => null
    ]);

    return $this->render("article/show_articles_from_category.html.Twig", [
        'articles' => $articles,
        'category' => $category
    ]);
}

} # end class
