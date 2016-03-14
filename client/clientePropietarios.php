<?php

require "clienteAuthAgencia.php";

class ClienteWSPropietarios
{

    private $auth; //objeto que hace las peticiones de autentificacion

    function ClienteWSPropietarios(){
        $this->auth = new ClienteWSAuthAgencia();
    }

    /***************************************************************

       Metodo que solicita al Servicio Web todos los propietarios de 
       la agencia. 

    ****************************************************************/
    
    public function sendGetById($agencia)
    {
        $ch = curl_init("http://localhost/apirest/propietarios_agencia/$agencia");
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

       Metodo que solicita al Servicio Web todos los propietarios
       de la agencia y nos devuelve una cadena con el resultado 
       parseado de JSON a una cadena. . 

    ****************************************************************/

    public function getAllParsed($user, $pass){

        $res = "";

        $resAutenticationJSON = $this->auth->sendAutentication($user, $pass);
        $resAutentication = json_decode($resAutenticationJSON);

        if(strcmp( $resAutentication->message , "Autentication Succesful" ) == 0){

          $propietariosJSON = $this->sendGetById($user);
          $propietarios = json_decode($propietariosJSON);

          $cadena = "";

          foreach ($propietarios as $propietario) {

            $cadena .= "Id :".                $propietario->id_propietario."<br />".
                       "Dni : ".              $propietario->dni."<br />".
                       "Nombre : ".           $propietario->nombre."<br />".
                       "Primer apellido : ".  $propietario->primer_apellido."<br />".
                       "Segundo apellido : ". $propietario->segundo_apellido."<br />".
                       "Dirección : ".        $propietario->direccion."<br />".
                       "Localidad : ".        $propietario->localidad."<br />".
                       "Provincia : ".        $propietario->provincia."<br />".
                       "Telefono : ".         $propietario->telefono."<br />".
                       "Email : ".            $propietario->email."<br />".
                       "<br />";

          }

          $res = $cadena;

        }else{
          $res = "Autentication Fail <br /><br />";
        }

        return $res;
    }

}