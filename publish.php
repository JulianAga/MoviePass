<?php
require_once("Modelos/cine.php");
require_once("Repository/PostsRepository.php");

use modelos\Cine as Cine;
use Repository\PostsRepository as PostsRepository;


if($_POST){
    $newProd = new Cine();
    $newProd->setDireccion($_POST['direccion']);
    $newProd->setNombre($_POST['cine']);
    $newProd->setID($_POST['ID']);
   $newProd->setValor_entrada($_POST['valor']);
    //$newProd->setDate($_POST['date']);
    $newProd->setCapacidad($_POST['capacidad']);

   
    $repository = new PostsRepository();
	$repository->add($newProd);
    echo "<script> alert('Cine agregado satisfactoriamente!');";
    echo "window.location = 'posts.php'; </script>";
    $successMje =  "Cine agregado satisfactoriamente!";
}

 ?>