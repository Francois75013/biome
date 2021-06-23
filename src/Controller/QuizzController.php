<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use App\Repository\QuizRepository;
use App\Repository\QuestionsRepository;
use App\Repository\ReponsesRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizzController extends AbstractController
{
    /**
     * @Route("/quizz", name="quizz")
     */
    public function index(QuizRepository $quizRepository): Response
    {

        $quiz = $quizRepository->findAll();

        $tabTheme = array();

        foreach ($quiz as $rowQuiz) {
            if (!in_array($rowQuiz->getTheme(), $tabTheme)) {
                array_push($tabTheme, $rowQuiz->getTheme());
            }
        }

        return $this->render('quizz/index.html.twig', [
            'themes' => $tabTheme
        ]);
    }

    /**
     * @Route("/quizzlist", name="listquiz")
     */
    public function quizlist(HttpFoundationRequest $request, QuizRepository $quizRepository): Response
    {


        $quizList = $quizRepository->findBy(array('theme' => $request->query->get('themequiz')));

        return $this->render('quizz/quizList.html.twig', [
            'quizlist' => $quizList
        ]);
    }



    /** 
     * @Route("/presentationquiz/{id}", name="presentationquiz")
     */
    public function presentationquiz($id, QuestionsRepository $questionRepository
    ,  ReponsesRepository $reponsesRepository): Response
    {

        /* $repo = $this->getDoctrine()->getRepository(QuestionsRepository::class); */
        $questions = $questionRepository->findAllResult($id);
       /*   return new JsonResponse($questions);  */
        /* $tabQuest = array(); */
/*
        foreach($questions as $rowQuestion)
        if(!in_array($rowQuestion->getQuestion(),$tabQuest)){
            array_push($tabQuest,$rowQuestion->getQuestion());
        }

        $reponses = $reponsesRepository->findAll();
        $tabRep = array();

        foreach($reponses as $rowReponse)
        if(!in_array($rowReponse->getReponse(),$tabRep)){
            array_push($tabRep,$rowReponse->getReponse());
        }
         */
        return $this->render('quizz/startQuiz.html.twig', ['questions' => $questions,
        'reponses' => []]);

        



    }

    /**
     * @Route("/api/question/theme/search/{query}", methods={"GET"})
     */
    public function search($query, QuizRepository $quizRepository, LoggerInterface $logger)
    {

        //$this->denyAccessUnlessGranted("ROLE_USER");

        $listQuiz = $quizRepository->findAllarray($query);
        $logger->info($query);

        return new JsonResponse($listQuiz);
 


}



 
}



/* 
$user = $this->getUser();
$score = $user->getScore();

$score = $score + $nouvelleValeurdequizz;
$$user->setScore($score); */