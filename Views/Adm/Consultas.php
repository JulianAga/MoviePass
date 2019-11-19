<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title></title>

</head> 
<body>
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
</body>