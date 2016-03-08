<?php

header('Content-Type: text/html; charset=utf-8');
include "../conf/appConf.php";
include "../client/clientePropietarios.php";

$res = "";

if(isset($_POST["option"])){ 
  $option = $_POST["option"]; 
}

if(isset($option)){

  if($option == "getAllProp"){

    $client = new ClienteWSPropietarios();
    $propietariosJSON = $client->getAllParsed($AGENCY_USER,$AGENCY_PASS);

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
    <input name="option" type="hidden" value="getAllProp">
    Ver Propietarios Agencia <input type="submit" value="Aceptar">
    </form>
    <?php if(isset($option) && $option == "getAllProp"){ echo "<br />".$propietariosJSON; } ?>

  </body>

</html>