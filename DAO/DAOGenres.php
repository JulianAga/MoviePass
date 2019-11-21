<?php

namespace Repository;
include "Config/API_tmdb.php";//llamado a la configuracion API the movie DB
//include_once "api/api_genre_list.php";

use Models\Genre as Genre;


class DAOGenres{

    
    
    private $List;

    public function GetArrayGenre(){       
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
        $genreList= json_decode( $response,true );
        if ($err) {
            $msj="Error en Genero.CURL Error #:" . $err;
            $_SESSION['Error']=$msj;

        
        }
        else return $genreList;
    }
    
    public function GetAll(){
        $this->RetrieveData();

        return $this->List;
    }

    public function GetById($id){
        $this->RetrieveData();
        $genreFounded = null;
        
        if(!empty($this->List)){
            foreach($this->List as $genre){
                if($genre->getId() == $id){
                    $genreFounded = $genre;
                }
            }
        }
        else
        {
            $_SESSION['Error']="Esta vacia la lista de Generos";
            
        }

        return $genreFounded;
    }

    public function GetNameById($id)
    {
        $genre=$this->GetById($id);

        return $genre->getName();
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

    public function delete($id){
		$this->retrieveData();
		$newList = array();
		foreach ($this->List as $genre) {
			if($genre->getCode() != $id){
				array_push($newList, $genre);
			}
		}

		$this->List = $newList;
		$this->saveData();
    }
    
    public function add(Beer $newGenre){
		$this->retrieveData();
		array_push($this->List, $newGenre);
		$this->saveData();
    }
    
    public function saveData(){
		$arrayToEncode = array();

		foreach ($this->List as $genre) {
			$valueArray['id'] = $genre->getId();
			$valueArray['name'] = $genre->getName();
			

			array_push($arrayToEncode, $valueArray);

		}
		$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
		file_put_contents('Data/Genres.json', $jsonContent);
	}

}

?>
