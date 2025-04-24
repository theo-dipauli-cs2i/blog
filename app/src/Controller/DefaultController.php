<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DefaultController extends AbstractController
{
    #[Route('/', name: 'app')]
    public function index(EntityManagerInterface $em): Response
    {
        $posts = $em->getRepository(Post::class)->findBy(
            ['status' => 1],
            ['id' => 'ASC']
        );
        return $this->render('default/index.html.twig', [
            'posts' => $posts
        ]);
    }

    #[Route('/post-detail/{id}', name: 'app_post_detail')]
    public function postDetail(EntityManagerInterface $em,$id): Response
    {
        $post = $em->getRepository(Post::class)->find($id);
        $comments = $em->getRepository(Comment::class)->findBy(
            ['post' => $post, 'status' => 1],
            ['id' => 'DESC']
        );

        return $this->render('default/post-detail.html.twig', [
            'post' => $post,
            'comments' => $comments

        ]);
    }

    #[Route('/apropos', name: 'app_apropos')]
    public function apropos(): Response
    {
        return $this->render('default/apropos.html.twig', [
        ]);
    }
}
