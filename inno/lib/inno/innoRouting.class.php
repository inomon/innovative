<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');
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
  // @todo: [DEPRECATED] to be deleted
  protected $route_base = '';
  protected $route_alias = '';
  protected $module_name = '';
  protected $action_name = '';
  
  // mutators: module
  public function getModule()
  {
    return $this->module_name;
  }
  
  public function setModule($mod)
  {
    $this->module_name = $mod;
  }
  
  // mutators: action
  public function getAction()
  {
    return $this->action_name;
  }

  public function setAction($act)
  {
    $this->action_name = $act;
  }

  // mutators: route 
  // @todo: test for dependencies, [DEPRECATED]
  public static function setRoute($route)
  {
    return array_search($route, $this->routes);
  }
  
  
  // @todo: test for dependencies, [DEPRECATED]
  public function getRoute()
  {
    foreach($this->routes as $route)
    {
      if(!(strpos($url, $this->routes[$route]['url']) === false))
      {
        $this->setModule($this->routes[$route]['module']);
        $this->setAction($this->routes[$route]['action']);
      }
    }

    return $this->routes[$route];
  }
  
  public function getRouteAlias()
  {
    return $this->route_alias;
  }
  
  public function init($url)
  {
    foreach($this->routes as $alias => $details)
    {
      //if(!isset($this->routes[$alias]['suffix']))
      if(strpos($url, '.') === false && !isset($this->routes[$alias]['suffix']))
      {
        if($this->routes[$alias]['url'] == $url)
        {
          $this->setModule($this->routes[$alias]['module']);
          $this->setAction($this->routes[$alias]['action']);
          $this->route_alias = $alias;
          break;
        }
        else if($this->routes[$alias]['url'].'/' == $url)
        { 
          $this->setModule($this->routes[$alias]['module']);
          $this->setAction($this->routes[$alias]['action']);
          $this->route_alias = $alias;
          break;
        }
      }
      else if(strpos($url, '.') !== false && $url == $this->routes[$alias]['url'].'.'.$this->routes[$alias]['suffix'])
      {
        $this->setModule($this->routes[$alias]['module']);
        $this->setAction($this->routes[$alias]['action']);
        $this->route_alias = $alias;
        break;
      }
    }
  }
  
  public function __construct($routes, $url)
  {
    $this->clearRoutes();
    $this->routes = $routes;
    $this->init($url);
  }
  
  public function clearRoutes()
  {
    $this->routes = null;
    $this->routes = array();
  }
  
  // @todo: test for dependencies, [DEPRECATED]
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
  
  public function getRoutes()
  {
    return $this->routes;
  }
  
  
}

