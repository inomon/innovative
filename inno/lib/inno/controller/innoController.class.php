<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');
/*
 * class: innoController
 *
 * @author:     Orlino L. Monares Jr. <anxietylost110987@gmail.com, orlino_monares110987@yahoo.com>
 * @package:    inno
 * @subpackage: controller
 *
 * @todo: _____________
 *
 */

class innoController
{
  protected $status = 'uninitialized';
  protected $inno_layout = 'layout';
  protected static $inno_cache = 'uninitialized';
  protected static $inno_request = 'uninitialized';
  protected static $inno_routing = 'uninitialized';
  
  // @todo: determine initialization variables needed by this controller
  public function __construct()
  {
    
  }
  
  // @todo: determine garbage that will be used/dump by this controller
  public function __destruct()
  {
    
  }

  public function __toString()
  {
    return $this->status;
  }

  public function setLayout($layout)
  {
    $this->inno_layout = $layout;
  }

  public function getLayout()
  {
    return $this->inno_layout;
  }
  
  /* mutators for objects used in the page */
  protected function getCache()
  {
    return self::$inno_cache;
  }
  
  public static function setCache($cache)
  {
    self::$inno_cache = clone $cache;
  }
  
  protected function getRequest()
  {
    return self::$inno_request;
  }
  
  public static function setRequest($request)
  {
    self::$inno_request = clone $request;
  }
  
  protected function getRouting()
  {
    return self::$inno_routing;
  }
  
  public static function setRouting($routing)
  {
    self::$inno_routing = clone $routing;
  }
  /* mutators for objects used in the page */
  
  /* redirection methods */
  public function redirect($url)
  {
    $this->getRequest()->redirect($url);
  }
  
  public function redirectIf($cond, $url)
  {
    $this->getRequest()->redirect($cond, $url);
  }
  
  public function redirectUnless($cond, $url)
  {
    $this->getRequest()->redirect($cond, $url);
  }
  /* request redirection methods */
  
  /* conventional forward to errors */
  public function forwardTo404()
  {
    $this->getRequest()->forwardTo404();
  }

  public function forwardTo403()
  {
    $this->getRequest()->forwardTo403();
  }

  public function forwardTo401()
  {
    $this->getRequest()->forwardTo401();
  }
  /* conventional forward to errors */

  /* if conditions to forward to error */
  public function forwardTo404If($cond)
  {
    $this->getRequest()->forwardTo404If($cond);
  }

  public function forwardTo403If($cond)
  {
    $this->getRequest()->forwardTo403If($cond);
  }

  public function forwardTo401If($cond)
  {
    $this->getRequest()->forwardTo401If($cond);
  }
  /* if conditions to forward to error */

  /* unless conditions to forward to error */
  public function forwardTo404Unless($cond)
  {
    $this->getRequest()->forwardTo404Unless($cond);
  }

  public function forwardTo403Unless($cond)
  {
    $this->getRequest()->forwardTo403Unless($cond);
  }

  public function forwardTo401Unless($cond)
  {
    $this->getRequest()->forwardTo401Unless($cond);
  }
  /* unless conditions to forward to error */
  
  /* skipping to action commands: basic, if & unless */
  public function skipAction($module, $action)
  {
    $this->getRouting()->setModule($module);
    $this->getRouting()->setAction($action);
    
    throw new innoSkipActionException('Skip action to; module:'.$module.' action:'.$action);
  }
  
  public function skipActionIf($cond, $module, $action)
  {
    if($cond)
    {
      $this->getRouting()->setModule($module);
      $this->getRouting()->setAction($action);
      
      throw new innoSkipActionException('Skip action to; module:'.$module.' action:'.$action);
    }
  }
  
  public function skipActionUnless($cond, $module, $action)
  {
    if(!$cond)
    {
      $this->getRouting()->setModule($module);
      $this->getRouting()->setAction($action);
      
      throw new innoSkipActionException('Skip action to; module:'.$module.' action:'.$action);
    }
  }
  /* skipping to action commands: basic, if & unless */
  
  public function run()
  {
    if ($this->getCache()->isTmpltCached())
    {
      echo $this->getCache()->loadTemplate();
      
      $this->getCache()->dumpConfig();
      return;
    }
    
    // set default layout
    $inno_template = 'template';
    $inno_forward_action = false;
    
    // wrap action execution in a loop to enable action skipping
    do
    {
      try
      {
        // get the action
        $inno_action = sprintf(innoDir::get('MODULE_ACTION'), $this->getRouting()->getModule()).$this->getRouting()->getAction().'.action.php';
        
        // include the module-action
        if (!file_exists($inno_action))
          throw new Error404Exception('Error: Page Not Found', 1081404);
        
        include_once($inno_action);
        $inno_forward_action = false;
      }
      catch(innoError404Exception $e)
      {
        $this->getRouting()->setModule('default');
        $this->getRouting()->setAction('error404');
        $inno_action = sprintf(innoDir::get('MODULE_ACTION'), $this->getRouting()->getModule()).'error404.action.php';
        include_once($inno_action);  
        $inno_forward_action = false;
      }
      catch(innoError403Exception $e)
      {
        $this->getRouting()->setModule('default');
        $this->getRouting()->setAction('error403');
        $inno_action = sprintf(innoDir::get('MODULE_ACTION'), $this->getRouting()->getModule()).'error403.action.php';
        include_once($inno_action);  
        $inno_forward_action = false;
      }
      catch(innoError401Exception $e)
      {
        $this->getRouting()->setModule('default');
        $this->getRouting()->setAction('error401');
        $inno_action = sprintf(innoDir::get('MODULE_ACTION'), $this->getRouting()->getModule()).'error401.action.php';
        include_once($inno_action);
        $inno_forward_action = false;
      }
      catch(innoSkipActionException $e)
      {
        $inno_forward_action = true;
      }
    } while($inno_forward_action);
    
    // use output buffer to get template contents
    // start output buffer
    ob_start();
    include_once(sprintf(innoDir::get('MODULE_TMPLT'), $this->getRouting()->getModule()).$this->getRouting()->getAction().'.tmplt.php');
    $inno_template = ob_get_contents();
    ob_end_clean();
    // end output buffer
    
    // set template contents
    innoRenderer::setTemplate($inno_template);
    
    if(!innoRenderer::viewLayout($this->getRouting()->getRouteAlias()) || !innoRenderer::isLayoutRenderable())
    {
      echo innoRenderer::renderTemplate();
      $this->getCache()->dumpTemplate($inno_template);
    }
    else
    {
      // initialize view components
      innoRenderer::iniHeaders();
      
      ob_start();
      include_once(innoDir::get('MODULE').$inno_layout.'.php');
      $inno_layout = ob_get_contents();
      ob_end_clean();
      
      // set layout contents
      innoRenderer::setLayout($inno_layout);
      
      // render whole layout template
      echo innoRenderer::renderLayout();
      $this->getCache()->dumpTemplate($inno_layout);
    }
    
    $this->getCache()->dumpConfig();
    
    return;
  }
  
}
