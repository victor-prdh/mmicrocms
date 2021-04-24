<?php

namespace App\Router;

use App\Router\Route;

class Router 
{
    private $routes = [];

    /**
     * @param array $routes Table of all routes.
     */
    public function __construct(array $routes = null) 
    {
        if($routes == null) {
            throw new \Exception("Pas de routes définie", 1);
            
        } else {
            foreach($routes as $route){
                $path = $route[0];
                $name = $route[1];
                $r = new Route(strval($path), strval($name));
                array_push($this->routes, $r);
            }
        }
    }

    /**
     * @return array Return array of all routes
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function match()
    {
        $routes = $this->routes;

        //transform url string into clean array
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('/', $url);
        unset($url[0]);


        foreach($routes as $route) {
            $pathVar = false;
            //check if path have a variable
            $path = explode('/',$route->getPath() );
            unset($path[0]);
            
            foreach($path as $p){
                if(!empty($p[0])){
                    if($p[0] == ":"){ //path have a variable
                        $pathVar = true;
                        $varName = substr($p, 1);
                    } 
                }
                
            }

            if($pathVar == false) { //No path Variable => simple check
                if($url == $path) {
                    return 'match with '.$route->getName();
                }
            } else { //have a path variable
                
                if(count($path) == count($url)){ //check if path and url have same size (same number of "/" )
                    $check=0;
                    $varPath = "";

                    for($i=1;$i<=count($url); $i++){

                        

                        if(($url[$i] == $path[$i])  || ($path[$i][0] == ":")){

                           $check++; 
                           if($path[$i][0] == ":"){
                               $varPath = $url[$i];
                           }
                        } else {
                            break;
                        }
                    }
                    echo $check;
                    if($check == count($path)){
                        return [
                            'match' => $route->getName(),
                            $varName => $varPath,
                            
                        ];
                    }
                }
            }
            

            
        }

        return '404 NOT FOUND';

    }

    public function getRouteByName(string $name = null)
    {
       if($name == null){
           return "Route can be null";
       }

       $routes = $this->routes;

       foreach($routes as $route) {
           if($route->getName() == $name) {
               return $route;
           }
       }

       return "No route found with this name";
    }

}