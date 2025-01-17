<?php

namespace App\HttpClient;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiHttpClient extends AbstractController
{
    private $httpClient;

    public function __construct(HttpClientInterface $httpc)
    {
        $this->httpClient = $httpc;
    }

    public function getFlashcards()
    {
        $response = $this->httpClient->request('GET', "/api/flashcard", [
            'verify_peer' => false
        ]);

        return $response->toArray();
    }

    public function getFlashcard(string $id)
    {
        $response = $this->httpClient->request('GET', "/api/flashcard/$id", [
            'verify_peer' => false
        ]);

        return $response->toArray();
    }

    public function addFlashcard(array $data)
    {
        try {
            $response = $this->httpClient->request('POST', 'http://localhost:3000/api/flashcard', [
                'json' => $data,  // Les données de la flashcard
            ]);

            // Vérifier si la requête a réussi
            if ($response->getStatusCode() === 201) {
                return $response->toArray(); // Retourner les données de la flashcard créé
            }

            // Si le code de statut n'est pas 201, on lance une exception
            throw new \Exception('Error adding flashcard to database.');
        } catch (\Exception $e) {
            // Gérer l'exception si la requête échoue (erreur réseau, API hors ligne, etc.)
            throw new \Exception('An error occurred while adding the flashcard. Please try again later.');
        }
    }
}