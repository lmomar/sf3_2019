<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Client;
use AppBundle\Form\ClientType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends Controller
{

    /**
     * @Route(path="/clients",name="clients_list")
     */
    public function indexAction()
    {
        $ser = $this->container->get('app_get_avatar');
        $ser->getAvatar('xgsdfgsdf');
        $repo = $this->getDoctrine()->getRepository(Client::class);
        $list = $repo->findLIstClients();
        return $this->render('AppBundle::Client/list.html.twig', array('clients' => $list));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route(path="/clients/add",name="clients_add")
     */
    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($client);
            $em->flush();
            $this->addFlash('success', "Client added succefuly");
            return $this->redirect($this->generateUrl('clients_list'));
        }
        return $this->render('AppBundle::Client/add.html.twig', array('form' => $form->createView()));
    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route(path="/clients/edit/{id}",requirements={"id"="\d+"},name="clients_edit")
     */
    public function editAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Client::class);
        $client = $repo->find($request->get('id'));
        if (is_object($client)) {
            $form = $this->createForm(ClientType::class, $client);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em->flush();
                $this->addFlash('success', "Client updated succefuly.");
                return $this->redirect($this->generateUrl('clients_list'));
            }
            return $this->render('AppBundle::Client/edit.html.twig', array(
                    'form' => $form->createView(),
                    'client' => $client)
            );
        } else {
            $this->addFlash('error', "Client not found: " . $request->get('id'));
            return $this->render('AppBundle::Client/list.html.twig');
        }

    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route(path="/clients/delete/{id}",name="clients_delete",requirements={"id"="\d+"},methods={"DELETE","GET"})
     */
    public function deleteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Client::class);
        $client = $repo->find($request->get('id'));
        if (is_object($client)) {
            $form = $this->generateDeleteForm($client);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em->remove($client);
                $em->flush();
                $this->addFlash('success', "Client removed succefuly.");
                return $this->redirect($this->generateUrl("clients_list"));
            } else {
                return $this->render('AppBundle::Client/delete.html.twig', array(
                        'form' => $form->createView(),
                        'client' => $client
                    )
                );
            }
        } else {
            $this->addFlash('error', "Client not found: " . $request->get('id'));
            return $this->redirect($this->generateUrl('clients_list'));
        }
    }

    private function generateDeleteForm(Client $client)
    {
        return $this->createFormBuilder($client)
            ->add('confirm', SubmitType::class, array('attr' => array('class' => 'btn btn-danger')))
            ->setAction($this->generateUrl('clients_delete', array('id' => $client->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }


}