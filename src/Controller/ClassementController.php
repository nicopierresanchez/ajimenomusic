<?php

namespace App\Controller;

use App\Model\ClassementManager;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ClassementController extends AbstractController
{
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function index(): string
    {
        session_start();
        if (isset($_SESSION['validateMusique'])) {
            $validateMusique = $_SESSION['validateMusique'];

            $classementManager = new ClassementManager();
            $videos = $classementManager->selectAll('points', 'desc');
            return $this->twig->render('Classement/index.html.twig', [
                'videos' => $videos,
                'validate' => $validateMusique
            ]);
        }

        $classementManager = new ClassementManager();
        $videos = $classementManager->selectAll('points', 'desc');
        return $this->twig->render('Classement/index.html.twig', ['videos' => $videos]);
    }
}
