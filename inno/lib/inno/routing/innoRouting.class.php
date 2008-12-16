<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');
/*
 * This file is a part of the inno package.
 * Copyright (C) 2008 Orlino L. Monares Jr. <anxietylost110987@gmail.com, orlino_monares110987@yahoo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
 * 
 *
 * @author:     Orlino L. Monares Jr. <anxietylost110987@gmail.com, orlino_monares110987@yahoo.com>
 * @package:    inno
 * @subpackage: routing.innoRouting
 *
 * @todo: _____________
 *
 */

class innoRouting
{
  protected $routes = array();
  protected $route_alias = '';
  protected $module_name = '';
  protected $action_name = '';
  // @todo: [DEPRECATED] to be deleted, check for code dependencies
  protected $route_base = '';
  
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
  
  public function getRouteAlias()
  {
    return $this->route_alias;
  }
  
  public function initializeRoute($url)
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
          if (isset($this->routes[$alias]['life']))
          {
            innoConfig::setFlushable('inno_routing_url_base', $this->routes[$alias]['url']);
            innoConfig::setFlushable('inno_routing_url_life', $this->routes[$alias]['life']);
          }
          break;
        }
        else if($this->routes[$alias]['url'].'/' == $url)
        { 
          $this->setModule($this->routes[$alias]['module']);
          $this->setAction($this->routes[$alias]['action']);
          $this->route_alias = $alias;
          if (isset($this->routes[$alias]['life']))
          {
            innoConfig::setFlushable('inno_routing_url_base', $this->routes[$alias]['url']);
            innoConfig::setFlushable('inno_routing_url_life', $this->routes[$alias]['life']);
          }
          break;
        }
      }
      else if(strpos($url, '.') !== false && $url == $this->routes[$alias]['url'].'.'.$this->routes[$alias]['suffix'])
      {
        $this->setModule($this->routes[$alias]['module']);
        $this->setAction($this->routes[$alias]['action']);
        if (isset($this->routes[$alias]['life']))
        {
          innoConfig::setFlushable('inno_routing_url_base', $this->routes[$alias]['url']);
          innoConfig::setFlushable('inno_routing_url_life', $this->routes[$alias]['life']);
        }
        $this->route_alias = $alias;
        break;
      }
    }
  }
  
  public function __construct($routes, $url)
  {
    $this->clearRoutes();
    $this->routes = $routes;
    $this->initializeRoute($url);
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

