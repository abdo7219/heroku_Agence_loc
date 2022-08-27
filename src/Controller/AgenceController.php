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
public function home():Response
{
    return $this->render('agence/home.html.twig', [
'presentation' => 'Agence location voiture',
'adresse' => '15 rue leblanc marseil 13000',
'Telephone' => '(+33)0786595254',
'email' => 'agenceloc.dim@agence.com'
    ]);
}



    // public function home(VehiculeRepository $repo): Respons
    // {
    //     $vehicules = $repo->findAll();
    //     return $this->render('agence/home.html.twig', [
    //         'tabvehicules' => $vehicules

    //     ]);


    // }





    #[Route('/agence/show/{id}', name: 'agence_show')]

    public function show($id, VehiculeRepository $repo): Response

    {
        $vehicule = $repo->find($id);

        return $this->render('agence/show.html.twig', [
            'vehicule' => $vehicule
        ]);
    }


   
}
