<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SerieController extends AbstractController
{
    /**
     * @Route("/series/{page}", name="serie_list", requirements={"page"="\d+"})
     */
    public function list(int $page = 1, SerieRepository $serieRepository, EntityManagerInterface $entityManager): Response
    {
        //TODO recuperer la liste de mes séries

        dump($page);
        //Recuperer le repository de Série (Pas besoin du $entityManager pour la premiere methode)
        //$serieRepository = $this->getDoctrine()->getRepository(Serie::class);
        //$serieRepository = $entityManager->getRepository(Serie::class);

        //$series = $serieRepository->findAll();

        //$series = $serieRepository->findBy([],["vote" => "DESC"], 50);

        $nbSeries = $serieRepository->count([]);
        $maxPage = ceil($nbSeries / 50);

        if($page >= 1 && $page <= $maxPage){
            $series = $serieRepository->findBestSeries($page);

        }else{
            throw $this->createNotFoundException('Oops this page does not exist');
        }

        return $this->render('serie/list.html.twig', [

            "series" => $series,
            "currentPage" => $page,
            "maxPage" => $maxPage,
        ]);
    }

    /**
     * @Route("/series/detail/{id}", name="serie_detail")
     */
    public function detail($id, SerieRepository $serieRepository): Response
    {
        //TODO recupere la serie en fonction de son id

        $serie = $serieRepository->find($id);

        if (!$serie) {
            throw $this->createNotFoundException('Oops ! This serie does not exist !');
            //return $this->redirectToRoute('main_home');
            //pour une redirection plutot qu'un message d'erreur
        }

        return $this->render('serie/detail.html.twig', [
            "serie" => $serie
        ]);
    }

    /**
     * @Route("/series/create", name="serie_create")
     */
    public function create(): Response
    {
        //TODO Générer un formulaire pour ajouter ma nouvelle serie
        return $this->render('serie/create.html.twig', [

        ]);
    }
}
