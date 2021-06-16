<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizzController extends AbstractController
{
    /**
     * @Route("/quizz", name="quizz")
     */
    public function index(): Response
    {
        return $this->render('quizz/index.html.twig', [
            'controller_name' => 'QuizzController',
        ]);
    }
  /*   public function question() : Response{
        $entity = $this->getDoctrine();

        $question = $entity->getRepository(EntityQuestions::class)->find();
        $reponse = $entity->getRepository(EntityReponses::class)->findOneById(6);
       
        return $this->render('quiz.html.twig', ['quiz'=> $reponse]);
    } */
}
