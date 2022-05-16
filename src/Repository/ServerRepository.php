<?php

namespace App\Repository;

use App\Entity\Server;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\Statement;
use App\Infrastructure\dto\FilterDTO;

/**
 * @extends ServiceEntityRepository<Server>
 *
 * @method Server|null find($id, $lockMode = null, $lockVersion = null)
 * @method Server|null findOneBy(array $criteria, array $orderBy = null)
 * @method Server[]    findAll()
 * @method Server[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Server::class);
    }

//    /**
//     * @return Server[] Returns an array of Server objects
//     */

   public function findByFilter(FilterDTO $filtersDTO) 
   {    
        $storageMin = $filtersDTO->storageMin;
        $storageMax = $filtersDTO->storageMax;
        $ram = $filtersDTO->ram;
        $hddType = $filtersDTO->hddType;
        $location = $filtersDTO->location;

        $conn = $this->getEntityManager()->getConnection();
        $condition = ($storageMin && $storageMax) ? 
                        "CONCAT(disks_qty * disk_capacity, capacity_unity) BETWEEN '$storageMin' AND '$storageMax'" 
                        : "";
        $condition .= ($ram)      ? " AND memory_qty IN ($ram)"         : "";
        $condition .= ($hddType)  ? " AND disk_type LIKE '%$hddType%'"  : "";
        $condition  .= ($location) ? " AND location LIKE '%$location%'" : "";

        $findQuery = "SELECT * FROM server WHERE $condition";

        $data = $conn->fetchAllAssociative($findQuery);

        return $data;
   }
}
