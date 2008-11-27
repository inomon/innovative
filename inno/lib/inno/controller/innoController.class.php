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

class innoController
{
  protected $status = 'initialized';
  protected static $inno_cache = 'initialized';
  protected static $inno_request = 'initialized';
  protected static $inno_routing = 'initialized';
  
  // @todo: determine initialization variables needed by this controller
  public function __construct()
  {
    
  }

  public function __toString()
  {
    return $this->status;
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
    if($cond)
      $this->getRequest()->forwardTo404();
  }

  public function forwardTo403If($cond)
  {
    if($cond)
      $this->getRequest()->forwardTo403();
  }

  public function forwardTo401If($cond)
  {
    if($cond)
      $this->getRequest()->forwardTo401();
  }
  /* if conditions to forward to error */

  /* unless conditions to forward to error */
  public function forwardTo404Unless($cond)
  {
    if(!$cond)
      $this->getRequest()->forwardTo404();
  }

  public function forwardTo403Unless($cond)
  {
    if(!$cond)
      $this->getRequest()->forwardTo403();
  }

  public function forwardTo401Unless($cond)
  {
    if(!$cond)
      $this->getRequest()->forwardTo401();
  }
  /* unless conditions to forward to error */
  
  public function run()
  {
/*
    // initialize Request();
    global $inno_request, $inno_routing;
    $inno_request = new innoRequest();
    $inno_action_param = $GLOBALS['inno_action_param'];
    $inno_routing = new innoRouting(Spyc::YAMLLoad($inno_routing_dir));
    $inno_route = explode(' ', $inno_routing->route($this->getRequest()->getRoute($inno_action_param, 'homepage')));

    $inno_request->setModule($inno_route[0]);
    $inno_request->setAction($inno_route[1]);

    unset($inno_route);

    // if the action doesnt exist revert to the error404 action
    if (!file_exists($inno_action))
    {
      $this->getRequest()->setModule('default');
      $this->getRequest()->setAction('error404');
      $inno_action = sprintf(innoDir::get('MODULE_ACTION'), $this->getRequest()->getModule()).$this->getRequest()->getAction().'.action.php';
    }
*/   

    if ($this->getCache()->isTmpltCached())
    {
      echo $this->getCache()->loadTemplate();
      
      // @todo: (arguable statement) check if this will optimize the code/application of slow it down
      $this->getCache()->dumpConfig();
      return;
    }
    
    // get the action
    $inno_action = sprintf(innoDir::get('MODULE_ACTION'), $this->getRouting()->getModule()).$this->getRouting()->getAction().'.action.php';
    // set default layout
    $inno_layout = 'layout';
    $inno_template = 'template';
    
    try
    {
      // include the module-action
      if (!file_exists($inno_action))
        throw new Error404Exception('Error: Page Not Found', 1081404);
      
      include_once($inno_action);
    }
    catch(innoError404Exception $e)
    {
      $this->getRouting()->setModule('default');
      $this->getRouting()->setAction('error404');
      $inno_action = sprintf(innoDir::get('MODULE_ACTION'), $this->getRouting()->getModule()).'error404.action.php';
      include_once($inno_action);  
    }
    catch(innoError403Exception $e)
    {
      $this->getRouting()->setModule('default');
      $this->getRouting()->setAction('error403');
      $inno_action = sprintf(innoDir::get('MODULE_ACTION'), $this->getRouting()->getModule()).'error403.action.php';
      include_once($inno_action);  
    }
    catch(innoError401Exception $e)
    {
      $this->getRouting()->setModule('default');
      $this->getRouting()->setAction('error401');
      $inno_action = sprintf(innoDir::get('MODULE_ACTION'), $this->getRouting()->getModule()).'error401.action.php';
      include_once($inno_action);  
    }

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
      //innoRenderer::iniTemplate();
      innoRenderer::iniHeaders();
      //innoRenderer::iniLayout();

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
    
    // @todo: (arguable statement) check if this will optimize the code/application of slow it down
    $this->getCache()->dumpConfig();
    
    return;
  }
  
}
