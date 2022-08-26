<?php

namespace App\Controller;


use app\Entity\Vehicule;
use app\Entity\User;
use App\Form\VehiculeType;
use App\Repository\VehiculeRepository;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AgenceController extends AbstractController
{
    #[Route('/agence', name: 'app_agence')]
    public function index(VehiculeRepository $repo): Response
    {
        $vehicules = $repo->findAll();
        return $this->render('agence/index.html.twig', [
            'tabvehicules' => $vehicules,
        ]);
    }


    #[Route('/', name: 'home')]
    public function home(VehiculeRepository $repo): Response
    { $vehicules = $repo->findAll();
        return $this->render('agence/home.html.twig', [
            'tabvehicules' => $vehicules
            
        ]);
    }

   #[Route('/agence/show/{id}', name: 'agence_show')]
   
   public function show($id, VehiculeRepository $repo, Request $superglobals, EntityManagerInterface $manager): Response

{
$vehicule = $repo->find($id);

return $this->render('agence/show.html.twig',[
    'vehicule' => $vehicule]);
}


#[Route('/agence/new', name: 'vehicule_create')]
#[Route('/agence/edit/{id}', name: 'vehicule_edit')]
public function form(Request $superglobals, EntityManagerInterface $manager, Vehicule $vehicule = null)
{
if($vehicule == null){

    $vehicule = new Vehicule;
    //$vehicule->setCreatedAt(new \Datetime());

}
$form = $this->createForm(VehiculeType::class, $vehicule);

$form->handleRequest($superglobals);

dump($vehicule);


if($form->isSubmitted() && $form->isValid())
{
    $manager->persist($vehicule);
    $manager->flush();
    return $this->redirectToRoute('agence_show', [
        'id' => $vehicule->getId()
    ]);
}

}






}



