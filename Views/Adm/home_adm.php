
<?php 


use Repository\PostsRepository as PostsRepository;
use models\Cine as Cine;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title></title>


<link rel="stylesheet" href="/MoviePass/Views/css/header2.css"><!-- ARCHIVO CSS-->

<!-- ESTA LIBRERIA DE BOOSTRAP LA COMENTE PORQE AFECTA A LA BARRA DE NAVEGACION PRINCIPAL
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
-->



</head> 

<body>
    <header>
        <?php include_once("header_adm.php"); ?> <!-- llamado a la barra nav de home-->
    </header>
    
    <main class="p-5">
        <div class="container position-relative align-middle">

        
        <h1 style="background-color: rgba(52, 189, 235,.7)">CINEMAS</h1>
            
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Cine</th>
                            <th>Direccion</th>
                            <th>Capacidad</th>
                            <th>Valor de entrada</th>
                            <th>Agregar Pelicula</th>
                            <th>Modificar</th>
                            <th>Eliminar</th>

                        </tr>
                    </thead>
                    <tbody>
                    <?php
                               $cines = new PostsRepository();
                            //$categories = new CategoriesRepository();
                            $productsArray = $cines->getAll(); ?>

                                <?php foreach ($productsArray as $key => $value)
                                {
                                $Cine = $value;
                                if($Cine->getHabilitado() == true)
                                {
                                    ?>


                            <tr>
                            <td><input type="checkbox" name="userschecked[]" /></td>
                                <td><?php  echo $Cine->getID(); ?></td>
                                    
                                <td><?php  echo $Cine->getNombre(); ?></td>
                                <td><?php  echo $Cine->getDireccion(); ?></td>
                                <td><?php  echo $Cine->getCapacidad(); ?></td>
                                <!--       <td><?php // echo $Post->getDate(); ?></td> -->
                                <td><?php  echo $Cine->getValor_entrada(); ?></td>
                                <td><button class="btn btn-dark">+</button></td>
                                <td>
                                    <!-- BOTON MODIFICAR CINE -->
                                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">*</button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Cine</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="<?= ROOT_VIEW ?>/Modify/modifyCine">
                     <div class="form-group">
                        <label>Id del Cine</label>
                        <input type="text" class="form-control" name="ID" value="<?php echo $Cine->getID();?>" readonly/>
                    </div>

                    <div class="form-group">
                        <label>Nombre del Cine</label>
                        <input type="text" class="form-control" name="cine" value="<?php echo $Cine->getNombre();?>" required/>
                    </div>

                    <div class="form-group">
                        <label>Direccion</label>
                        <input type="text" class="form-control" name="direccion" value="<?php echo $Cine->getDireccion();?>" required>
                    </div>

                    <div class="form-group">
                        <label>Valor de Entrada</label>
                        <input type="number" class="form-control" name="valor" value="<?php echo $Cine->getValor_entrada();?>" required>
                    </div>

                    <div class="form-group">
                        <label>Capacidad</label>
                        <input type="number" class="form-control" name="capacidad" value="<?php echo $Cine->getCapacidad();?>" required>
                    </div>
      

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-dark">Publicar</button>
        </form>
      </div>
    </div>
  </div>
</div></td>
                                <td><form action="<?= ROOT_VIEW ?>/Delete/deleteCine" method="post"><button class="btn btn-dark" name="eliminar" value="<?php echo $Cine->getID();?>">-</button></form></td>

                                
                            </tr>
                                <?php }} ?>

                                
                    </tbody>
                </table>

                           <!--   Boton Añadir Cines   -->
                
<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#MainModal" data-whatever="@mdo">Añadir cine</button>

<div class="modal fade" id="MainModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="MainModalLabel">Añadir cine</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="<?= ROOT_VIEW ?>/Publish/newCine">
                     <div class="form-group">
                        <label>Id del Cine</label>
                        <input type="text" class="form-control" name="ID" required>
                    </div>

                    <div class="form-group">
                        <label>Nombre del Cine</label>
                        <input type="text" class="form-control" name="cine" required/>
                    </div>

                    <div class="form-group">
                        <label>Direccion</label>
                        <input type="text" class="form-control" name="direccion" required>
                    </div>

                    <div class="form-group">
                        <label>Valor de Entrada</label>
                        <input type="number" class="form-control" name="valor" required>
                    </div>

                    <div class="form-group">
                        <label>Capacidad</label>
                        <input type="number" class="form-control" name="capacidad" required>
                    </div>
      

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-dark">Publicar</button>
        </form>
      </div>
    </div>
  </div>
</div>

                           <!--   Boton Añadir Cines   -->
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


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>
    



</html>
<?php //require(ROOT . "Vistas/footer.php"); ?>  