<?php

namespace App\Repository;

use App\Entity\AvatarPart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AvatarPart>
 *
 * @method AvatarPart|null find($id, $lockMode = null, $lockVersion = null)
 * @method AvatarPart|null findOneBy(array $criteria, array $orderBy = null)
 * @method AvatarPart[]    findAll()
 * @method AvatarPart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvatarPartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AvatarPart::class);
    }

    public function save(AvatarPart $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AvatarPart $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return AvatarPart[] Returns an array of AvatarPart objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }
      public function findLike($value): array
      {
          $queryBuilder = $this->createQueryBuilder("AvatarPart");
          $queryBuilder->where(' AvatarPart.name like :v');
          $queryBuilder->setParameter(':v', $value . '%');
          return $queryBuilder->getQuery()->getResult();
      }

//    public function findOneBySomeField($value): ?AvatarPart
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
