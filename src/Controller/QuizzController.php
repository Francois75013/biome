<?php

namespace App\Controller;

use App\Repository\QuizRepository;
use App\Repository\QuestionsRepository;

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
     * @Route("/startQuiz", name="startQuiz")
     * @return Response
     */
    public function index2()
    {
        $repo = $this->getDoctrine()->getRepository(Questions::class);
        $questions = $repo->findAll();

        return $this->render('startQuiz.html.twig', ['questions' => $questions]);
    }
}



/* 
$user = $this->getUser();
$score = $user->getScore();

$score = $score + $nouvelleValeurdequizz;
$$user->setScore($score); */