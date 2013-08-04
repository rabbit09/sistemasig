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
        if(1==2){
            throw $this->createNotFoundException('The product does not exist');
        }

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
                    'notice',
                    'La noticia fué actualizada'
                );
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
            'notice',
            'La noticia fue eliminada!'
        );

        return $this->redirect(
            $this->generateUrl(
                'sistema_sig_news_admin'
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