<?php

class ArtistsController
{
    private $db;

    /**
     * ArtistsController constructor.
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
        $sql = 'SELECT id, name AS artist FROM artists';
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }

    /**
     * @param $id
     */
    public function getById($id)
    {
        $sql = 'SELECT id, name, description, bio, photo FROM artists
                WHERE id = ?';
        $data = $this->db->query($sql, [$id])->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data as $key => $value) {
            $sql_albums = 'SELECT name FROM albums WHERE artist_id = ?';
            $data_albums = $this->db->query($sql_albums, [$data[$key]['id']])
                ->fetchAll(PDO::FETCH_ASSOC);
            $data[$key]['albums'] = $data_albums;
        }

        echo json_encode($data);
    }
}