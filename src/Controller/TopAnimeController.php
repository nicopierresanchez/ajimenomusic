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

class TopAnimeController extends AbstractController
{
    public function index()
    {
        session_start();
        $itemManager = new MusicManager();
        $musics = $itemManager->selectAllAnimeLimit2();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_SESSION['validateMusique'][] = [
                'title' => $_POST['title'],
                'url' => $_POST['url']
            ];
            $id = $_POST["id"];
            $new = new MusicManager();
            $new->insertVote($id);
        }

        return $this->twig->render('Home/topAnime.html.twig', ["musics" => $musics]);
    }
}