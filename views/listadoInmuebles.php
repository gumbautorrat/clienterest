<?php

header('Content-Type: text/html; charset=utf-8');
require "../conf/appConf.php";
require "../client/clienteInmuebles.php";

$res = "";

if(isset($_POST["option"])){ 
  $option = $_POST["option"]; 
}

if(isset($option)){

  if($option == "getAllInm"){

    $curl = new ClienteWSInmuebles();
    $res = $curl->getAllParsed(AGENCY_USER,AGENCY_PASS);

  }else if($option == "getOwnInm"){

    $curl = new ClienteWSInmuebles();
    $res = $curl->getOwnParsed(AGENCY_USER,AGENCY_PASS);
    
  }

}

?>

<!DOCTYPE HTML>
<html>

  <head>
    <meta charset="UTF-8">
  </head>

  <body>

    <h1>CLIENTE WEB SERVICE</h1>

    <hr>

    <form method="post" action="">
      <input name="option" type="hidden" value="getAllInm">
      Ver Inmuebles BD <input type="submit" value="Aceptar">
    </form>

    <?php if(isset($option) && $option == "getAllInm"){ echo "<br />".$res; } ?>
    
    <hr>

    <form method="post" action="">
      <input name="option" type="hidden" value="getOwnInm">
      Ver Inmuebles Propios y Compartidos <input type="submit" value="Aceptar">
    </form>
    
    <?php if(isset($option) && $option == "getOwnInm"){ echo "<br />".$res; } ?>

    <hr>

  </body>

</html>