<?php

header('Content-Type: text/html; charset=utf-8');
include "../conf/appConf.php";
include "../client/clienteAuthAgencia.php";

if(isset($_POST["option"])){ 
  $option = $_POST["option"];
  $pass = $_POST["pass"];
}

if(isset($option)){

  if($option == "resAuth"){

    $client = new ClienteWSAuthAgencia();
    $resAuthJSON = $client->sendAutentication(AGENCY_USER,$pass);

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
    <h3>Control Comerciales</h3>

    <form method="post" action="">
    <input name="option" type="hidden" value="resAuth">
    Pass Comercial : <input type="text" name="pass">
    <input type="submit" value="Aceptar">
    </form>

    <?php if(isset($option) && $option == "resAuth"){ 
         $res = json_decode($resAuthJSON);
         echo "<br/> Resultado : ".$res->message;
    } ?>

  </body>

</html>