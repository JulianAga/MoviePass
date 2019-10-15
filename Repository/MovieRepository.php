<?php namespace Repository;

use models\Pelicula as Pelicula;
use Repository\IMovieRepository as IMovieRepository;

class MovieRepository implements IMovieRepository{

	private $movieList = array();


	//---------------------------------------------------------
    public function getAll()
    {
        $this->RetrieveData();

        return $this->movieList;
    }
    //
    //

    public function add(Pelicula $newMovie)//agregar cuenta nueva
    {
        
        $this->RetrieveData();
        
        array_push($this->movieList, $newMovie);

        $this->SaveData();
    }
    //
    //
    //Json Persistence
    private function SaveData()
    {
        $arrayToEncode = array();
        foreach($this->movieList as $movie) //recorro la lista con cuentas
        {
            $valuesArray["id"] = $movie->getId();                 //guardo todos los valores en un array
            $valuesArray["descripcion"] = $movie->getDescripcion();
            $valuesArray["nombre"] = $movie->getNombre();
            $valuesArray["restriccion"] = $movie->getRestriccion();
            $valuesArray["duracion"] = $movie->getDuracion();                 //guardo todos los valores en un array
            $valuesArray["codigo"] = $movie->getCodigo();
            $valuesArray["categoria"] = $movie->getCategoria();
            $valuesArray["tipo"] = $movie->getTipo();
            

            array_push($arrayToEncode, $valuesArray);   
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);      //se guarda LA CUENTA EN EL JSON
        
        file_put_contents('Data/peliculas.json', $jsonContent);
    }//fin savedata
    //
    //
    private function RetrieveData()
    {
        $this->movieList = array();

        if(file_exists('Data/peliculas.json'))
        {
            $jsonContent = file_get_contents('Data/peliculas.json');  //trae los datos del json

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array(); //se decodifica el json

            foreach($arrayToDecode as $valuesArray)    //se recorre el  array
            {
                
                
                $movie = new Pelicula($valuesArray["id"],$valuesArray["descripcion"],$valuesArray["nombre"],$valuesArray["restriccion"],$valuesArray["duracion"],$valuesArray["codigo"],$valuesArray["categoria"],$valuesArray["tipo"]); //se van creando las cuentas


                array_push($this->movieList, $movie);
            }
        }

        else{
            echo 'no existe json';
        }
    }//fin retrievedata
    //
    //
    public function delete(Pelicula $movie){

    }//fin delete
    //
    //


}//fin class---------




?>