<?php

namespace App\Model;

class NewMusicModel extends AbstractManager
{
    public function insertAnime($array)
    {
        $query = "INSERT INTO music (`url`, `name`, `genre_id` ) VALUES (:url, :name, 4)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':url', $array['url'], \PDO::PARAM_STR);
        $statement->bindValue(':name', $array['name'], \PDO::PARAM_STR);
        $statement->execute();
    }
}