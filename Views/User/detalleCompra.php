<?php 




?>

<!DOCTYPE html>
<html>
<head>
	<title>MoviePass</title>
</head>
<body>
	<header>
        <?php require(VIEWS_PATH."header.php"); ?> <!-- llamado a la barra nav de home-->
    </header>
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
       $msj2=$_SESSION['BD']; ?>
      
        <script> sweetAlert("Error en BD", "<?php echo $msj2; ?>", "error")</script>
        <?php unset($_SESSION["BD"]);?>
    <?php } ?>
    <!-------------------------------------- - ------------------------------>
    

</body>
</html>