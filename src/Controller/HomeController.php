<?php

namespace App\Controller;

use App\Entity\Dumpling;
use App\Repository\DumplingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/dumplings', name: 'app_home')]
    public function index(DumplingRepository $dumplingRepository): Response
    {
        $dumplings =$dumplingRepository->findAll();
        dump($dumplings);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'dumplings' => $dumplings,
        ]);
    }

    #[Route('/dumpling/show/{id}', name: 'show_dumpling')]
    public function show(Dumpling $dumpling): Response
    {
        if (!$dumpling) {
            return $this->redirectToRoute('app_home');
        }
        return $this->render('home/show.html.twig', [
            'dumpling' => $dumpling,
        ]);
    }

    #[Route('/dumpling/delete/{id}', name: 'delete_dumpling')]
    public function delete( EntityManagerInterface $manager, Dumpling $dumpling): Response
    {
        if(!$dumpling)
        {
            return $this->redirectToRoute('app_home');
        }
        $manager->remove($dumpling);
        $manager->flush();
        return $this->redirectToRoute('app_home');
    }

    #[Route('/dumpling/create', name: 'create_dumpling')]
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        //echo "test",
        //die();
        $name = $request->get('name');
        $filing = $request->get('filing');

        if ($name && $filing) {
            $dumpling = new Dumpling();
            $dumpling->setName($name);
            $dumpling->setFiling($filing);
            $manager->persist($dumpling);
            $manager->flush();
        }
        return $this->redirectToRoute('app_home');
    }

}
