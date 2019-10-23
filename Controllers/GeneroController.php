<?php namespace Controllers;
use models\Genre as Genre;
/**
 * 
 */
class GeneroController
{
	private $generoDAO;
	function __construct()
	{
		$this->generoDAO = \DAO\GenerosDAO::getInstance();
	}

	public function recibirGeneros(){
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
        $arrayGenero=array();

        foreach ($genreList as $key) {
        	foreach ($key as $genre ) {
        		$genero= new Genre ($genre["id"],$genre["name"]);
        		array_push($arrayGenero, $genero);
        	}

        	
        }//foreach

        if ($err) {
        echo "cURL Error #:" . $err;
        }
        else return $arrayGenero;

	}
	public function guardar_Generos($arrayGeneros){
		foreach ($arrayGeneros as $key) {
			
			$this->generoDAO->insertar($key);
		}

	}
}//fin class





?>