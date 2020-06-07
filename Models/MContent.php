<?php

include_once('DBConn.php');

class MContent{


    public function getSongs($songID){

        $sql = DBConn::getConnection()->
                prepare("SELECT * FROM songs WHERE id = :cSongId");
        $sql->execute(['cSongId'=>$songID]);
        return $sql->fetch();
    }
    
    public function getArtist($cArtistName){
        if($this->existsEntity("artists",$cArtistName) === false)
            return -1;
        $sql = DBConn::getConnection()->prepare("SELECT id FROM artists WHERE artist_name = :cArtistName");
        $sql->execute(["cArtistName"=>$cArtistName]);
        return $sql->fetch()[0];
    }

    public function likeSong($cArtistName, $cSongName){
        $artist_id = $this->getArtist($cArtistName);
        if($artist_id === -1)
            return -12;
        if($this->existsEntity("songs", $cSongName)===false)
            return -13;
        $sql = DBConn::getConnection()->prepare("UPDATE musical_catalogue SET number_of_likes=number_of_likes+1 WHERE artist_id=:c_artist_id AND song_title=:c_song_name");
        $sql->execute(["c_artist_id"=>$artist_id,"c_song_name"=>$cSongName]);

        $sql = DBConn::getConnection()->prepare("SELECT number_of_likes FROM musical_catalogue WHERE artist_id =:c_artist_id AND song_title = :c_song_name");
        $sql->execute(["c_artist_id"=>$artist_id,"c_song_name"=>$cSongName]);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function getMusicalCatalogue(){

        $sql = DBConn::getConnection()->prepare("SELECT * FROM musical_catalogue");
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function existsEntity($table, $candidate){
        $entity_name = NULL;
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
        $sql = DBConn::getConnection()->
            prepare("SELECT COUNT(*) FROM :table WHERE :title = :cTitle");
        $sql->execute(['table'=>$table, 'title'=>$entity_name, 'cTitle'=>$candidate]);
        return ($sql->fetchColumn() === 0) ? false : true;
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