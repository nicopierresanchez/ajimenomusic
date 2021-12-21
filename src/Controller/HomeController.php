<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\MusicManager;
use App\Model\NewMusicModel;
use Google_Client;
use Google_Service_YouTube;

class HomeController extends AbstractController
{
    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function show2()
    {
        session_start();


        $itemManager = new MusicManager();
        $musics = $itemManager->selectAllLimit2();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_SESSION['validateMusique'][] = [
                'title' => $_POST['title'],
                'url' => $_POST['url']
            ];
            $id = $_POST["id"];
            $new = new MusicManager();
            $new->insertVote($id);
            header('Location: /');
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['select'])) {
                $select = new MusicManager();
                $new = $select->selectAllLimit2Select($_GET['select']);
                return $this->twig->render('Home/index.html.twig', ["musics" => $new, "isGet" => $_GET['select']]);
            }
        }


        return $this->twig->render('Home/index.html.twig', ["musics" => $musics]);
    }
}
