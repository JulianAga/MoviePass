<?php namespace Views;
use Controllers\FuncionController as FuncionController;
use models\Cine as Cine;
include "../../Config/API_tmdb.php";//llamado a la configuracion API the movie DB
include "../../Api/api_now.php";// incluyo la API de peliculas actuales en cartelera

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Cines Administrador</title>
<!-- SWEET ALERT -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- SWEET ALERT -->

<link rel="stylesheet" href="/MoviePass/Views/css/header2.css"><!-- ARCHIVO CSS-->




</head> 

<body class="fondo_cines_adm">
     <!------------ MUESTRA DE ERRORES PROVENIENTES DE LA CONTROLADORA------->
     <?php if ($arrayAlertExito!=null) { ?>
            
            <script> sweetAlert("Exito","<?php echo $arrayAlertExito; ?>", "success")</script>
        <?php } ?>

    <?php if ($arrayAlertError!=null) { ?>
            <script> sweetAlert("Error", "<?php echo $arrayAlertError; ?>", "error")</script>
             <?php } ?>
    <!-------------------------------------- - ------------------------------>
    <header>
        <?php include_once("header_adm.php"); ?> <!-- llamado a la barra nav de home-->
    </header>

<!-- INICIO DEL MAIN -->

    <main class="p-5">
        <div class="container position-relative align-middle">
        <h1 class="box_titulo box_transparente">CINES</h1>
                <table class="table box_transparente table_transparente">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Funcion</th>
                            <th>dia</th>
                            
                        </tr>
                    </thead>
                    <tbody>

                   


<!-- FIN DEL MAIN -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="<?php echo "JS_PATH" ?>/sweetalert.min.js" type="javascript"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</body>

</html>
