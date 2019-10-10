<?php
namespace Repository;
include "Config/API_tmdb.php";//llamado a la configuracion API the movie DB
//include_once "api/api_genre_list.php";

use Models\Genre as Genre;


class DAOGenres{

    
    
    private $List;

    public function GetJsonGenre(){       
        include "Config/API_tmdb.php";
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "http://api.themoviedb.org/3/genre/movie/list?language=en-US&api_key=".$apikey,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "{}",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        }
        else return $response;
    }
    
    public function GetAll(){
        $this->RetrieveData();

        return $this->List;
    }

    public function GetById($id){
        $this->RetrieveData();
        $accountFounded = null;
        
        if(!empty($this->List)){
            foreach($this->List as $genre){
                if($genre->getId() == $id){
                    $accountFounded = $genre;
                }
            }
        }
        else
        {
            echo 'esta vacio';
        }

        return $accountFounded;
    }


    private function RetrieveData()
    {
        

        $genreList= json_decode( $this->GetJsonGenre(),true );
        
        //var_dump($genreList);

        //echo'arranca el foreach'.'<br>';
        $this->List = array();
        
        foreach($genreList as $valuesArray)
        {
            foreach($valuesArray as $genre)
            {
                $genre = new Genre($genre["id"],$genre["name"]);
                array_push($this->List, $genre);

            
            }


            
        }
        
    }

}
?>