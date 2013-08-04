<?php
/**
 * Created by JetBrains PhpStorm.
 * User: darvein
 * Date: 8/3/13
 * Time: 18:02
 * To change this template use File | Settings | File Templates.
 */

namespace SistemaSig\NewsBundle\Controller;

use SistemaSig\NewsBundle\Entity\NewItem;
use SistemaSig\NewsBundle\Form\CreateEditNew;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NewsController extends Controller
{
    /**
     * List of news for visitors
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository(NewItem::getEntityName());
        $news = $repository->findBy(
            array('status' => 1),
            array('id' => 'DESC')
        );

        return $this->render(
            'SistemaSigNewsBundle:Default:list_news.html.twig',
            array(
                'news' => $news
            )
        );
    }

    /**
     * Form for create or update a new
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(new CreateEditNew());
        $form->handleRequest($request);

        if ($request->getMethod() == 'POST') {
            if ($form->isValid()) {
                $data = $form->getData();

                // Creating the object
                $NewItem = new NewItem();
                $NewItem->setTitle($data['title']);
                $NewItem->setBody($data['body']);
                $NewItem->setSummary($data['summary']);
                $NewItem->setCity($data['city']);
                $NewItem->setStatus($data['status']);
                $NewItem->setCreatedDate(new \DateTime());
                $NewItem->setUpdatedDate(new \DateTime());
                $NewItem->setPublishedDate(new \DateTime());

                $em = $this->getDoctrine()->getManager();
                $em->persist($NewItem);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Your changes were saved! '
                );

                // Redirect to
                /*return $this->redirect(
                    $this->generateUrl(
                        'sistema_sig_news_homepage',
                        array('name' => 'nombre')
                    )
                );*/
            } else {
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'No va a dar!'
                );
            }
        }

        return $this->render(
            'SistemaSigNewsBundle:Forms:create_article.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    public function editAction(Request $request)
    {
        $NewItem = new NewItem();
        $form = $this->createForm(new CreateEditNew(), $NewItem);
        $form->handleRequest($request);
    }
}