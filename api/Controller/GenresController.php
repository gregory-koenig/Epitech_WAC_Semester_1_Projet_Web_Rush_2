<?php

class GenresController
{
    private $db;

    /**
     * GenresController constructor.
     */
    public function __construct()
    {
        $this->db = App::getDatabase();
    }

    /**
     *
     */
    public function getAll()
    {
        $sql = 'SELECT id, name AS genre FROM genres';
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }

    /**
     * @param $id
     */
    public function getById($id)
    {
        $sql = 'SELECT id, name AS genre FROM genres
                WHERE id = ?';
        $data = $this->db->query($sql, [$id])->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data as $key => $value) {
            $sql_albums = 'SELECT id, name FROM albums
                            LEFT JOIN genres_albums
                              ON albums.id = genres_albums.album_id
                            WHERE genres_albums.genre_id = ?';
            $data_albums = $this->db->query($sql_albums, [$data[$key]['id']])
                ->fetchAll(PDO::FETCH_ASSOC);
            $data[$key]['albums'] = $data_albums;
        }

        echo json_encode($data);
    }
}