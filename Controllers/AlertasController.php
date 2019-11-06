<?php namespace Controllers;


class AlertasController{

	//----------------ATRIBUTOS-----------------------
	 private $arrayAlertasExito;
	 private $arrayAlertasError;
	//----------------CONSTRUCTOR---------------------
	 function __construct(){
	 	$this->arrayAlertasExito;
	 	$this->arrayAlertasError;

	 }
	//-----------------METODOS-------------------------

	 public function addAlertExito($alert){
	 	$this->arrayAlertasExito=$alert;//guardo el string de la alerta en el array
	 	return $this->arrayAlertasExito;

	 }//fin add alert
	 //
	 //
	 //
	 public function addAlertError($alert){
	 	$this->arrayAlertasError=$alert;//guardo el string de la alerta en el array
	 	return $this->arrayAlertasError;

	 }//fin add alert

}//fin calss







?>