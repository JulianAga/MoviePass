<?php
require_once("Models/cine.php");
require_once("Repository/PostsRepository.php");

use models\Cine as Cine;
use Repository\PostsRepository as PostsRepository;


if($_POST)
{

   
    $repository = new PostsRepository();
    echo $_POST['eliminar'];
    
 $repository->disable($_POST['eliminar']);

    //$repository->saveData();

    echo "<script> alert('Producto eliminado!');";
    echo "window.location = 'ROOT_VIEW'; </script>";
}

 ?>