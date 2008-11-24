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

class innoRequest
{
  const GET    = 2;
  const NONE   = 1;
  const POST   = 4;
  const PUT    = 5;
  const DELETE = 6;
  const HEAD   = 7;

  protected $module_name = '';
  protected $action_name = '';
  protected $request_params = array();
  protected $request_method = self::NONE;
  
  public function isAjaxRequest()
  {
    return (array_key_exists('HTTP_X_REQUESTED_WITH', $_SERVER));
  }
  
  public function setModule($mod)
  {
    $this->module_name = $mod;
  }
    public function setAction($act)
  {
    $this->action_name = $act;
  }
  public function getModule()
  {
    return $this->module_name;
  }
  
  public function getAction()
  {
    return $this->action_name;
  }
  
  public function getParams()
  {
    if($this->request_method == self::POST)
      return $this->request_params;
    else if ($this->request_method == self::GET)
      return $this->request_params;
    else if ($this->request_method == self::PUT)
      return 'put';
    else if ($this->request_method == self::DELETE)
      return 'delete';
    else if ($this->request_method == self::HEAD)
      return 'head';
    else
      return 'none';
  }
  
  public function setParams()
  {
    if($this->request_method == self::POST){
      $request_uri = explode('&', substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], '?')+1, strlen($_SERVER['REQUEST_URI'])));
      foreach($request_uri as $request)
      {
        $params = explode('=', $request);
        $this->request_params[$params[0]] = $params[1];
      }
      return true;
    }else if ($this->request_method == self::GET){
      /*
      if(isset($_SERVER['PATH_INFO'])) {
        $vardata = explode('/', $_SERVER['PATH_INFO']);
        $num_param = count($vardata);
        if($num_param % 2 == 0) {
          $vardata[] = '';
          $num_param++;
        }

        for($i = 1; $i < $num_param; $i += 2) 
          $this->request_params[$$vardata[$i]] = $vardata[$i+1];
          //$$vardata[$i] = $vardata[$i+1];
        
      }
      */
      $request_uri = explode('&', substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], '?')+1, strlen($_SERVER['REQUEST_URI'])));
      foreach($request_uri as $request)
      {
        $params = explode('=', $request);
        $this->request_params[$params[0]] = $params[1];
      }
      return true;
    }else if ($this->request_method == self::PUT){
      return false;
    }else if ($this->request_method == self::DELETE){
      return false;
    }else if ($this->request_method == self::HEAD){
      return false;
    }else{
      return false;
    }
  }
  
  public function getParam($param, $default = null)
  {
    if($this->request_method == self::POST){
      return $this->request_params[$param];
    }else if ($this->request_method == self::GET){
      return $this->request_params[$param];
    }else if ($this->request_method == self::PUT){
      return $default;
    }else if ($this->request_method == self::DELETE){
      return $default;
    }else if ($this->request_method == self::HEAD){
      return $default;
    }else{
      return $default;
    }
  }

  public function getRoute($router_name, $default_route = 'homepage')
  {
    if(!array_key_exists($router_name, $this->request_params))
      return $default_route;
      
    return $this->request_params[$router_name];
  }
  
  public function hasParam($param)
  {
    if ($_POST[$param])
    {
      return true;
    }
    else if ($_GET[$param])
    {
      return true;
    }
    else 
    {
      return false;
    }
  }
  
  public function __construct()
  {
    $this->setMethod();
    $this->setParams();
  }
  
  public function setMethod()
  {
    switch ($_SERVER['REQUEST_METHOD'])
    {
      case 'GET':
        $this->request_method = self::GET;
        break;
      case 'POST':
        $this->request_method = self::POST;
        break;
      case 'PUT':
        $this->request_method = self::PUT;
        break;
      case 'DELETE':
        $this->request_method = self::DELETE;
        break;
      case 'HEAD':
        $this->request_method = self::HEAD;
        break;
      default:
        $this->request_method = self::NONE;
        break;
    }
    
    return;
  }

  public function forwardTo($module, $action)
  {
    load_action($module, $action);
    
    return;
  }

  public function forwardTo404If($cond = false)
  {
    if($cond)
      header('Location: ?go=error404');
  }

  public function forwardTo404()
  {
    header('Location: ?go=error404');
  }

  public function forwardToSecure()
  {
    header('Location: ?go=secure');
  }
  
  public function getMethod()
  {
    return $this->request_method;
  }

}

