<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }
    #[Route('/admin/article', name:'admin_article')]
    public function adminArticle(ArticleRepository $repo, EntityManagerInterface $manager)
    {
        $colonnes = $manager->getClassMetadata(Article::class)->getFieldNames();
        // * Pour récuperer tous les nom de colonnes

        $articles = $repo->findAll();
        return $this->render('admin/gestionArticle.html.twig',[
            'colonnes' => $colonnes,
            'articles' => $articles
        ]);
    }
}
