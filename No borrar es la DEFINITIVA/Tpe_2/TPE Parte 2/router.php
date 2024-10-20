<?php
require_once './app/controllers/libros.controllers.php';
require_once './app/controllers/usuarios.controllers.php';
require_once './app/controllers/Auth.Controllers.php';
require_once './libs/response.php';
require_once './app/middlewares/session.auth.middlewares.php';
require_once './app/middlewares/verify.auth.middlewres.php';


define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res = new Response();

$action = 'home';
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {
    case 'login':
        $controller = new AuthControllers();
        $controller->login();
    break;
    
    case 'home':
        sessionAuthMiddleware($res);
        $controller = new libroscontrollers($res);
        $controller->showlibros();
        $controller = new usuarioscontrollers($res);
        $controller->showusuarios();
    break;
    
    case 'ver_mas_usuario':
        $controller = new usuarioscontrollers();
        $controller->showusuario($params[1]);
        break;
    
    case 'agregar_usuario':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new usuarioscontrollers($res);
        $controller->addusuario();
        break;
        
    case 'eliminar_usuario':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new usuarioscontrollers($res);
        $controller->deleteusuario($params[1]);
        break;
    
    case 'editar_usuario':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new usuarioscontrollers($res);
        $controller->editaruser($_POST['id']);
        break;

    case 'ver_mas_libro':  
        $controller = new libroscontrollers($res);
        $controller->showlibro($params[1]);
        break;
        
    case 'agregar_libro':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);    
        $controller = new libroscontrollers($res);
        $controller->addlibro();
        break;
            
    case 'eliminar_libro':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);    
        $controller = new libroscontrollers($res);
        $controller->deletelibro($params[1]);
        break;
        
    case 'editar_libro':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);    
        $controller = new libroscontrollers($res);
        $controller->editarlibro($_POST['id']);
        break;

    case 'logout':
        $controller = new AuthControllers();
        $controller->logout();
        break;

    case 'showLogin':
        $controller = new AuthControllers();
        $controller->login();
        break;

} 
?>