<?php

namespace App\Router;

class Route 
{

    private $path;
    private $name;

    /**
     * @param string $path The path of the route
     * @param string $name The name of the route
     */
    public function __construct(string $path = null, string $name = null) {
        if($path !== null && $name !== null) {
            $this->path = $path;
            $this->name = $name;
        }
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath(string $path)
    {
        $this->path = $path;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }
}