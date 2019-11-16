
<?php 


use Repository\CinesRepository as CinesRepository;
use models\Cine as Cine;
include "Config/API_tmdb.php";//llamado a la configuracion API the movie DB
include "Api/api_now.php";// incluyo la API de peliculas actuales en cartelera
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Home Administrador</title>
<!-- SWEET ALERT -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- SWEET ALERT -->

<link rel="stylesheet" href="/MoviePass/Views/css/header2.css"><!-- ARCHIVO CSS-->




</head> 

<body class="fondo_home_adm">


     <!------------ MUESTRA DE ERRORES PROVENIENTES DE LA CONTROLADORA------->
    <?php if (isset($_SESSION['Error']) ) {
   $msj=$_SESSION['Error']; ?>
   
    <script> sweetAlert("Error!", "<?php echo $msj; ?>", "error")</script>
    <?php unset($_SESSION["Error"]);?>
    <?php } ?>
    <!-- -->
    <?php if (isset($_SESSION['Success']) ) {
       $msj2=$_SESSION['Success']; ?>
      
        <script> sweetAlert("Exito!", "<?php echo $msj2; ?>", "success")</script>
        <?php unset($_SESSION["Success"]);?>
    <?php } ?>
    <!-- -->
    <?php if (isset($_SESSION['BD']) ) {
       $msj3=$_SESSION['BD']; ?>
      
        <script> sweetAlert("Error en BD", "<?php echo $msj3; ?>", "error")</script>
        <?php unset($_SESSION["BD"]);?>
    <?php } ?>
    <!-------------------------------------- - ------------------------------> 
    
    
    <header>
        <?php include_once("header_adm.php"); ?> <!-- llamado a la barra nav de home-->
    </header>
        <main class="p-5">
        <div class="container position-relative align-middle">
        <h1 class="box_titulo box_transparente">Cines</h1>
                <table class="table box_transparente table_transparente">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Cine</th>
                            <th>Direccion</th>
                            <th>  </th>
                            <th>  </th>
                            <th>  </th>
                            <th>  </th>

                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    ?>
                    <!-- $arrayCines viene desde el llamado de distintas controladoras  -->
                   <?php if ($arrayCines != null){ ?>
                        <?php foreach ($arrayCines as $key => $value)
                        {
                        $Cine = $value;
                        
                        ?>
                        <tr>
                            <td style="vertical-align:middle;"></td>    
                            <td style="vertical-align:middle;"><?php  echo $Cine->getNombre(); ?></td>
                            <td style="vertical-align:middle;"><?php  echo $Cine->getDireccion(); ?></td>
                            <td></td>

                            

    <!---------------BOTON AGREGAR SALAS ----------------------->

                            <td style="vertical-align:middle;">
                                <button type="button" class="boton_modificar" data-toggle="modal" data-target="#addSalas<?php echo $Cine->getID();?>" data-whatever="@mdo">Agregar Salas</button>
                                <div class="modal fade" style="background: rgba(0,0,0,.6);" id="addSalas<?php echo $Cine->getID();?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Agregar Salas</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                    
                                        <form method="post" action="<?= ROOT_VIEW ?>/Sala/addSala">
                                            <div class="form-group">
                                                <label>Cine </label>
                                                <input type="text" class="form-control" name="nombre_cine" readonly value="<?php echo $Cine->getNombre();?>" disabled/>
                                            </div>
                                            <div class="form-group">
                                                <label>Nombre</label>
                                                <input type="text" class="form-control" name="nombre_sala"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Capacidad</label>
                                                <input type="number" min="1" max="1000" class="form-control" name="id_cine" />
                                            </div>
                                            <div class="form-group">
                                                <label>Valor Entrada</label>
                                                <input type="number" min="0" max="1000" class="form-control" name="valor_entrada" />
                                            </div>
                                               <input type="hidden" value="<?php echo $Cine->getID();?>" name="objCine" />
                                          <div class="modal-footer">
                                            <button type="button" class="boton_cancelar" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="boton_modificar">Agregar</button>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </td>


                            <!---------------BOTON VER SALAS ----------------------->

                            <td style="vertical-align:middle;">
                                <button type="button" class="boton_modificar" data-toggle="modal" data-target="#viewSalas<?php echo $Cine->getID();?>" data-whatever="@mdo">Ver Salas</button>
                                <div class="modal fade" style="background: rgba(0,0,0,.6);" id="viewSalas<?php echo $Cine->getID();?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ver Salas</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <form action="">
                                        <?php
                                      if ($movieList!= null && $salaList!= null){
                                         foreach ($salaList as $sala) { ?>

                                                <?php if($Cine->getID() == $sala->getCine()->getID()) { ?>
                                                  <div class="form-group">
                                                  <label>     Nombre: </label>
                                                  <label>     <?php echo $sala->getNombre(); ?> </label>
                                                  </div>
                                                  <div class="form-group">
                                                  <label>     Capacidad </label>
                                                  <label><t>     <?php echo $sala->getCapacidad(); ?> </t></label>
                                                  </div>
                                                
                                             <?php 
                                            } } }?>
                                            </form>
                                        <div class="modal-footer">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <button type="button" class="boton_cancelar" data-dismiss="modal">Cancelar</button>
                                        </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </td>

                                          

    <!---------------BOTON AGREGAR FUNCION ----------------------->
                       
                            <td style="vertical-align:middle;">
                                <?php if ($movieList!= null && $salaList!= null){?>
                                <button type="button" class="boton_modificar" data-toggle="modal" data-target="#addMovie<?php echo $Cine->getID();?>" data-whatever="@mdo">Agregar Funcion</button> <?php } ?>

                                <?php if ($movieList== null || $salaList== null){?> <!-- DESHABILITO BOTON SI NO HAY SALAS O PELICULAS-- >
                                <button type="button" class="boton_modificar" data-toggle="modal" data-target="#addMovie<?php echo $Cine->getID();?>" data-whatever="@mdo" disabled>Agregar Funcion</button> <?php } ?>

                                <div class="modal fade" style="background: rgba(0,0,0,.6);" id="addMovie<?php echo $Cine->getID();?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Agregar Funcion</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                    <form method="post" action="<?= ROOT_VIEW ?>/Funcion/addFuncion">
                                        <div class="form-group">
                                            <label>Pelicula</label>
                                            <select name="id_pelicula" class="form-control" >
                                                
                                                
                                                    <?php foreach ($movieList as $key ) { ?> 
                                                        <option  value="<?php echo $key->getId_api(); ?>" name="id_pelicula"> <?php echo $key->getNombre(); ?>    
                                                        </option>
                                                    <?php } ?>  
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Cine</label>
                                            <input type="text" class="form-control" name="id_cine" value="<?php echo $Cine->getNombre();?>" disabled readonly/>
                                        </div>
                                        <div class="form-group">
                                            <label>Salas</label>
                                            <select required type="number" name="sala" id="" required>
                                              
                                              <?php foreach ($salaList as $key) { ?>
                                                <?php if ($Cine->getID()== $key->getCine()->getID()) {?>
                                                  <option value="<?php echo $key->getId(); ?>">
                                                      <?php echo $key->getNombre(); ?>
                                                  </option>
                                             <?php } }?>
                                            </select>
                                        </div>
                           
                                        <div class="form-group">
                                            <label>Fecha</label>
                                            <input type="date" class="form-control" id="date" min="<?php echo date("Y-m-d");?>"  name="fecha" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Horario</label>
                                            <input type="time" class="form-control" name="hora" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="boton_cancelar" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="boton_modificar">Agregar</button>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </td>

    <!----------------------- BOTON VER FUNCIONES  -------------------------------------->
                            <td style="vertical-align:middle;">

                                <button type="button" class="boton_modificar" data-toggle="modal" data-target="#verFuncionModal<?php echo $Cine->getID();?>" data-whatever="@mdo">Ver Funciones</button>
                                <div class="modal fade " style="background: rgba(0,0,0,.6);"id="verFuncionModal<?php echo $Cine->getID();?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content" >
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="verFuncionModal">Funciones</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                      <form method="post" action="<?= ROOT_VIEW ?>/Funcion/deleteFunction">

                                        <div class="form-group">
                                            <label>Cine</label>
                                            <input type="hidden" class="form-control" name="cine" maxlength="30" value="<?php echo $Cine->getID();?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Funciones</label>
                                            <select name="peliculaYcine">
                                                <option disabled selected>Lista de Funciones</option>
                                                <?php foreach ($functionList as $funct) { ?>
                                                    <?php if ($Cine->getID() == $funct->getSala()->getCine()->getID() ){ ?>

                                                    <option  name="funcion" value="<?php echo $funct->getIdPelicula()->getId_api();?>"> <!-- paso el id de la api por parametro-->
                                                        <?php echo $funct->getIdPelicula()->getNombre().' - '. $funct->getDia().' - '.$funct->getHorario(); ?>
                                                    </option>
                                                    
                                                <?php } } //fin if y foreach ?>
                                                
                                                
                                            </select>   
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="boton_cancelar" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="boton_eliminar">Eliminar Funcion</button>
                                        </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </td>
                            

                <!--------------- BOTON MODIFICAR CINE ------------------------------>
                            <td style="vertical-align:middle;">

                                <button type="button" class="boton_modificar" data-toggle="modal" data-target="#ModifyModal<?php echo $Cine->getID();?>" data-whatever="@mdo">Modificar Cine</button>
                                <div class="modal fade" style="background: rgba(0,0,0,.6);" id="ModifyModal<?php echo $Cine->getID();?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="ModifyModalLabel">Modificar Cine</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <form method="post" action="<?= ROOT_VIEW ?>/Cine/modifyCine">

                                          <div class="modal-body">
                                            <div class="form-group">
                                                <label>Estado </label>
                                                <select name="habilitado">
                                                    <option value="1" name="habilitado"<?php if ($Cine->getHabilitado()==true){?> selected <?php }?> >Habilitado</option>
                                                    <option value="0" name="habilitado"<?php if ($Cine->getHabilitado()==false){?> selected <?php }?> >Deshabilitado</option>
                                                </select>   
                                            </div>
                                            <div class="form-group">
                                                <label>Nombre del Cine</label>
                                                <input type="text" class="form-control" name="cine" maxlength="30" value="<?php echo $Cine->getNombre();?>" required/>
                                            </div>
                                            <div class="form-group">
                                                <label>Direccion</label>
                                                <input type="text" class="form-control" name="direccion" maxlength="30" value="<?php echo $Cine->getDireccion();?>" required>
                                            </div>
                                           </div>
                                            <div class="modal-footer">
                                                <button type="button" class="boton_cancelar" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="boton_modificar">Modificar</button>
                                            </div>

                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </td>
                            
            <!----------------------- BOTON ELIMINAR CINE Y CONFIRMACION------------------------------->
                            <td style="vertical-align:middle;">
                                <form method="post" id="eliminar" action="<?= ROOT_VIEW ?>/Cine/deleteCine">
                                    <button name="eliminar" value="<?php echo $Cine->getID();?>" class="boton_eliminar">Eliminar</button>     
                                </form>
                            </td>
                        </tr>
                            <?php } }//fin if y fin foreach ?>          
                    </tbody>
                </table>

<!----------------   Boton Añadir Cines   ------------------->
                
<button type="button" class="boton_cancelar" data-toggle="modal" data-target="#AddCineModal" data-whatever="@mdo">Añadir cine</button>

<div class="modal fade" style="background: rgba(0,0,0,.6);" id="AddCineModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AddCineModalLabel">Añadir cine</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="<?= ROOT_VIEW ?>/Cine/newCine">
                     

                    <div class="form-group">
                        <label>Nombre del Cine</label>
                        <input type="text" class="form-control" maxlength="30"name="cine" required/>
                    </div>

                    <div class="form-group">
                        <label>Direccion</label>
                        <input type="text" class="form-control" name="direccion" maxlength="30" required>
                    </div>


                    
      


                </div>

                <div class="modal-footer">
                    <button type="button" class="boton_cancelar" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="boton_modificar">Agregar Cine</button>
        </form>
      </div>
    </div>
  </div>
</div>

                           <!--------  Fin Boton Añadir Cines   ----------->
                </div>
            </form>
            
            </div>

            <!-- Esto como si no existiera -->
            <?php if(isset($successMje) || isset($errorMje)) { ?>
                <div class="alert <?php if(isset($successMje)) echo 'alert-success'; else echo 'alert-danger'; ?> alert-dismissible fade show mt-3" role="alert">
                    <strong><?php if(isset($successMje)) echo $successMje; else echo $errorMje; ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>
        </div>
        
    </main>
        
    
    
    

    <!--
        CREATE POSTS
    -->
    <style>
        .box_transparente{
            box-shadow:0 5px 5px 3px rgba(0, 0, 0, 0.5);
        }
        .table_transparente{
            background-color: rgba(255, 255, 255,.9)
        }
        .box_titulo{
            background-color: rgba(52, 189, 235,.7)
        }
        .fondo_home_adm{
            
            background:url(/MoviePass/images/fondo_body5.jpg);
        }
        .tdCentrado{
            padding: 5px;
        }

        .boton_cancelar{
            text-decoration: none;
            padding: 5px;
            padding-left: 10px;
            padding-right: 10px;
            font-family: helvetica;
            font-weight: 300;
            font-size: 15px;
            font-style: bold;
            color: #ECEEF4;
            background-color: #BDB7B7;
            border-radius: 15px;
            border: 3px double #000102  ;
            float: left;
        }
        .boton_cancelar:hover{
            color: #1883ba;
            background-color: #ffffff;
        }
        .boton_modificar{
            text-decoration: none;
            padding: 5px;
            padding-left: 10px;
            padding-right: 10px;
            font-family: helvetica;
            font-weight: 300;
            font-size: 15px;
            font-style: bold;
            color: #ECEEF4;
            background-color:#376AE8;
            border-radius: 15px;
            border: 3px double #000102  ;
        }
        .boton_modificar:hover{
            color: #1883ba;
            background-color: #ffffff;
        }
        .boton_eliminar{
            text-decoration: none;
            padding: 5px;
            padding-left: 10px;
            padding-right: 10px;
            font-family: helvetica;
            font-weight: 300;
            font-size: 15px;
            font-style: bold;
            color: #ECEEF4;
            background-color:#F00606;
            border-radius: 15px;
            border: 3px double #000102  ;
        }
        .boton_eliminar:hover{
            color: #1883ba;
            background-color: #ffffff;
        }



        }
        .modal-backdrop {
          display: none;
        }

        
        

    </style>


    <script >
        n =  new Date();
        y = n.getFullYear();
        m = n.getMonth() + 1;
        d = n.getDate();
        document.getElementById("date").innerHTML = d + "/" + m + "/" + y;
    </script>

    <script>
        $(document).ready(function(){
      $('#contact-form').on('submit',function(e) {  //Don't foget to change the id form
      $.ajax({
          url:'contact.php', //===PHP file name====
          data:$(this).serialize(),
          type:'POST',
          success:function(data){
            console.log(data);
            //Success Message == 'Title', 'Message body', Last one leave as it is
            swal("¡Success!", "Message sent!", "success");
          },
          error:function(data){
            //Error Message == 'Title', 'Message body', Last one leave as it is
            swal("Oops...", "Something went wrong :(", "error");
          }
        });
        e.preventDefault(); //This is to Avoid Page Refresh and Fire the Event "Click"
      });
    });

    </script>
  
  <style>
    .swal-button--confirm {
      background-color: #DD6B55;
    }
  </style>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="<?php echo "JS_PATH" ?>/sweetalert.min.js" type="javascript"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</body>
    



</html>
