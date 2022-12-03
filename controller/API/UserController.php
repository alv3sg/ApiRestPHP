<?php
class UserController extends BaseController
{
    
    public function listAction()
    {
        $erroDescription = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];//metodo de requisição
        $stringParamsArray = $this->getStringParams();//chamando metodo da BaseController
 
        //Verificando se o metodo é GET/Funcao para por a string em maiuscula
        if (strtoupper($requestMethod) == 'GET') 
        {
            try {
                //classe que vem da UserModel.php
                $userModel = new UserModel();
 
                $intLimit = 10;
                //verificando se stringParams foi iniciado
                if (isset($stringParamsArray['limit']) && $stringParamsArray['limit']) {
                    $intLimit = $stringParamsArray['limit'];
                }
 
                //pegando os usuarios quem vem do UserModel.php
                $usersArray = $userModel->getUsers($intLimit);
                //retornando o array em json para o usuario
                $responseData = json_encode($usersArray);
            } catch (Error $e) {
                $erroDescription = $e->getMessage().'Something went wrong! Please contact support.';
                $errorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            //Se nao for metodo GET, é um erro de metodo nao suportado
            $erroDescription = 'Method not supported';
            $errorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
 
        // send output
        //Se nao tiver nada no erroDescription
        if (!$erroDescription) {
            $this->sendOutput(
                //passando os usuarios em json
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            //caso tenha dado erro
            $this->sendOutput(json_encode(array('error' => $erroDescription)), 
                array('Content-Type: application/json', $errorHeader)
            );
        }
    }
}