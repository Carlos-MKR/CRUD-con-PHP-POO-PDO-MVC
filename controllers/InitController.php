<?php

class InitController
{

    private $url = [];

    function __construct()
    {
        $this->init();
    }

    //metodos que queremos ejecutar consecutivamente
    private function init()
    {
        $this->init_load_config();
        $this->init_autoload();
        $this->RequestUrl();
    }
    // metodo para acargar la configuracion del sistema
    private function init_load_config()
    {
        $file = 'config.php';

        if (!is_file('config/' . $file)) {
            die('El archivo ' . $file . 'es requerido para que funcione');
        }

        require_once 'config/' . $file;
    }


    // metodo para cargar todos los archivos automaticamente
    private function init_autoload()
    {
        // Autocarga de clases
        spl_autoload_register(function ($className) {
            $modelFilePath = 'models/' . $className . '.php';
            $controllerFilePath = 'controllers/' . $className . '.php';

            if (file_exists($modelFilePath)) {
                require_once $modelFilePath;
            } elseif (file_exists($controllerFilePath)) {
                require_once $controllerFilePath;
            } else {
                throw new Exception("Clase '$className' no encontrada.");
            }
        });
    }

    private function RequestUrl()
    {
        // Obtener la ruta de la solicitud
        $url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '/read';
        $url = explode('/', $url);

        // Filtrar elementos vacíos (eliminar)
        $url = array_filter($url, 'strlen');
        // controlador por defecto
        $controllerName = 'UsersController';
        $methodName = isset($url[0]) ? $url[0] : 'read';

        // Verificar si el controlador y el método existen
        if (file_exists('controllers/' . $controllerName . '.php')) {
            $controller = new $controllerName();

            if (method_exists($controller, $methodName)) {
                unset($url[0]);
                $params = $url ? array_values($url) : [];
                call_user_func_array([$controller, $methodName], $params);
            } else {
                // serror 404 metodo no encontrado
                RenderController::render('error',[
                    'title' => 'Error 404 - Página no encontrada',
                    'type' => '404',
                    'text' => 'Lo sentimos, la página que estás buscando no se pudo encontrar.',
                    'btnText' => 'Volver a la página de inicio'
                ]);
            }
        } else {
            // controlador no encontrado
            RenderController::render('error',[
                'title' => 'Error 404 - Página no encontrada',
                'type' => '404',
                'text' => 'Lo sentimos, la página que estás buscando no se pudo encontrar.',
                'btnText' => 'Volver a la página de inicio'
            ]);
        }
    }

    /**
     * metodo para pasar controlador y accion
     * en caso de que se requiera su uso.
     */
     /*private function RequestUrl()
    {
        // Obtener la ruta de la solicitud
        $url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'users/read';
        $url = explode('/', $url);

        // Obtener el controlador y el método
        $controllerName = ucfirst($url[0]) . 'Controller';
        $methodName = isset($url[1]) ? $url[1] : 'read';

        // Verificar si el controlador y el método existen
        if (file_exists('controllers/' . $controllerName . '.php')) {
            $controller = new $controllerName();

            if (method_exists($controller, $methodName)) {
                unset($url[0]);
                unset($url[1]);
                $params = $url ? array_values($url) : [];
                call_user_func_array([$controller, $methodName], $params);
            } else {
                require_once 'views/error.php'; // error 404 metodo no encontrado
            }
        } else {
            require_once 'views/error.php'; // controlador no encontrado
        }
    }*/
}
