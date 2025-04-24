<?php

namespace App\Controller;

use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CommentAdminController extends AbstractController
{
    #[Route('/comment/admin', name: 'app_comment_admin')]
    public function index(EntityManagerInterface $em): Response
    {
        $comments = $em->getRepository(Comment::class)->findBy(
            [],
            ['commentDate' => 'DESC']
        );
        return $this->render('comment_admin/comment-admin.html.twig', [
            'comments' => $comments
        ]);
    }

    #[Route('/comment/admin/delete/{id}', name: 'app_comment_admin_delete')]
    public function delete(EntityManagerInterface $em, $id): Response
    {
        $comment = $em->getRepository(Comment::class)->find($id);

        if ($comment) {
            $em->remove($comment);
            $em->flush();
        }

        return $this->redirectToRoute('app_comment_admin');
    }

    #[Route('/comment/admin/spam/{id}', name: 'app_comment_admin_spam')]
    public function spam(EntityManagerInterface $em, $id): Response
    {
        $comment = $em->getRepository(Comment::class)->find($id);

        if ($comment) {
            $comment->setStatus(2);
            $em->flush();
        }

        return $this->redirectToRoute('app_comment_admin');
    }

    #[Route('/comment/admin/validate/{id}', name: 'app_comment_admin_validate')]
    public function validate(EntityManagerInterface $em, $id): Response
    {
        $comment = $em->getRepository(Comment::class)->find($id);

        if ($comment) {
            $comment->setStatus(1);
            $em->flush();
        }

        return $this->redirectToRoute('app_comment_admin');
    }
}
