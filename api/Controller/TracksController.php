<?php

class TracksController
{
    private $db;

    /**
     * TracksController constructor.
     */
    public function __construct()
    {
        $this->db = App::getDatabase();
    }

    /**
     * @param $id
     */
    public function getById($id)
    {
        $sql = 'SELECT * FROM tracks WHERE id = ?';
        $data = $this->db->query($sql, [$id])->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }
}