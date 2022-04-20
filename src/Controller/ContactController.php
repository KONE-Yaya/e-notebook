<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
//use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Repertoire;
use App\Entity\Contact;

class ContactController extends AbstractController
{
     /**
     * @Route("/listeContacts/{id}", name="listeContacts")
     */
    public function listeContactsAction($id, Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $repositoryRep = $this->getDoctrine()->getRepository(Repertoire::class);
        $repertoire  = $repositoryRep->find($id);
        if( isset($_POST['btCValider'])) // si formulaire soumis
        {
            $idEntier = (int)($id);
            if($request->request->count() > 0)
            {
                $contact = new Contact();
                $contact->setNomContact($request->request->get('nomContact'))
                        ->setPrenomContact($request->request->get('prenomContact'))
                        ->setTelContact($request->request->get('telContact'))
                        ->setEmailContact($request->request->get('emailContact'))
                        ->setInfoContact($request->request->get('infoContact'))
                        ->setIdRep($idEntier);
                $manager->persist($contact);
                $manager->flush();
            }
        }

        
        $repositoryContact = $this->getDoctrine()->getRepository(Contact::class);
        $contacts = $repositoryContact->findBySameIdOder($id);

        return $this->render('contact/listeContact.html.twig',['repertoire' => $repertoire, 
        'contacts' => $contacts ]);
    }

    /**
     * @Route("/gestionContact/{id}", name="gestionContact")
     */
    public function gestionContactAction($id)
    {
        $manager = $this->getDoctrine()->getManager();
        $repositoryRep = $this->getDoctrine()->getRepository(Repertoire::class);
        $repositoryContact = $this->getDoctrine()->getRepository(Contact::class);

        $repertoire  = $repositoryRep->find($id);
        $contacts = $repositoryContact->findBySameIdOder($id);

        return $this->render('contact/gestionContact.html.twig',['repertoire' => $repertoire, 
        'contacts' => $contacts ]);
    }

    /**
     * @Route("/ajoutContact/{id}", name="ajoutContact")
     */
    public function ajoutContactAction($id)
    {
        $manager = $this->getDoctrine()->getManager();
        $repositoryRep = $this->getDoctrine()->getRepository(Repertoire::class);
        //$repositoryContact = $this->getDoctrine()->getRepository(Contact::class);

        $repertoire  = $repositoryRep->find($id);
        //$contacts = $repositoryContact->findBySameId($id);

        //return $this->render('contact/gestionContact.html.twig',['repertoire' => $repertoire, 
        //'contacts' => $contacts ]);

        return $this->render('contact/ajoutContact.html.twig', ['repertoire' => $repertoire]);
    }

     /**
     * @Route("/modifContact/{idC}/{id}", name="modifContact")
     */
    public function modifContactAction($idC, $id)
    {
        $manager = $this->getDoctrine()->getManager();

        $repository = $this->getDoctrine()->getRepository(Contact::class);
        $repositoryRep = $this->getDoctrine()->getRepository(Repertoire::class);

        $contactModif  = $repository->find($idC);
        $repertoireM  = $repositoryRep->find($id);

        return $this->render('contact/modifContact.html.twig', ['id' => $id,'contact' => $contactModif, 'repertoire' => $repertoireM ]);
    }


    /**
     * @Route("/updateContact/{id}/{idRep}", name="updateContact")
     */
    public function updateContactAction(Request $request, $id, $idRep)
    {
        $manager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Contact::class);
        $repositoryRep = $this->getDoctrine()->getRepository(Repertoire::class);
       
        $contactM = $repository->find($id);
        $contactM->setNomContact($request->request->get('nomContact'))
                 ->setPrenomContact($request->request->get('prenomContact'))
                 ->setTelContact($request->request->get('telContact'))
                 ->setEmailContact($request->request->get('emailContact'))
                 ->setInfoContact($request->request->get('infoContact'));
        $manager->flush();
            
        return $this->redirectToRoute('gestionContact', ['id' => $idRep]);
    }


    /**
     * @Route("/supContact/{id}/{idRep}", name="supContact")
     */
    public function supContactAction($id, $idRep)
    {
        $manager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Contact::class);
        $contactSup  = $repository->find($id);
        $manager->remove($contactSup);
        $manager->flush();
        $contacts = $repository->findAll();

        return $this->redirectToRoute('gestionContact', ['id' => $idRep, 'contacts' => $contacts]);
    }


}
