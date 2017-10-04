<?php
/**
 * Created by PhpStorm.
 * User: maxprihodko8
 * Date: 04.10.17
 * Time: 23:54
 */

namespace AppBundle\Controller\Api;


use AppBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations as FOS;


class CommentController extends Controller
{
    /**
     * @FOS\Get("/post-comments/{id}")
     *
     * @return \AppBundle\Entity\Comment[]
     */
    public function getAction(Post $post)
    {
        if (empty($post)) {
            throw new NotFoundHttpException('Post doesn\'t exists');
        }
        return $post->getComments();
    }
}