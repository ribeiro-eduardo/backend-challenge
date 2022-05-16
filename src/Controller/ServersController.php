<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Entity\Server;
use App\Repository\ServerRepository;
use App\Infrastructure\dto\FilterDTO;


#[Route('/servers', name: 'server_')]
class ServersController extends AbstractController
{

    #[Route("/{serverId}", name: "show", methods: "GET")]
    public function show($serverId, ManagerRegistry $doctrine): Response {
        $server = $doctrine->getRepository(Server::class)->find($serverId);
        return $this->json([
            'data' => $server 
        ]);
    }

    #[Route("/", name: "find", methods: "GET")]
    public function find(Request $request, ManagerRegistry $doctrine, ServerRepository $serverRepo): Response {
        $storageMin = $request->query->get(key: 'storageMin') ?? false;
        $storageMax = $request->query->get(key: 'storageMax') ?? false;
        $ram = $request->query->get(key: 'ram') ?? false;
        $hddType = $request->query->get(key: 'hddType') ?? false;
        $location = $request->query->get(key: 'location') ?? false;

        $filtersDTO = new FilterDTO($storageMin, $storageMax, $ram, $hddType, $location);

        $servers = $doctrine->getRepository(Server::class)->findByFilter($filtersDTO);

        return $this->json([
            'data' => $servers 
        ]);
    }

    #[Route('/', name: "create", methods: "POST")]
    public function create(Request $request, ManagerRegistry $doctrine) {
        $data = $request->request->all();

        $entityManager = $doctrine->getManager();

        $server = new Server;
        $server->setModel($data['model']);
        $server->setRam($data['ram']);
        $server->setHdd($data['hdd']);
        $server->setLocation($data['location']);
        $server->setPrice($data['price']);

        $entityManager->persist($server);
        $entityManager->flush();
        return $this->json([
            'data' => 'Server created with success'
        ]);
    }

    #[Route("/{serverId}", name: "update", methods: ["PUT", "PATCH"])]
    public function update($serverId, Request $request, ManagerRegistry $doctrine) {
        $data = $request->request->all();

        $entityManager = $doctrine->getManager();

        $server = $doctrine->getRepository(Server::class)->find($serverId);
        $server->setModel($data['model']);
        $server->setRam($data['ram']);
        $server->setHdd($data['hdd']);
        $server->setLocation($data['location']);
        $server->setPrice($data['price']);

        $entityManager->flush();
        return $this->json([
            'data' => 'Server updated with success'
        ]);
    }

    #[Route("/{serverId}", name: "delete", methods: "DELETE"), ]
    public function delete($serverId, ManagerRegistry $doctrine) {
        $server = $doctrine->getRepository(Server::class)->find($serverId);
        $entityManager = $doctrine->getManager();

        $entityManager->remove($server);
        $entityManager->flush();

        return $this->json([
            'data' => 'Server deleted with success'
        ]);
    }

    /**
     * Method created to organize all the information about specific fields such as STORAGE, which was originally a bit hard to deal with.
     * I got to separate type of storage, number of disks and capacity of each one. All of this in order to ease the info handling.
     */
    // #[Route("/normalize", name: "normalize", methods: "PUT")]
    // public function normalize(ManagerRegistry $doctrine): Response
    // {
    //     $servers = $doctrine->getRepository(Server::class)->findAll();
    //     $entityManager = $doctrine->getManager();
        // foreach ($servers as $key => $server) {
            // $hdd = $server->getHdd();
            // $qty = strtok($hdd, 'x');
            // $disk = strtok('');

            // $capacity = strtok($disk, 'B');
            // $unity = substr($capacity, -1).'B';

            // $capacity = intval($capacity);

            // $tok = strtok($disk, $unity);
            // $diskType = strtok('');
            // $diskType = substr($diskType, 1);
            
            
            // $server->setDisksQty($qty);
            // $server->setDiskCapacity($capacity);
            // $server->setCapacityUnity($unity);
            // $server->setDiskType($diskType);  
            
            
            // $ram = $server->getRam();
            // $memoryQty = strtok($ram, 'G');
            // $tok = strtok($ram, 'B');
            // $memoryClass = strtok('');

            // $server->setMemoryQty($memoryQty);
            // $server->setMemoryClass($memoryClass);
        
            // $entityManager->persist($server);
            // $entityManager->flush();
        // }
    //     return $this->json([
    //         'data' => $servers 
    //     ]);
    // }
}
