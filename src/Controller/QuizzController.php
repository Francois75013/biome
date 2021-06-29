<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use App\Repository\QuizRepository;
use App\Repository\QuestionsRepository;
use App\Repository\ReponsesRepository;
use App\Repository\UserRepository;
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
    public function presentationQuiz($id, QuizRepository $quizRepository, Session $session, ReponsesRepository $reponsesRepository): Response
    {


        /* $repo = $this->getDoctrine()->getRepository(QuestionsRepository::class); */
        $quiz = $quizRepository->findOneById($id);
         /* return new JsonResponse($reponseIsTrue); */ 

       $session->set("quizId", $quiz->getId());
       $session->set("tour", 0); // session initialisé à 0 
       $session->set("passage", 1); //
       $session->set("score", 0); // score initialisé à 0 
       $session->set("questionPassed", ''); // pour ne pas repéter les questions
       $session->set("description", "");
    
     
        return $this->render('quizz/presentationquiz.html.twig', ['quiz' => $quiz
        ]);

     }

     /** 
     * @Route("/startQuiz/{id}", name="startQuiz")
     */
    public function startQuiz($id, QuestionsRepository $questionRepository
    , Session $session, Request $request): Response
    {
        $passage = $session->get('passage');
        $tour = $session->get('tour');
        $reponseIsTrue = false;
        $nouveauScore = 0;
       
        $question = null;
        $description = "";

        if($passage == 0){
            $passage = 1;
            $session->set('passage', $passage);
            $description = $session->get('description');
            
            
        }else{
            $tour = $tour + 1;
            $session->set('tour', $tour);

            $passage = 0;
            $session->set('passage', $passage);

            $tabQuestionPased = explode(',', $session->get('questionPassed'));

            $questions = $questionRepository->findBy(array('quiz' => $id));

            foreach($questions as $rowQuestion){
                if(!in_array($rowQuestion->getId(), $tabQuestionPased)){
                    $question = $rowQuestion;

                    $description = $rowQuestion->getDescription($rowQuestion->getId());
                    $session->set('description', $description);
                    
                    $newStringTabPassed = $session->get('questionPassed') . ',' . $rowQuestion->getId();
                    $session->set('questionPassed', $newStringTabPassed);

                    break;
                }
            };
        }

        if($tour > 10){

            $user = $this->getUser();
            
            $score = $user->getScore();

            $score = (int)$score + (int)$session->get('score');
            
            $user->setScore($score); 

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('finQuiz', ['id' => $id]);

        }


        if(!empty($request->request)){
            if($request->request->get('selectReponse') == 1){
                $session->set('score', $session->get('score') + 15);
                $reponseIsTrue = true; 
            }
        }

     
        return $this->render('quizz/startQuiz.html.twig', [
            'question' => $question,
            'tour'=> $tour,
            'passage' => $passage,
            'description' => $description,
            'reponseIsTrue' => $reponseIsTrue
        ]);

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
     * @Route("/finQuiz/{id}", name="finQuiz")
     */
    public function finQuiz($id, QuizRepository $quizRepository, UserRepository $userRepository): Response
    {
        $quiz = $quizRepository->findOneById($id);

        $quiz->getId();

        $tabTheme = array();

        $score = $this->getUser()->getScore();

        foreach ($quiz as $rowQuiz) {
            if (!in_array($rowQuiz->getTheme(), $tabTheme)) {
                array_push($tabTheme, $rowQuiz->getTheme());
            }
        }

        

        return $this->render('quizz/finQuiz.html.twig', ['quiz' => $quiz, 'themes' => $tabTheme, 'score' => $score
        ]);
    }



 
}



