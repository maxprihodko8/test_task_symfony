<?php
/**
 * Created by PhpStorm.
 * User: maxprihodko8
 * Date: 04.10.17
 * Time: 23:57
 */

namespace Tests\AppBundle\Controller\Api;


use Draw\Bundle\DrawTestHelperBundle\Helper\WebTestCaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommentControllerTest extends WebTestCase
{
    use WebTestCaseTrait;

    public function testCommentCount()
    {
        $this->requestHelper()
            ->get('/api/post-comments/2')
            ->jsonHelper()
            ->propertyHelper('')->assertCount(5)->end()
            ->executeAndJsonDecode();
    }
}