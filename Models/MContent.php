<?php

include_once('DBConn.php');

class MContent
{


    public function getSongs($songID)
    {

        $sql = DBConn::getConnection()->prepare("SELECT * FROM songs WHERE id = :cSongId");
        $sql->execute(['cSongId' => $songID]);
        return $sql->fetch();
    }

    public function getAlbums($artist_name)
    {
        $sql = DBConn::getConnection()->prepare("SELECT artist_name, title, year FROM artists JOIN albums ON artists.id = albums.artist_id WHERE artists.artist_name = :artist_name");
        $sql->execute(['artist_name' => $artist_name]);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getArtists($offset)
    {
        $sql = DBConn::getConnection()->prepare("SELECT artist_name FROM artists");
        $sql->execute();
        return $sql->fetchAll();
    }
    public function getArtist($cArtistName)
    {
        if ($this->existsEntity("artists", $cArtistName) === false)
            return -1;
        $sql = DBConn::getConnection()->prepare("SELECT id FROM artists WHERE artist_name = :cArtistName");
        $sql->execute(["cArtistName" => $cArtistName]);
        return $sql->fetch()[0];
    }
    public function getSong($c_song_name, $artist_id)
    {
        $sql = DBConn::getConnection()->prepare("SELECT id FROM songs WHERE song_title = :song_title AND artist_id = :artist_id");
        $sql->execute(["song_title" => $c_song_name, "artist_id" => $artist_id]);
        return $sql->fetch()[0];
    }
    public function playSong($cArtistName, $cSongName, $user_id)
    {

        $artist_id = $this->getArtist($cArtistName);
        if ($artist_id === -1)
            return False;
        if ($this->existsEntity("songs", $cSongName) === false)
            return False;
        $sql = DBConn::getConnection()->prepare("INSERT INTO activity_history(song_id, user_id, activity_id) VALUES( :song_id, :user_id, 1)");
        $sql->execute(["song_id" => $this->getSong($cSongName, $artist_id), "user_id" => $user_id]);

        return True;
    }
    public function likeSong($cArtistName, $cSongName)
    {
        $artist_id = $this->getArtist($cArtistName);
        if ($artist_id === -1)
            return -12;
        if ($this->existsEntity("songs", $cSongName) === false)
            return -13;
        $sql = DBConn::getConnection()->prepare("UPDATE musical_catalogue SET number_of_likes=number_of_likes+1 WHERE artist_id=:c_artist_id AND song_title=:c_song_name");
        $sql->execute(["c_artist_id" => $artist_id, "c_song_name" => $cSongName]);

        $sql = DBConn::getConnection()->prepare("SELECT number_of_likes FROM musical_catalogue WHERE artist_id =:c_artist_id AND song_title = :c_song_name");
        $sql->execute(["c_artist_id" => $artist_id, "c_song_name" => $cSongName]);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function getMusicalCatalogue($offset)
    {

        $sql = DBConn::getConnection()->prepare("SELECT * FROM musical_catalogue LIMIT 10 OFFSET :offset ");
        $sql->execute(["offset" => $offset]);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDashboard($offset)
    {
        $sql = DBConn::getConnection()->prepare("SELECT * FROM dashboard LIMIT 15 OFFSET :offset ");
        $sql->execute(['offset' => $offset]);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function existsEntity($table, $candidate)
    {
        $entity_name = NULL;
        $sql = NULL;
        switch ($table) {
            case "artists":
                $sql = DBConn::getConnection()->prepare("SELECT id FROM artists WHERE artist_name =:title");
                break;
            case "albums":
                $sql = DBConn::getConnection()->prepare("SELECT id FROM albums WHERE title=:title");
                break;
            case "songs":
                $sql = DBConn::getConnection()->prepare("SELECT id FROM songs WHERE song_title=:title");
                break;
        }
        $sql->execute(['title' => $candidate]);
        return $sql->fetchColumn(0);
    }

    public function uploadPlaylist($playlist_array, $user_id){
        
        foreach(($playlist_array)["track"] as $song){
            $sql = DBConn::getConnection()->prepare("INSERT INTO preferences(user_id, song_id, playlist_title, creator_title) VALUES(:user_id, :song_id, :playlist_title, :creator_title)");
            $song_id = $this->existsEntity("songs", $song["title"]);
            if($song_id == -1)
                return False;
            $sql->execute(['user_id'=>$user_id, 'song_id'=>$song_id, "playlist_title"=>$playlist_array["title"], "creator_title"=>$playlist_array["creator"]]);
        }

        return True;
    }

    /* public function insertEntity($table, $candidate){
        $entity_name;
        switch($table){
            case "artists":
                $entity_name='artist_name';
                break;
            case "albums":
                $entity_name='title';
                break;
            case "songs":
                $entity_name='song_title';
                break;
        }
       $sql = "INSERT INTO $table($entity_name) VALUES(:cEntityName)";
       $request = DBConn::getConnection()->prepare($sql);
       return $request->execute(['cEntityName'=>$candidate]);
   }*/
    //Alexandru Ichim
}
