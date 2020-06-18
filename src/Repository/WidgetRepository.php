<?php

namespace App\Repository;

use App\Entity\Widget;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Widget|null find($id, $lockMode = null, $lockVersion = null)
 * @method Widget|null findOneBy(array $criteria, array $orderBy = null)
 * @method Widget[]    findAll()
 * @method Widget[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WidgetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Widget::class);
    }

  
    public function resetPosition()
    {
        $qb = $this->createQueryBuilder('w');
        $q = $qb->update()
                ->set('w.position_left', $qb->expr()->literal(''))
                ->set('w.position_right', $qb->expr()->literal(''))
                ->getQuery();
        $p = $q->execute();

     

}
public function resetPositionByType(int $type)
{
    $qb = $this->createQueryBuilder('w');
    $q = $qb->update()
            ->set('w.position_left', $qb->expr()->literal(''))
            ->set('w.position_right', $qb->expr()->literal(''))
            ->andWhere('w.type = :type')
            ->setParameter('type', $type)
            ->getQuery();
    $p = $q->execute();

 

}
public function updateStatus(int $status,int $id)
{
    $qb = $this->createQueryBuilder('w');
    $q = $qb->update()
            ->set('w.visible', $status)
            ->andWhere('w.id = :id')
            ->setParameter('id', $id)
            ->getQuery();
    $p = $q->execute();

 

}
    /*
    public function findOneBySomeField($value): ?Widget
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
