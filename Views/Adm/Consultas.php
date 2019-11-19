<?php ?>

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
<body class="fondo_home_adm">

    <form action="<?= ROOT_VIEW ?>/Adm_Peliculas/testCines"  method="post">
        
        <select name="idCinesI" id="idCinesI" >
            <option value="" selected hidden>Cines</option>
                <?php
                foreach($arrayCines as $c){?>
            <option value="<?php echo $c->getID();?>"><?php echo $c->getNombre();?></option> 
                <?php } ?>              
        </select>
        
        <input type="date" class="form-control" placeholder="Desde" name="fechaIN" id=1 required="required">
        <input type="date" class="form-control" placeholder="Hasta" name="fechaOUT" id=1 required="required">
        <button type="submit" name="enviar" id="enviar">Consultar</button>
    
    </form>

    <form action="<?= ROOT_VIEW ?>/Adm_Peliculas/testPeliculas"  method="post">
        
        <select name="idPeliculaI" id="idPeliculaI" >
            <option value="" selected hidden>Peliculas</option>
                <?php
                foreach($arrayPeliculas as $p){?>
            <option value="<?php echo $p->getId_api();?>"><?php echo $p->getNombre();?></option> 
                <?php } ?>              
        </select>
        
        <input type="date" class="form-control" placeholder="Desde" name="fechaIN" id=1 required="required">
        <input type="date" class="form-control" placeholder="Hasta" name="fechaOUT" id=1 required="required">
        <button type="submit" name="enviar" id="enviar">Consultar</button>
    
    </form>
    <label>VALOR<label>
    <?php if(isset($valor)){ ?>
        
        <label><?php echo $valor?><label>
    <?php }?>
    <style>
        body{
            color:white;
        }
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
