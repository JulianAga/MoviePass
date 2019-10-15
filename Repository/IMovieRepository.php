<?php namespace Repository;

    use Models\Pelicula as Pelicula;

    interface IMovieRepository
    {
        function Add(Pelicula $newMovie);
        function GetAll();
        function delete(Pelicula $movie);
    }
?>