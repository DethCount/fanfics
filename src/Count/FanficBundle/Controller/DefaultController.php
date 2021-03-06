<?php

namespace Count\FanficBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Count\FanficBundle\Document\Collection,
    Count\FanficBundle\Document\Book,
    Count\FanficBundle\Document\Metadata,
    Count\FanficBundle\Document\BlockRoot,
    Count\FanficBundle\Document\BlockChapter,
    Count\FanficBundle\Document\BlockTitle,
    Count\FanficBundle\Document\BlockText;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $books = $dm->getRepository('CountFanficBundle:Book')
            ->findAll();

        if (empty($books)) {
            throw $this->createNotFoundException(
                'No book exists on this site. Be the first to create one !'
            );
        }

        return $this->render(
            'CountFanficBundle:Default:index.html.twig',
            array(
                'books' => $books
            )
        );
    }
}
