<?php

namespace App\Controller;

use App\Form\FlashCardType;
use App\HttpClient\ApiHttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class FlashCardController extends AbstractController{
    #[Route('/flashcards', name: 'app_flashcards')]
    public function flashcards(ApiHttpClient $apiHttpClient): Response
    {
        $flashcards = $apiHttpClient->getFlashcards();
        return $this->render('home/index.html.twig', [
            'flashcards' => $flashcards,
        ]);
    }

    #[Route('/flashcard/new', name: 'app_home_flashcard_form')]
    public function flashCardForm(Request $request, ApiHttpClient $apiHttpClient): Response
    {
        $user = $this->getUser();

        $flashCardForm = $this->createForm(FlashCardType::class);

        $flashCardForm->handleRequest($request);
        
        if($flashCardForm->isSubmitted() && $flashCardForm->isValid()) {
            $question = $flashCardForm->get('question')->getData();
            $answer = $flashCardForm->get('answer')->getData();
            $userId = $user->getId();

            $response = $apiHttpClient->addFlashcard([
                "question"=> $question,
                "answer"=> $answer,
                "userId"=> $userId
            ]);

            return $this->redirectToRoute('app_home', [
                
            ]);
            
        }

        return $this->render('flashcard/flashcard_form.html.twig', [
            'form' => $flashCardForm,
        ]);
    }
    
}
