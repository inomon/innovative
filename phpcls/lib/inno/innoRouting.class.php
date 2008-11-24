<?php
/*
 *
 * @author:  Orlino L. Monares Jr. <ino@ooip.nl, ino@atissoftware.com, orlino_monares110987@yahoo.com>
 *
 * @package:
 * @subpackage:
 *
 * @todo: _____________
 *
 */
//require_once();

class innoRouting
{
  protected $routes = array();
  protected $route_base = '';
  
  public static function setRoute($route)
  {
    return array_search($route, $this->routes);
  }
  
  public function getRouteBase()
  {
    return $this->route_base;
  }
  
  public function __construct($routes)
  {
    $this->clearRoutes();
    $this->routes = $routes;
  }

  public function clearRoutes()
  {
    $this->routes = null;
    $this->routes = array();
  }
  
  public function route($route, $error404 = 'default')
  {
    if (array_key_exists($route, $this->routes))
    {
      $this->route_base = $route;
      return $this->getRoute($route);
    }
    else
    {
      return $error404.' error404';
    }
  }

  public function getRoute($route)
  {
    //$route = substr($route, 1);
    return $this->routes[$route];
  }
  
  public function getRoutes()
  {
    return $this->routes;
  }
  
  
}

