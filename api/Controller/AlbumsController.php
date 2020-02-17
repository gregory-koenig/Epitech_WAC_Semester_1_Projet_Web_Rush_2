<?php

class AlbumsController
{
    private $db;

    /**
     * AlbumsController constructor.
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
        $sql = 'SELECT id, name AS albums FROM albums';
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }

    /**
     * @param $id
     */
    public function getById($id)
    {
        $sql = 'SELECT albums.id, count(tracks.track_no) AS count_tracks,
                  cover, popularity, release_date FROM albums
                LEFT JOIN tracks ON albums.id = tracks.album_id
                WHERE albums.id = ?';
        $data = $this->db->query($sql, [$id])->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data as $key => $value) {
            $sql_genres = 'SELECT name AS genre FROM genres
                            LEFT JOIN genres_albums
                              ON genres.id = genres_albums.genre_id
                            WHERE genres_albums.album_id = ?';
            $data_genres = $this->db->query($sql_genres, [$data[$key]['id']])
                ->fetchAll(PDO::FETCH_ASSOC);

            $sql_tracks = 'SELECT track_no FROM tracks WHERE album_id = ?';
            $data_tracks = $this->db->query($sql_tracks, [$data[$key]['id']])
                ->fetchAll(PDO::FETCH_ASSOC);

            $data[$key]['genres'] = $data_genres;
            $data[$key]['tracks_no'] = $data_tracks;
        }

        echo json_encode($data);
    }
}