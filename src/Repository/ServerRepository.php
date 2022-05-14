<?php

namespace App\Repository;

use App\Entity\Server;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\Statement;

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

    public function add(Server $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Server $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Server[] Returns an array of Server objects
//     */
   public function findByFilter($storageMin = false, 
                                $storageMax = false,
                                $ram = false,
                                $hddType = false,
                                $location = false): array {
       
        $conn = $this->getEntityManager()->getConnection();
        $condition = ($storageMin && $storageMax) ? 
                        "CONCAT(disks_qty * disk_capacity, capacity_unity) BETWEEN '$storageMin' AND '$storageMax'" 
                        : "";
        $condition .= ($ram)      ? " AND memory_qty IN ($ram)"         : "";
        $condition .= ($hddType)  ? " AND disk_type LIKE '%$hddType%'"  : "";
        $condition  .= ($location) ? " AND location LIKE '%$location%'" : "";


        $findQuery = "SELECT * FROM server WHERE $condition";

        // dump($findQuery);

        $data = $conn->fetchAllAssociative($findQuery);

        return $data;
   }

//    public function findOneBySomeField($value): ?Server
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
