<?php

class CContentGeneration{

    private $contentModel;
    private $authModel;
    private $rssFeed;

    public function __construct(){
        $this->contentModel = new MContent();
        $this->authModel = new MNonAuth();
    }

    public function rssFeed($offset=0){

        header('Content-type: application/xml');
        $dashboard = $this->contentModel->getDashboard($offset);

        $this->rssFeed .= "<rss version='2.0' xmlns:atom='https://www.w3.org/2005/Atom'>";
        $this->rssFeed .= "<channel>";
        $this->rssFeed .= "<title>Latest musical auditions</title>";
        $this->rssFeed .= "<description>These are the 10 most recent musical auditions.</description>";
        $this->rssFeed .= "<link>http://localhost:1027</link>";

        foreach($dashboard as $auditions){
            $this->rssFeed .= "<item>";
            $this->rssFeed .= "<title>".$auditions['username']." a ascultat ".$auditions['artist_name']."".$auditions['song_title']."</title>";
            $this->rssFeed .= "<description>Este un cantec de genul".$auditions['metadata_value']." care a mai fost ascutat de".$auditions['number_of_likes']." de ori."."</description>";
            $this->rssFeed .= "<pubDate>".$auditions['updated-at']."</pubDate>";
            $this->rssFeed .= "<link>http://localhost:1027/Pages/dashboard.php</link>";
            $this->rssFeed .= "<guid>http://localhost:1027/Pages/dashboard.php</guid>";
            $this->rssFeed .= "<atom:link href='http://localhost:1027/Pages/dashboard.php' />";
            $this->rssFeed .= "</item>";
        }

        $this->rssFeed .= "</channel>";
        $this->rssFeed .= "</rss>";

        echo $this->rssFeed;
    }
    public function likeSong(){

        $json_array = NULL;
        $jwt_array = NULL;
        try{
            $jwt_array = $this->authModel->decodeJWTArray($_COOKIE['jwt_token']);
        }
        catch(Exception $e){

            http_response_code(401);
            $json_array = array('success'=>'false','message'=>'Please authentify yourself.');
        }
        $input = file_get_contents("php://input");
        $candidate_song = json_decode($input);
        http_response_code(200);
        echo json_encode($this->contentModel->likeSong($candidate_song->artist_name, $candidate_song->song_title));
    }

    public function playSong(){
        $json_array = NULL;
        $jwt_array = NULL;
        try{
            $jwt_array = $this->authModel->decodeJWTArray($_COOKIE['jwt_token']);
        }
        catch(Exception $e){
            http_response_code(401);
            $json_array = array('success'=>'false','message'=>'Please authentify yourself.');
        }
        $input = file_get_contents("php://input");
        $candidate_song = json_decode($input);
        http_response_code(200);
        echo json_encode($this->contentModel->playSong($candidate_song->artist_name, $candidate_song->song_title, ($jwt_array->data->id)));
    }

    public function getProductions($offset=0){
        $json_array = NULL;
        $jwt_array = NULL;
        try{
            $jwt_array = $this->authModel->decodeJWTArray($_COOKIE['jwt_token']);
        }
        catch(Exception $e){
            http_response_code(401);
            $json_array = array('success'=>'false','message'=>'Please authentify yourself.');
        }
        http_response_code(200);
        $json_array = $this->contentModel->getMusicalCatalogue($offset);
        echo json_encode($json_array);
    }

    public function getArtists($offset=0){
        $json_array = NULL;
        $jwt_array = NULL;
        $additionalMessage = NULL;
        try{
            $jwt_array = $this->authModel->decodeJWTArray($_COOKIE['jwt_token']);
        }
        catch(Exception $e){
            $additionalMessage = $e->getMessage();
            http_response_code(401);
        }

        http_response_code(200);
        echo json_encode($this->contentModel->getArtists($offset));
    }

    public function getAlbums($artist_name){
        $json_array = NULL;
        $jwt_array = NULL;
        $additionalMessage = NULL;
        try{
            $jwt_array = $this->authModel->decodeJWTArray($_COOKIE['jwt_token']);
        }
        catch(Exception $e){
            $additionalMessage = $e->getMessage();
            http_response_code(401);
        }

        http_response_code(200);
        echo json_encode($this->contentModel->getAlbums($artist_name));

    }

    public function getHistory($offset=0){
        $json_array = NULL;
        $jwt_array = NULL;
        $additionalMessage = NULL;
        try{
            $jwt_array = $this->authModel->decodeJWTArray($_COOKIE['jwt_token']);
        }
        catch(Exception $e){
            $additionalMessage = $e->getMessage();
            http_response_code(401);
        }
        
        echo json_encode($this->contentModel->getDashboard($offset));
    }

    public function getSongs(){

        $json_array = NULL;
        $jwt_array = NULL;
        try{
            $jwt_array = $this->authModel->decodeJWTArray($_COOKIE['jwt_token']);
        }
        catch(Exception $e){
            http_response_code(401);
        }
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
        echo json_encode($json_array);
    }
    public function uploadPlaylist(){

        $json_array = NULL;
        $jwt_array = NULL;
        $additionalMessage = NULL;
        try{
            $jwt_array = $this->authModel->decodeJWTArray($_COOKIE['jwt_token']);
        }
        catch(Exception $e){
            http_response_code(401);
            $additionalMessage = $e->getMessage();
            $json_array = array("success"=>False,"additionalMessage"=>$additionalMessage);
        }

        header('Content-Type: application/json');
        $input = file_get_contents("php://input");
        $myFile = $_FILES["new_playlist"];
        $myPath = $myFile["tmp_name"];
        $playlistArray = json_decode(file_get_contents($myPath),true)['playlist'];
        echo json_encode(array("success"=>$this->contentModel->uploadPlaylist($playlistArray, $jwt_array->data->id),"payload"=>json_encode($playlistArray)));
    }

    
}

//Alexandru Ichim
