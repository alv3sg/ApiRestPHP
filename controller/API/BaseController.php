<?php
class BaseController
{
    //Metodo para retornar um erro caso seja chamado algum metodo que nao existe
    public function __call($name, $arguments) 
    {
        $this->sendOutput("", array("HTTP/1.1 404 Not Found"));
    }

    //array que retorna o limit=1 que vem na url
    protected  function getStringParams() : array
    {
        parse_str($_SERVER["QUERY_STRING"],$query);
        return $query;
    }

    
    //retorna os dados da API para o usuario
    protected function sendOutput($data, $httpHeaders=array())
    {
        header_remove("Set-Cookie");

        if (is_array($httpHeaders) && count($httpHeaders)){
            foreach ($httpHeaders as $httpHeader){
                header($httpHeader);
            }
        }

        echo $data;
        exit();
    }

}