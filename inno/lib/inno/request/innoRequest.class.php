<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');
/*
 *
 * @author:  Orlino L. Monares Jr. <anxietylost110987@gmail.com, orlino_monares110987@yahoo.com>
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

  protected $request_params = array();
  protected $request_method = self::NONE;
  
  public function isAjaxRequest()
  {
    return (array_key_exists('HTTP_X_REQUESTED_WITH', $_SERVER));
  }
  /*
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
  */
  public function setParams()
  {
    if($this->request_method == self::POST || $this->request_method == self::GET){
      
      if(isset($_SERVER['REDIRECT_URL']) || isset($_SERVER['PATH_INFO'])) {
        if(isset($_SERVER['REDIRECT_URL']))
        {
          $vardata = explode('/', $_SERVER['REDIRECT_URL']);
#          echo '<span style="font-size:20px;color:red;">REDIRECT_URL:'.$_SERVER['REDIRECT_URL'].'</span>';
        }
        else
        {
          $vardata = explode('/', $_SERVER['PATH_INFO']);
#          echo '<span style="font-size:20px;color:red;">PATH_INFO:'.$_SERVER['PATH_INFO'].'</span>';
        }
        $num_param = count($vardata);
        unset($vardata[0]);
        
        if(count($vardata) != 1 || $vardata[1] != '')
        {
        
            /*
          if($num_param % 2 == 0) {
            $vardata[] = '';
            $num_param++;
          }
          $start = 1;
          if(isset($_SERVER['REDIRECT_URL']))
          {
            if(strpos($_SERVER['REDIRECT_URL'], '.php') === false)
            {
              $start = 2;
            }
            //$this->request_params['module'] = (($this->request_params['module'] != '') ? $vardata : 'homepage' );
          }
          else
            //$this->request_params['module'] = (($this->request_params['module'] != '') ? $vardata[1] : 'homepage' );
          */
          $head = true;
          $first_loop = true;
          $second_loop = false;
          $head_key = '';
          foreach($vardata as $value)
          {
            /*
            if($initial_loop)
            {
              if(isset($_SERVER['REDIRECT_URL']) && strpos($_SERVER['REDIRECT_URL'], '.php') === false)
              {
                $start = 2;
              }
              $this->request_params['module'] = $value;
              $initial_loop = !$initial_loop;
            }
            else
            */
            if($first_loop)
            {
              $first_loop = !$first_loop;
              $second_loop = !$second_loop;
            }
            else if($second_loop)
            {
              $second_loop = !$second_loop;
            }
            else
            {
              if($head)
              {
                $head_key = $value;
                $head = !$head;
              }
              else
              {
                $this->request_params[$head_key] = $value;
                $head = !$head;
              }
            }
          }
        }

//        for($i = 2; $i < $num_param; $i += 2) 
//          $this->request_params[$vardata[$i]] = $vardata[$i+1];
      }
      
      if(isset($_SERVER['QUERY_STRING']))
      {
        $request_uri = explode('&', $_SERVER['QUERY_STRING']);
        foreach($request_uri as $request)
        {
          $params = explode('=', $request);
          $this->request_params[$params[0]] = $params[1];
        }
      }
      
      if ($this->request_method == self::POST)
      {
        echo 'method is POST!!';
        var_dump($_POST);
        foreach($_POST as $param => $value)
        {
          $this->request_params[$param] = $value;
        }
      }
//      var_dump($this->request_params);
//      die();      
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
  
  public function getMethod()
  {
    return $this->request_method;
  }
  
  public function getAllParam()
  {
    return $this->request_params;
  }
  
  /* conventional forward to errors */
  public function forwardTo404()
  {
    throw new innoError404Exception('Error: Page Not Found', 1081404);
  }

  public function forwardTo403()
  {
    throw new innoError403Exception('Error: Page Access Forbidden', 1081403);
  }

  public function forwardTo401()
  {
    throw new innoError401Exception('Error: Page Access Unauthorized', 1081401);
  }
  /* conventional forward to errors */

  /* if conditions to forward to error */
  public function forwardTo404If($cond)
  {
    if($cond)
      throw new innoError404Exception('Error: Page Not Found', 1082404);
  }

  public function forwardTo403If($cond)
  {
    if($cond)
      throw new innoError403Exception('Error: Page Access Forbidden', 1082403);
  }

  public function forwardTo401If($cond)
  {
    if($cond)
      throw new innoError403Exception('Error: Page Access Forbidden', 1082403);
  }
  /* if conditions to forward to error */

  /* unless conditions to forward to error */
  public function forwardTo404Unless($cond)
  {
    if(!$cond)
      throw new innoError404Exception('Error: Page Not Found', 1083404);
  }

  public function forwardTo403Unless($cond)
  {
    if(!$cond)
      throw new innoError403Exception('Error: Page Access Forbidden', 1083403);
  }

  public function innoforwardTo401Unless($cond)
  {
    if(!$cond)
      throw new innoError403Exception('Error: Page Access Forbidden', 1083403);
  }
  /* unless conditions to forward to error */
}

