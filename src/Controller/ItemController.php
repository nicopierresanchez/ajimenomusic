<?php

namespace App\Controller;

use App\Model\ItemManager;

class ItemController extends AbstractController
{
    /**
     * List items
     */
    public function index(): string
    {
        $itemManager = new ItemManager();
        $items = $itemManager->selectAll('title');

        return $this->twig->render('Item/index.html.twig', ['items' => $items]);
    }


    /**
     * Show informations for a specific item
     */
    public function show(int $id): string
    {
        $itemManager = new ItemManager();
        $item = $itemManager->selectOneById($id);

        return $this->twig->render('Item/show.html.twig', ['item' => $item]);
    }


    /**
     * Edit a specific item
     */
    public function edit(int $id): string
    {
        $itemManager = new ItemManager();
        $item = $itemManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $item = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
            $itemManager->update($item);
            header('Location: /items/show?id=' . $id);
        }

        return $this->twig->render('Item/edit.html.twig', [
            'item' => $item,
        ]);
    }


    /**
     * Add a new item
     */
    public function add(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $item = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $itemManager = new ItemManager();
            $id = $itemManager->insert($item);
            header('Location:/items/show?id=' . $id);
        }

        return $this->twig->render('Item/add.html.twig');
    }


    /**
     * Delete a specific item
     */
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $itemManager = new ItemManager();
            $itemManager->delete((int)$id);
            header('Location:/items');
        }
    }


    public function test(): string
    {
        /*        $playlist = 'PLcCQJuPwyya3uxri7ZCiDDjMwaaVXz7DK';

                $musics = new MusicManager();
                $musicRand = $musics->twoRandomMusicByGenre($playlist);

                $sing1 = [
                    'title' => $musicRand[0]->snippet->title,
                    'video_id' => "https://www.youtube.com/embed/" . $musicRand[0]->snippet->resourceId->videoId
                ];

                $sing2 = [
                    'title' => $musicRand[1]->snippet->title,
                    'video_id' => "https://www.youtube.com/embed/" . $musicRand[1]->snippet->resourceId->videoId
                ];
                return $this->twig->render('Home/test.html.twig', ["musics" => [$sing1, $sing2]]);*/

        $json = json_decode(file_get_contents(__DIR__ . '/../../music.json'));

        var_dump($json);
        die();
        $newMusic = new NewMusicModel();
        $array = [];
        foreach ($json->items as $music) {
            $array = [
                'url' => "https://www.youtube.com/embed/" . $music->snippet->resourceId->videoId,
                'name' => $music->snippet->title,
            ];
            $newMusic->insertAnime($array);
        };

        die();

        var_dump($json->items[0]->snippet->resourceId->videoId);


    }
}
