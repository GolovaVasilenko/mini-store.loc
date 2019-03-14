<?php

namespace Core\Components\Router;


class Router
{
    protected static $routes = [];
    protected static $currentRoute = [];
    protected static $currentPath = "";

    public static function add($regexp, $route =[])
    {
        self::$routes[$regexp] = $route;
    }

    protected static function matchRoute($uri)
    {

        foreach(self::$routes as $pattern => $route){

            if(preg_match("~$pattern~i", $uri, $matches)){

                self::$currentPath = $matches[0];
                foreach($matches as $k => $v) {
                    if (is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                if(!isset($route['action'])){
                    $route['action'] = 'index';
                }
                self::$currentRoute = $route;
                return true;
            }
        }
        return false;
    }

    public static function dispatch($request, $response)
    {

        if(self::matchRoute($request->getUriString())){

            $controller = self::initController($request);

            if(class_exists($controller)){
                $ctrlObj = new $controller(self::$currentRoute);
                $action = self::lowerCamelCase(self::$currentRoute['action']) . 'Action';

                if(method_exists($ctrlObj, $action)){
                    if(isset(self::$currentRoute['id'])){
                        $ctrlObj->$action(self::$currentRoute['id']);
                    }
                    else if(isset(self::$currentRoute['slug'])){
                        $ctrlObj->$action(self::$currentRoute['slug']);
                    }
                    else {
                        $content = $ctrlObj->$action();
                    }
                    //return call_user_func_array($ctrlObj, $action, $args = []);
                }else{
                    $content = "Action $controller::$action Not found";
                }
            }else{
                $content = "Controller $controller Not found";
            }
        }else{
            http_response_code(404);
            $content = "Page Not found Error 404";
        }

        $response->setStatusCode(http_response_code());
        $response->setContent($content);
        echo $response->getBody();
    }

    private static function initController($request)
    {
        if($request->getMethod() !== self::$currentRoute['method']) {
            throw new \Exception("Wrong method for callable controller");
        }

        $controller = "\Modules\\" . self::$currentRoute['module'] . "\Controllers\\";

        $controller .= self::upperCamelCase(self::$currentRoute['controller'] . "Controller");

        return $controller;
    }

    protected static function upperCamelCase($className)
    {
        return str_replace(' ', '', $className = ucwords(str_replace('-', ' ', $className)));
    }

    protected static function lowerCamelCase($name)
    {
        return lcfirst(self::upperCamelCase($name));
    }

    public static function getRoutes()
    {
        return self::$routes;
    }

    public static function getPath()
    {
        return self::$currentPath;
    }

    public static function getRoute()
    {
        return self::$currentRoute;
    }
}