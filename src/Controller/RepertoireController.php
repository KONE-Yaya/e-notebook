<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
//use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Repertoire;
use App\Entity\Contact;

class RepertoireController extends AbstractController
{
    /**
     * @Route("/", name="listeRep")
     */
    public function listeRepAction(Request $request)
    {

        if( isset($_POST['btValider'])) // si formulaire soumis
        {
            $content_dir = '../public/images/'; // dossier où sera déplacé le fichier

            $tmp_file = $_FILES['logoRepertoire']['tmp_name'];

            if( !is_uploaded_file($tmp_file) )
            {
                exit("Le fichier est introuvable");
            }

            // on vérifie maintenant l'extension
            $type_file = $_FILES['logoRepertoire']['type'];

            if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') && !strstr($type_file, 'png'))
            {
                exit("Le fichier n'est pas une image");
            }

            // on copie le fichier dans le dossier de destination
            $name_file = $_FILES['logoRepertoire']['name'];

            if( !move_uploaded_file($tmp_file, $content_dir.$name_file) )
            {
                exit("Impossible de copier le fichier dans $content_dir");
            }

            //echo "Le fichier a bien été uploadé";

            $manager = $this->getDoctrine()->getManager();
            if($request->request->count() > 0)
            {
                $repertoire = new Repertoire();
                $repertoire->setNomRep($request->request->get('nomRepertoire'))
                           ->setLogoRep($name_file)
                           ->setInfoRep($request->request->get('infoRepertoire'));
                $manager->persist($repertoire);
                $manager->flush();
            }
        }
        $repo = $this->getDoctrine()->getRepository(Repertoire::class);
        $repertoires = $repo->findAllOrder();
        return $this->render('repertoire/listeRep.html.twig', ['repertoires' => $repertoires]);
    }

    /**
     * @Route("/ajoutRep", name="ajoutRep")
     */
    public function ajoutRepAction()
    {
        return $this->render('repertoire/ajoutRep.html.twig');
    }

    /**
     * @Route("/gestionRep", name="gestionRep")
     */
    public function gestionRepAction()
    {
        $repository = $this->getDoctrine()->getRepository(Repertoire::class);
        $repertoires = $repository->findAllOrder();
        return $this->render('repertoire/gestionRep.html.twig', ['repertoires' => $repertoires]);
    }

    /**
     * @Route("/modifRep/{id}", name="modifRep")
     */
    public function modifRepAction($id)
    {
        $manager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Repertoire::class);
        $repertoireModif  = $repository->find($id);
        return $this->render('repertoire/modifRep.html.twig', ['repertoire' => $repertoireModif]);
    }

     /**
     * @Route("/supRep/{id}", name="supRep")
     */
    public function supRepAction($id)
    {
        $manager = $this->getDoctrine()->getManager();

        $repositoryRep = $this->getDoctrine()->getRepository(Repertoire::class);
        $repositoryContact = $this->getDoctrine()->getRepository(Contact::class);

        $contacts = $repositoryContact->findBySameId($id);
        for( $i = 0; $i < count($contacts); $i++){
            $manager->remove($contacts[$i]);
            $manager->flush();
        }
        

        $repertoireSup  = $repositoryRep->find($id);
        $manager->remove($repertoireSup);
        $manager->flush();
        $repertoires = $repositoryRep->findAllOrder();

        return $this->redirectToRoute('gestionRep', ['repertoires' => $repertoires]);
    }

    /**
     * @Route("/updateRep/{id}", name="updateRep")
     */
    public function updateRepAction(Request $request, $id)
    {
        $manager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Repertoire::class);
       
        $repertoire = $repository->find($id);
        $repertoire->setNomRep($request->request->get('nomRepertoire'))
                    ->setInfoRep($request->request->get('infoRepertoire'));
        
        $manager->flush();
            
        $repertoires = $repository->findAllOrder();
        return $this->redirectToRoute('gestionRep', ['repertoires' => $repertoires]);
    }

}
