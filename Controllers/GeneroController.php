<?php namespace Controllers;
use models\Genre as Genre;
/**
 * 
 */
class GeneroController
{
	private $generoDAO;

        //------------------------CONSTRUCTOR-----------------------
	function __construct()
	{
		$this->generoDAO = \DAO\GenerosDAO::getInstance();
	}

        //------------------------METODOS----------------------------

        public function recibirGeneros()
        {
        
                include "Config/API_tmdb.php";
                //$curl = curl_init();

                /*curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.themoviedb.org/3/genre/movie/list?api_key=2b3ba78ccc0274a444d8367fd978ae20&language=en-US",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POSTFIELDS => "{}",
                ));*/
                
                $cm = curl_init();
                curl_setopt($cm, CURLOPT_URL, "https://api.themoviedb.org/3/genre/movie/list?api_key=2b3ba78ccc0274a444d8367fd978ae20&language=en-US");
                curl_setopt($cm, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($cm, CURLOPT_HEADER, FALSE);
                curl_setopt($cm, CURLOPT_HTTPHEADER, array("Accept: application/json"));
                $response7 = curl_exec($cm);
                $err = curl_error($cm);
                curl_close($cm);
                $genreList= json_decode($response7,true);
                
                $arrayGenero=array();

                foreach ($genreList as $key) 
                {
                        foreach ($key as $genre ) 
                        {
                                $genero= new Genre ($genre["id"],$genre["name"]);
                                array_push($arrayGenero, $genero);
                        }

                        
                }//foreach


                if ($err) 
                {
                        $msj="cURL Error #:" . $err;
                        $_SESSION['Error']=$msj;
                        var_dump($msj);
                }
                else
                {
                        return $arrayGenero;
                }


	}
        //
        //
        //
	public function guardar_Generos($arrayGeneros){

                try
		{
                        foreach ($arrayGeneros as $key) {
                        
                                $buscado= $this->generoDAO->buscarPorID($key->getId());//busco en BD si existe ese genero. devuelve NULL si no encuentra
                                if($buscado==null){	//guardo solo los que no estan en BD
                                $this->generoDAO->insertar($key);	
                                }
                        }
		}
		catch(PDOException $ex)
		{
			$_SESSION['Error']="Error al guardar generos";
		}
              

	}
}//fin class





?>