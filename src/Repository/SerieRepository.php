<?php

namespace App\Repository;

use App\Entity\Serie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Serie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Serie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Serie[]    findAll()
 * @method Serie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SerieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Serie::class);
    }

    public function findBestSeries($page)
    {

        //En DQL
        /*
        $entityManager = $this->getEntityManager();
        $dql = "SELECT s 
                FROM App\Entity\Serie as s
                WHERE s.vote > 8 
                AND s.popularity > 100
                ORDER BY s.popularity DESC ";

        $query = $entityManager->createQuery($dql);
        */

        //Avec le query Builder

        $queryBuilder = $this->createQueryBuilder('s');
        $queryBuilder->addOrderBy('s.popularity','DESC');

        $query = $queryBuilder->getQuery();

        //Page 1 -> offset = 0
        //page 2 -> offset = 50
        //page 3 -> offset = 100


        $offset = ($page -1) * 50;
        //La meme chose pour les deux

        $query->setFirstResult($offset);

        $query->setMaxResults(50);
        return $query->getResult();
    }

}
