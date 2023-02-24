<?php

namespace App\Controller;
use App\Entity\Workshop;
use App\Form\WorkshopFormType;
use App\Repository\WorkshopRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WorkshopsController extends AbstractController
{

    private $entitymanager;
    private $workshopRepository;

    // Constructor for Repository && EntityManagerInterface
    public function __construct(WorkshopRepository $workshopRepository, EntityManagerInterface $entitymanager)
    {
        $this->workshopRepository = $workshopRepository;
        $this->entitymanager = $entitymanager;
    }

    // Get index:
    #[Route('/workshops', methods:['GET'], name: 'workshops')]
    public function index(): Response
    {   
        $workshops = $this->workshopRepository->findAll();
        return $this->render('workshops/index.html.twig', [
            'workshops' => $workshops
        ]);
    }

    // Get detail by id:
    #[Route('/workshops/{id}', methods:['GET'], name: 'workshop_detail')]
    public function detail($id): Response
    {   
        $workshop = $this->workshopRepository->find($id);
        return $this->render('workshops/detail.html.twig', [
            'workshop' => $workshop
        ]);
    }

    // Create and go to form:
    #[Route('/workshops/create', name: 'workshop_create')]
    public function create(Request $request): Response
    {   
        $workshop = new Workshop();
        $form = $this->createForm(WorkshopFormType::class, $workshop);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $newWorkshop = $form->getData();
            $imagePath = $form->get('imagePath')->getData();

            if($imagePath){
                $newFileName = uniqid() ."." . $imagePath->guessException();
                try {
                    $imagePath->move(
                        $this->getParameter('kernel.project_dir'), '/public/uploads', $newFileName
                    );
                } catch (FileException $error) {
                    return new Response($error->getMessage());
                }

                $newWorkshop->setImagePath('/uploads/' . $newFileName);
            }

            $this->entitymanager->persist($newWorkshop);
            $this->entitymanager->flush();

            return $this->redirectToRoute('workshops');
            
        }

        return $this->render('workshops/create.html.twig', [
            'form'=> $form->createView()
        ]);
    }

    // Edit item form:
        #[Route('/workshops/edit/{id}', name: 'workshop_edit')]
        public function edit($id, Request $request): Response
        {   
            $workshop = $this->workshopRepository->find($id);
            $form = $this->createForm(WorkshopFormType::class, $workshop);

            $form->handleRequest($request);
            $imagePath = $form->get('imagePath')->getData();
            if($form->isSubmitted() && $form->isValid()){
                if($imagePath){
                    if($workshop->getImagePath()!==null){
                        if(file_exists(
                            $this->getParameter('kernel.project_dir') .$workshop->getImagePath()
                            )){
                                $this->getParameter('kernel.project_dir') . $workshop->getImagePath();

                                $newFileName = uniqid() ."." . $imagePath->guessException();
                                try {
                                    $imagePath->move(
                                        $this->getParameter('kernel.project_dir'), '/public/uploads', $newFileName
                                    );
                                } catch (FileException $error) {
                                    return new Response($error->getMessage());
                                }

                                $workshop->setImagePath('/uploads' . $newFileName);
                                $this->entitymanager->flush();

                                return  $this->redirectToRoute('workshops');
                
                            }
                    }
                }else{
                   $workshop->setTitle($form->get('title')->getData());
                   $workshop->setStartDate($form->get('startDate')->getData());
                   $workshop->setDescription($form->get('description')->getData());

                   $this->entitymanager->flush();
                   return $this->redirectToRoute('workshops');
                }
            }

            return $this->render('workshops/edit.html.twig', [
                'workshop'=> $workshop,
                'form' => $form->createView()
            ]);
        }

     // Delete item:
        #[Route('/workshops/delete/{id}', methods: ['GET', 'DELETE'], name: 'workshop_delete')]
        public function delete($id): Response
        { 
            $workshop = $this->workshopRepository->find($id);
            $this->entitymanager->remove($workshop);
            $this->entitymanager->flush();

            return $this->redirectToRoute('workshops');
        } 
}

//dd($workshops);