<?php

class CContentGeneration{

    private $contentModel;
    private $authModel;

    public function __construct(){
        $this->contentModel = new MContent();
        $this->authModel = new MNonAuth();
    }

    public function test(){
        echo json_encode(array("number_of_likes"=>$this->contentModel->existsEntity("songs","Master of Puppets")));
    }
    public function likeSong(){

        $json_array = NULL;
        if(isset($_COOKIE['jwt_token'])===FALSE){
            http_response_code(401);
            $json_array = array('success'=>'false','message'=>'Please authentify yourself.');
        }
        else{
            $input = file_get_contents("php://input");
            $candidate_song = json_decode($input);
            http_response_code(200);
            echo json_encode($this->contentModel->likeSong($candidate_song->artist_name, $candidate_song->song_title));
        }
    }
    public function getProductions(){
        $json_array = NULL;
        if(isset($_COOKIE['jwt_token'])==False){ 
            http_response_code(401);
            $json_array = array('success'=>'false','message'=>'Please authentify yourself.');
        }
        else{
            http_response_code(200);
            $json_array = $this->contentModel->getMusicalCatalogue();
        }
        echo json_encode($json_array);
    }
    public function getSongs(){

        $json_array = NULL;
        if(((isset($_COOKIE['jwt_token'])==FALSE))){
            $json_array['success'] = 'false';
        }
        else{
            $contor = 1;
            $json_array = [];
            $currentSong = $this->contentModel->getSongs($contor);
            while(empty($currentSong) === FALSE){
                $current_song_array = [];
                foreach($currentSong as $current_key=>$current_field){
                if(is_numeric($current_key) == 1)
                    continue;
                $current_song_array[$current_key] = $current_field; 
                }
                $json_array["song$contor"] = $current_song_array;
                $contor = $contor + 1;
                $currentSong = $this->contentModel->getSongs($contor);
            }
        }
        echo json_encode($json_array);
    }
    public function uploadPlaylist(){
        $input = file_get_contents("php://input");
        $myFile = $_FILES["new_playlist"];
        $myPath = $myFile["tmp_name"];
        $playlistArray = json_decode(file_get_contents($myPath),true)['track'];
        print_r($playlistArray);
        foreach($playlistArray as $current_key=>$current_track){
            if($current_key === 'creator')
                if($this->contentModel->existsEntity('artists',$current_track) == false)
                    $this->contentModel->insertArtist($current_track);
        }
        echo file_get_contents($myPath);
    }

    
}

//Alexandru Ichim
?>
