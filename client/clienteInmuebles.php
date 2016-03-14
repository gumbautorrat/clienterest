<?php

require "clienteAuthAgencia.php";

class ClienteWSInmuebles
{

    private $auth; //objeto que hace las peticiones de autentificacion

    function ClienteWSInmuebles(){
        $this->auth = new ClienteWSAuthAgencia();
    }

    /***************************************************************

       Metodo solicita al Servicio Web todos los inmuebles que hay 
       en la BD. 

    ****************************************************************/
 
    public function sendGetAll()
    {

        $ch = curl_init("http://localhost/apirest/inmuebles");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $response = curl_exec($ch);
        curl_close($ch);

        if(!$response) 
        {
            return false;
        }
        else
        {
            return $response;
        }

    }

    /***************************************************************

       Metodo solicita al Servicio Web todos los inmuebles que hay 
       en la BD. 

    ****************************************************************/

    public function sendGetInmueblesCompartidos($agencia){

        $data = array("agencia" => $agencia);
        $ch = curl_init("http://localhost/apirest/inmuebles");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
        $response = curl_exec($ch);
        curl_close($ch);

        if(!$response) 
        {
            return false;
        }
        else
        {
            return $response;
        }

    }

    /***************************************************************

       Metodo que solicita al Servicio Web todos los inmuebles que 
       hay en la BD y nos devuelve una cadena con el resultado 
       parseado de JSON a una cadena.

    ****************************************************************/

    public function getAllParsed($user,$pass){

        $res = "";

        $resAutenticationJSON = $this->auth->sendAutentication($user, $pass);
        $resAutentication = json_decode($resAutenticationJSON);

        if(strcmp( $resAutentication->message , "Autentication Succesful" ) == 0){

          $inmueblesJSON = $this->sendGetAll();
          $inmuebles = json_decode($inmueblesJSON);

          $cadena = "";

          foreach ($inmuebles as $inmueble) {

            $cadena .= "Identificador  : ". $inmueble->id_inmueble."<br />".
                       "Dirección      : ". $inmueble->direccion."<br />".
                       "Localidad      : ". $inmueble->localidad."<br />".
                       "Provincia      : ". $inmueble->provincia."<br />".
                       "Compartir      : ". $inmueble->compartir."<br />".
                       "Id Agencia     : ". $inmueble->id_agencia."<br />".
                       "Id Propietario : ". $inmueble->id_propietario."<br />".
                       "<br />";

          }

          $res = $cadena;

        }else{
          $res = "Autentication Fail <br /><br />";
        }

        return $res;
    }

    /***************************************************************

       Metodo que solicita al Servicio Web todos los inmuebles tanto 
       de la agencia como los compartidos y nos devuelve una cadena 
       con el resultado parseado de JSON a una cadena. 

    ****************************************************************/

    public function getOwnParsed($user,$pass){

        $res = "";

        $resAutenticationJSON = $this->auth->sendAutentication($user, $pass);
        $resAutentication = json_decode($resAutenticationJSON);

        if(strcmp( $resAutentication->message , "Autentication Succesful" ) == 0){

          $inmueblesJSON = $this->sendGetInmueblesCompartidos($user);

          if(strstr($inmueblesJSON, "ERROR")){
            $res = "ERROR";
          }else{
            $inmuebles = json_decode($inmueblesJSON);

            $cadena = "";

            foreach ($inmuebles as $inmueble) {

                $cadena .= "Identificador  : ". $inmueble->id_inmueble."<br />".
                           "Dirección      : ". $inmueble->direccion."<br />".
                           "Localidad      : ". $inmueble->localidad."<br />".
                           "Provincia      : ". $inmueble->provincia."<br />".
                           "Compartir      : ". $inmueble->compartir."<br />".
                           "Id Agencia     : ". $inmueble->id_agencia."<br />".
                           "Id Propietario : ". $inmueble->id_propietario."<br />".
                           "<br />";

            }

            $res = $cadena;
          }

        }else{
          $res = "Autentication Fail <br /><br />";
        }

        return $res;
    }
    
}