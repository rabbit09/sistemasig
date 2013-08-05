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
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository(NewItem::getEntityName());

        $news = $repository->findBy(
            array('status' => 1),
            array('id' => 'DESC'),
            100,
            1
        );
        $recentNew = $repository->findBy(
            array('status' => 1),
            array('id' => 'DESC'),
            1,
            0
        );

        return $this->render(
            'SistemaSigNewsBundle:Default:list_news.html.twig',
            array(
                'news' => $news,
                'recentNews' => $recentNew
            )
        );
    }

    /**
     * Form for create or update a new
     */
    public function createAction(Request $request)
    {
        $NewItem = new NewItem();
        $form = $this->createForm(new CreateEditNew(), $NewItem);
        $form->handleRequest($request);

        if ($request->getMethod() == 'POST') {
            if ($form->isValid()) {

                // Save the new
                $em = $this->getDoctrine()->getManager();
                $em->persist($NewItem);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'La noticia fue creada'
                );

                // Redirect to
                return $this->redirect(
                    $this->generateUrl(
                        'sistema_sig_news_admin'
                    )
                );
            } else {
                $this->get('session')->getFlashBag()->add(
                    'error',
                    'No se pudo crear la noticia'
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

    /**
     * Edit a new
     * @param Request $request
     * @param $newId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, $newId)
    {
        // Getting the new
        $em = $this->getDoctrine()->getManager();
        $NewItem = $em->getRepository(NewItem::getEntityName())->find($newId);

        $form = $this->createForm(new CreateEditNew(), $NewItem);
        $form->handleRequest($request);

        if ($request->getMethod() == 'POST') {
            if ($form->isValid()) {
                $em->persist($NewItem);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'La noticia fué actualizada'
                );
            } else {
                $this->get('session')->getFlashBag()->add(
                    'error',
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


    public function deleteAction($newId)
    {
        /*if (!$guest) {
            throw $this->createNotFoundException('No guest found');
        }*/

        // Getting the new
        $em = $this->getDoctrine()->getManager();
        $NewItem = $em->getRepository(NewItem::getEntityName())->find($newId);

        // Delete an obj
        $em->remove($NewItem);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'success',
            'La noticia fue eliminada!'
        );

        return $this->redirect(
            $this->generateUrl(
                'sistema_sig_news_admin'
            )
        );
    }

    public function viewAction($newId)
    {
        // Getting the new
        $em = $this->getDoctrine()->getManager();
        $NewItem = $em->getRepository(NewItem::getEntityName())->find($newId);

        return $this->render(
            'SistemaSigNewsBundle:Default:new_detail_view.html.twig',
            array(
                'new' => $NewItem
            )
        );
    }

    public function adminAction()
    {
        $repository = $this->getDoctrine()->getRepository(NewItem::getEntityName());
        $news = $repository->findBy(
            array(),
            array('id' => 'DESC')
        );

        return $this->render(
            'SistemaSigNewsBundle:Default:admin.html.twig',
            array(
                'news' => $news
            )
        );
    }
}