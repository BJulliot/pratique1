<?php


namespace App\Controller;


use App\Entity\Serie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{
    /**
     * @Route("/", name="main_home")
     */
    public function home()
    {
        return $this->render('main/home.html.twig');
    }

    /**
     * @Route("/test", name="main_test")
     */
    public function test(EntityManagerInterface $entityManager)
    {

        $serie = new Serie();

        $serie->setBackdrop('Ceci est un test')
            ->setDateCreated(new \DateTime())
            ->setFirstAirDate(new \DateTime("-1 year"))
            ->setGenre("Western")
            ->setLastAirDate(new \DateTime("-6 month"))
            ->setName("Lucky Lucke")
            ->setPopularity(100.8)
            ->setPoster("TEST A NOUVEAU")
            ->setStatus("Returning")
            ->setTmdbId(123456)
            ->setVote(9.8);

        //autre possibilite d'init entity manager, soit ça, soit le truc dans la function
        //$entityManager = $this->getDoctrine()->getManagers();

        dump($serie);

        $entityManager->persist($serie);
        $entityManager->flush();

        $serie->setName("Calamity Jane");
        $entityManager->persist($serie);
        $entityManager->flush();

        dump($serie);

        $entityManager->remove($serie);
        $entityManager->flush();


        return $this->render('main/test.html.twig', [

        ]);
    }
}