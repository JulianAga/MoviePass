
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


<link rel="stylesheet" href="/MoviePass/Views/css/header2.css"><!-- ARCHIVO CSS-->

<!-- ESTA LIBRERIA DE BOOSTRAP LA COMENTE PORQE AFECTA A LA BARRA DE NAVEGACION PRINCIPAL
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
-->



</head> 

<body class="fondo_home_adm">
    <header>
        <?php include_once("header_adm.php"); ?> <!-- llamado a la barra nav de home-->
    </header>
        <main class="p-5">
        <div class="container position-relative align-middle">
        <h1 class="box_titulo box_transparente">CINES</h1>
                <table class="table box_transparente table_transparente">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Cine</th>
                            <th>Direccion</th>
                            <th>Capacidad</th>
                            <th>Valor de entrada</th>
                            <th>  </th>
                            <th>  </th>
                            <th>  </th>
                            <th>  </th>

                        </tr>
                    </thead>
                    <tbody>
                    <?php
                                ?>
                                <!-- $arrayCines viene desde el llamado de LoginController  -->
                               <?php if ($arrayCines != null){ ?>
                                    <?php foreach ($arrayCines as $key => $value)
                                    {
                                    $Cine = $value;
                                    
                                    ?>
                            <tr>
                                
                                <td style="vertical-align:middle;"></td>    
                                <td style="vertical-align:middle;"><?php  echo $Cine->getNombre(); ?></td>
                                <td style="vertical-align:middle;"><?php  echo $Cine->getDireccion(); ?></td>
                                <td style="vertical-align:middle;"> <?php  echo $Cine->getCapacidad(); ?></td>
                                <td style="vertical-align:middle;"><?php  echo $Cine->getValor_entrada(); ?></td>
<!---------------BOTON AGREGAR FUNCION ----------------------->
                           
                                <td style="vertical-align:middle;">
                                    <button type="button" class="boton_modificar" data-toggle="modal" data-target="#addMovie<?php echo $Cine->getID();?>" data-whatever="@mdo">Agregar Funcion</button>
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
                                                            
                                                            <select name="id_pelicula" class="form-control">
                                                                <option disabled>Seleccione Pelicula...
                                                                </option>
                                                                
                                                                    <?php foreach ($nowplaying->results as $key ) { ?>
                                                                        <option value="<?php echo $key->id; ?>" name="id_pelicula"> <?php echo $key->title ; ?>
                                                                            
                                                                        </option>
                                                                    <?php } ?>  
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Id del Cine</label>
                                                            <input type="text" class="form-control" name="id_cine" value="<?php echo $Cine->getID();?>" readonly/>
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
                                          <form method="post" action="<?= ROOT_VIEW ?>/Funcion/modifyFunction">

                                                        <div class="form-group">
                                                            <label>Cine</label>
                                                            <input type="text" class="form-control" name="cine" maxlength="30" value="<?php echo $Cine->getNombre();?>" readonly/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Funciones</label>
                                                            <select name="habilitado">
                                                                <option disabled selected>Lista de Funciones</option>
                                                                <?php foreach ($functionList as $funct) { ?>
                                                                    <?php if ($Cine->getID() == $funct->getIdCine()->getID() ){ ?>

                                                                    <option  name="funcion">
                                                                        <?php echo $funct->getIdPelicula()->getNombre().' - '. $funct->getDia().' - '.$funct->getHorario(); ?>
                                                                    </option>
                                                                    
                                                                <?php } } //fin if y foreach ?>
                                                                
                                                                
                                                            </select>   
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Valor de Entrada</label>
                                                            <input type="number" class="form-control" min="0" max="5000" name="valor" value="<?php echo $Cine->getValor_entrada();?>" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Horario</label>
                                                            <input type="time" class="form-control" min="1" name="capacidad" value="<?php echo $Cine->getCapacidad();?>" required>
                                                        </div>
                                          

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="boton_cancelar" data-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="boton_modificar">Modificar</button>

                                                        <form method="post" action="<?= ROOT_VIEW ?>/Funcion/deleteFunction">
                                                            <button type="submit" class="boton_eliminar">Eliminar Funcion</button>

                                                        </form>
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
                                          <div class="modal-body">
                                          <form method="post" action="<?= ROOT_VIEW ?>/Cine/modifyCine">
                                                         <div class="form-group">
                                                            <label>Id del Cine</label>
                                                            <input type="text" class="form-control" name="ID" value="<?php echo $Cine->getID();?>" readonly/>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Nombre del Cine</label>
                                                            <input type="text" class="form-control" name="cine" maxlength="30" value="<?php echo $Cine->getNombre();?>" required/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Estado </label>
                                                            <select name="habilitado">
                                                                <option value="1" name="habilitado"<?php if ($Cine->getHabilitado()==true){?> selected <?php }?> >Habilitado</option>
                                                                <option value="0" name="habilitado"<?php if ($Cine->getHabilitado()==false){?> selected <?php }?> >Deshabilitado</option>
                                                            </select>   
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Direccion</label>
                                                            <input type="text" class="form-control" name="direccion" maxlength="30" value="<?php echo $Cine->getDireccion();?>" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Valor de Entrada</label>
                                                            <input type="number" class="form-control" min="0" max="5000"name="valor" value="<?php echo $Cine->getValor_entrada();?>" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Capacidad</label>
                                                            <input type="number" class="form-control" min="1" max="1000"name="capacidad" value="<?php echo $Cine->getCapacidad();?>" required>
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
                                
                                <!-- BOTON ELIMINAR CINE Y CONFIRMACION-->
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

                    <div class="form-group">
                        <label>Valor de Entrada</label>
                        <input type="number" class="form-control" min="0" max="5000"name="valor" required>
                    </div>

                    <div class="form-group">
                        <label>Capacidad</label>
                        <input type="number" class="form-control" min="1" max="1000"name="capacidad" required>
                    </div>
      

                </div>

                <div class="modal-footer">
                    <button type="button" class="boton_cancelar" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="boton_modificar">Publicar</button>
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
<?php //require(ROOT . "Vistas/footer.php"); ?>  