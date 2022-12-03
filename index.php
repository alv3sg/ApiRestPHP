<?php
    require __DIR__ . "/Config/config.php";
    
    //Abaixo: Pegando url ex: localhost^:8080/api/v1/user/list?limit=10
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    
    $uri = explode( '/' , $uri);

    //Abaixo: Verificando se a url está correta
    if( (isset($uri[1]) && $uri[1] != "api") || (isset($uri[2]) && $uri[2] != "v1"))
    {
        header("HTTP/1.1 404 Not Found");
        exit();
    }else if ( (isset($uri[3]) && $uri[3] != "user") || !isset($uri[4]))
    {
        header("HTTP/1.1 404 Not Found");
        exit();
    }
   

    //Se estiver correto, o require  vai carregar o arquivo 
    require ROOT_PATH . "/Controller\API\UserController.php";
    

    //instacio esse objeto
    $user = new UserController();

    //chamo o metodo que vai ta no array4
    $methodName = $uri[4] . 'Action';
    print_r($methodName);
    exit();
    $user->{$methodName};
?>