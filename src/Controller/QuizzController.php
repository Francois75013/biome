<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use App\Repository\QuizRepository;
use App\Repository\QuestionsRepository;
use App\Repository\ReponsesRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class QuizzController extends AbstractController
{
    /**
     * @Route("/themes", name="themes")
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

        return $this->render('quizz/themes.html.twig', [
            'themes' => $tabTheme
        ]);
    }

    /**
     * @Route("/quizzlist", name="listquiz")
     */
    public function quizlist(HttpFoundationRequest $request, QuizRepository $quizRepository): Response
    {

        $tabIllu = array('A', 'B', 'C', 'D','E');
       

        $quizList = $quizRepository->findBy(array('theme' => $request->query->get('themequiz')));

        return $this->render('quizz/quizList.html.twig', [
            'quizlist' => $quizList,
            'tabIllu' => $tabIllu
        ]);
    }



    
     
    /** 
     * @Route("/presentationQuiz/{id}", name="presentationQuiz")
     */
    public function presentationQuiz($id, QuizRepository $quizRepository, Session $session): Response
    {


        /* $repo = $this->getDoctrine()->getRepository(QuestionsRepository::class); */
        $quiz = $quizRepository->findOneById($id);
       /*   return new JsonResponse($questions);  */

       $session->set("quizId", $quiz->getId());
       $session->set("tour", 0); // session initialisé à 0 
       $session->set("score", 0); // score initialisé à 0 
       $session->set("questionPassed", ''); // pour ne pas repéter les questions
   
     
        return $this->render('quizz/presentationquiz.html.twig', ['quiz' => $quiz
        ]);

     }

     /** 
     * @Route("/startQuiz/{id}", name="startQuiz")
     */
    public function startQuiz($id, QuestionsRepository $questionRepository
    ,  ReponsesRepository $reponsesRepository, Session $session, Request $request): Response
    {

        if(!empty($request->request)){

            if($request->request->get('selectReponse') == 1){
                $session->get('score', $session->get('score') + 15);
            }

        }

        

        $tour = $session->get('tour');
        $tour = $tour + 1;
        $session->set('tour', $tour);
        
        if($tour > 10){



            return $this->redirectToRoute('finQuiz');
        }

        $tabQuestionPased = explode(',', $session->get('questionPassed'));

        $question = null;

        $questions = $questionRepository->findBy(array('quiz' => $id));

        foreach($questions as $rowQuestion){
            if(!in_array($rowQuestion->getId(), $tabQuestionPased)){
                $question = $rowQuestion;

                $newStringTabPassed = $session->get('questionPassed') . ',' . $rowQuestion->getId();
                $session->set('questionPassed', $newStringTabPassed);

                break;
            }
        };
     
        return $this->render('quizz/startQuiz.html.twig', ['question' => $question,
        'tour'=> $tour]);

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
 /**
     * @Route("/finQuiz", name="finQuiz")
     */
    public function finQuiz(QuizRepository $quizRepository): Response
    {

        

        return $this->render('quizz/finQuiz.html.twig', [
            
        ]);
    }



 
}




/* $user = $this->getUser();
$score = $user->getScore();

$score = $score + $nouvelleValeurdequizz;
$$user->setScore($score);  */