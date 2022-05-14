<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Location;

#[Route('/location', name: 'location_')]
class LocationController extends AbstractController
{
    #[Route('/', name: 'index', methods: "GET")]
    public function index(ManagerRegistry $doctrine): Response
    {
        $locations = $doctrine->getRepository(Location::class)->findAll();
        return $this->json([
            'data' => $locations 
        ]);
    }
}
