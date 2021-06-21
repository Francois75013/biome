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

        foreach($quiz as $rowQuiz){
            if(!in_array($rowQuiz->getTheme(), $tabTheme)){
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
    public function quizlist(HttpFoundationRequest $request, QuizRepository $quizRepository) : Response{
        

        $quizList = $quizRepository->findBy(array('theme' => $request->query->get('themequiz')));

        return $this->render('quizz/quizList.html.twig', [
            'quizlist' => $quizList
        ]);
        
    }  


    /**
     * @Route("/presentationquiz", name="presentationquiz")
     */
    public function index2(QuestionsRepository $QuestionsRepository): Response
    {
        
        $question = $QuestionsRepository->findAll();

        $tabQuestion = array();

        foreach($question as $rowQuestion){
            if(!in_array($rowQuestion->getQuestion(), $tabQuestion)){
                array_push($tabQuestion, $rowQuestion->getQuestion());
            }
        }

        return $this->render('quizz/presentationquiz.html.twig', [
            'question' => $tabQuestion
        ]);
    } 
     /**
     * @Route("/presentationquiz", name="presentationquiz")
     */
    public function question(HttpFoundationRequest $request, QuestionsRepository $QuestionsRepository) : Response{
        

        $tabQuestion = $QuestionsRepository->findBy(array('question' => $request->query->get('questionQuiz')));

        return $this->render('quizz/presentationquiz.html.twig', [
            'questions' => $tabQuestion
        ]);
        
    }  

   
}



/* 
$user = $this->getUser();
$score = $user->getScore();

$score = $score + $nouvelleValeurdequizz;
$$user->setScore($score); */