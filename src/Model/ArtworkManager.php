<?php

namespace App\Model;

class ArtworkManager extends AbstractManager
{
    const TABLE = 'artworks';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectArtworks(int $categoryArtwork = null):array
    {
        $query='SELECT *, a.id as idArtwork FROM ' . $this->table . ' a JOIN works_category c 
        ON a.category_id=c.id'
            . ($categoryArtwork !==null ? ' WHERE c.id=' . $categoryArtwork : '' );
        $statement =$this->pdo->prepare($query);
        $statement->execute();
        $artworks = $statement->fetchAll();

        return $artworks;
    }
    public function selectArtwork(int $idArtwork = null):array
    {
        $query='SELECT *, a.id as idArtwork FROM ' . $this->table . ' a JOIN works_category c 
        ON a.category_id=c.id WHERE a.id=' . $idArtwork . ';';
        $statement =$this->pdo->prepare($query);
        $statement->execute();
        $artwork = $statement->fetch();
        return $artwork;
    }

    public function selectCarousel(): array
    {
        $listSlide = $this->pdo->query('SELECT * FROM ' . $this->table . ' WHERE carousel = true')->fetchAll();
        return $listSlide;
    }
}
