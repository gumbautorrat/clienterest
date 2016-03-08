<?php

class ClienteWSAutentication
{

    /***************************************************************

       Metodo que envia el identificador de agencia y el password 
       al Servicio Web de Autenticacion y devuelve el resultado.

    ****************************************************************/

    public function sendAutentication($user,$pass)
    {

        $data = array("user" => $user, "pass" => $pass);
        $ch = curl_init("http://localhost/apirest/control/");
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
    
}