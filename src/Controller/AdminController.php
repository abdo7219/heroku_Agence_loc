<?php

namespace App\Controller;
use App\Entity\User;
use App\Form\UserType;
use App\Entity\Commande;
use App\Entity\Vehicule;
use App\Form\CommandeType;
use App\Form\VehiculeType;
use App\Repository\UserRepository;
use App\Repository\CommandeRepository;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
        // , [
        //     'controller_name' => 'AdminController',
        // ]);
    }

        #[Route('admin/vehicules', name:'admin_vehicules')]
        
        
            public function adminVehicules(VehiculeRepository $repo, EntityManagerInterface $manager)
        {
            $champs = $manager->getclassMetadata(Vehicule::class)->getFieldNames();
       
            $vehicules = $repo->findAll();

        return $this-> render("admin/admin_vehicules.html.twig",
        [
            'vehicules' => $vehicules,
            'champs' => $champs
        ]);
        }
    #[Route('/admin/vehicule/new', name:'admin_new_vehicule')]
    #[Route('/admin/vehicule/edit/{id}', name:'admin_edit_vehicule')]
    public function vehicule_form(Vehicule $vehicule = null, Request $superglobals, EntityManagerInterface $manager)

  {
if($vehicule == null){
    $vehicule = new Vehicule;
   // $vehicule->setCreatedAt(new \DateTime());
}
$form = $this->createform(VehiculeType::class, $vehicule);
$form->handleRequest($superglobals);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($vehicule);
            $manager->flush();
            return $this->redirectToRoute('admin_vehicules');
        }
        return $this->renderForm("admin/vehicule_form.html.twig", [
            'formVehicule' => $form,
            'editMode' => $vehicule->getId() !== NULL
        ]);
  }  
  #[Route('/admin/vehicule/delete/{id}', name:'admin_delete_vehicule')]

  public function vehicule_delete(EntityManagerInterface $manager, VehiculeRepository $repo, $id)
  {
      $vehicule = $repo->find($id);
  
  $manager->remove($vehicule);
  
  
  $manager->flush();
  
  
  $this->addFlash('success', "le vehicule a bien été supprimé !");
  
  
  return $this->redirectToRoute(("admin_vehicules"));
  }
  
#"########################################################################################################################

#[Route('admin/membres', name:'admin_membres')]
        
        
public function adminMembre(UserRepository $repo, EntityManagerInterface $manager)
{
    $champs = $manager->getclassMetadata(User::class)->getFieldNames();

$membres = $repo->findAll();

return $this-> render("admin/admin_membres.html.twig",
[
'membres' => $membres,
'champs' => $champs
]);
}
#[Route('/admin/membre/new', name:'admin_new_membre')]
#[Route('/admin/membre/edit/{id}', name:'admin_edit_membre')]
public function membre_form(User $membre = null, Request $superglobals, EntityManagerInterface $manager)

{
if($membre == null){
$membre = new User;
// $vehicule->setCreatedAt(new \DateTime());
}
$form = $this->createform(UserType::class, $membre);
$form->handleRequest($superglobals);
if($form->isSubmitted() && $form->isValid())
{
$manager->persist($membre);
$manager->flush();
return $this->redirectToRoute('admin_membres');
}
return $this->renderForm("admin/membres_form.html.twig", [
'formMembre' => $form,
'editMode' => $membre->getId() !== NULL
]);
}  
#[Route('/admin/membre/delete/{id}', name:'admin_delete_membre')]

public function membre_delete(EntityManagerInterface $manager, UserRepository $repo, $id)
{
$membre = $repo->find($id);

$manager->remove($membre);


$manager->flush();


$this->addFlash('success', "le membre a bien été supprimé !");


return $this->redirectToRoute(("admin_membres"));
}

// #########################################################################"""



#[Route('admin/commandes', name:'admin_commandes')]
        
        
public function adminCommandes(CommandeRepository $repo, EntityManagerInterface $manager)
{
$champs = $manager->getclassMetadata(Commande::class)->getFieldNames();

$commandes = $repo->findAll();

return $this-> render("admin/admin_commandes.html.twig",
[
'commandes' => $commandes,
'champs' => $champs
]);
}
#[Route('/admine/commande/new', name:'admin_new_commande')]
#[Route('/admin/commande/edit/{id}', name:'admin_edit_commande')]
public function commande_form(Commande $commande = null, Request $superglobals, EntityManagerInterface $manager)

{
if($commande == null){
$commande = new Commande;
// $vehicule->setCreatedAt(new \DateTime());
}
$form = $this->createform(CommandeType::class, $commande);
$form->handleRequest($superglobals);
if($form->isSubmitted() && $form->isValid())
{
$manager->persist($commande);
$manager->flush();
return $this->redirectToRoute('admin_commandes');
}
return $this->renderForm("admin/commande_form.html.twig", [
'formCommande' => $form,
'editMode' => $commande->getId() !== NULL
]);
}  
#[Route('/admin/commande/delete/{id}', name:'admin_delete_commande')]

public function commande_delete(EntityManagerInterface $manager, CommandeRepository $repo, $id)
{
$commande = $repo->find($id);

$manager->remove($commande);


$manager->flush();


$this->addFlash('success', "la commande a bien été suprimé !");


return $this->redirectToRoute(("admin_commandes"));
}


}

