<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');

// if server is not windows
if (stripos($_SERVER["DOCUMENT_ROOT"], ':') === false)
{
  set_include_path(realpath(dirname(__FILE__).DIR_SEP.'..'.DIR_SEP.'lib'.DIR_SEP.'classes').':'.get_include_path());
//  set_include_path(realpath(dirname(__FILE__).DIR_SEP.'..'.DIR_SEP.'lib'.DIR_SEP.'classes').':'.realpath(dirname(__FILE__).DIR_SEP.'..'.DIR_SEP.'lib'.DIR_SEP.'classes').':'. get_include_path());
}
// if server is windows
else 
{
  set_include_path(realpath(dirname(__FILE__).DIR_SEP.'..'.DIR_SEP.'lib'.DIR_SEP.'classes').';'.get_include_path());
//  set_include_path(realpath(dirname(__FILE__).DIR_SEP.'..'.DIR_SEP.'lib'.DIR_SEP.'classes').';'.realpath(dirname(__FILE__).DIR_SEP.'..'.DIR_SEP.'lib'.DIR_SEP.'classes').';'. get_include_path());
}

// include the directory settings file
include_once('inno.dir.php');

// load needed classes
include_once(innoDir::get('INNO_LIB').'Spyc.class.php');
include_once(innoDir::get('INNO_LIB').'innoConfig.class.php');

// load helper classes
include_once(innoDir::get('INNO_HELPER').'Loader.helper.php');
// include initialization file depending on environment
if(!file_exists(innoDir::get('CONF').APPLI.'.ini.php'))
  die('<html><body><font color="red">Environment dependent initialization file, NOT FOUND!!</font></body></html>');
require_once(innoDir::get('CONF').APPLI.'.ini.php');

// initialize default loaded classes and helpers
load_helper(
  'Tag', 
  'Exception'
);
load_class(
  'innoAssets', 
  'innoRenderer', 
  'innoRequest', 
  'innoRouting',
  'controller/innoController',
  'exception/Error401Exception',
  'exception/Error403Exception',
  'exception/Error404Exception'
);

$url = '/';
if(isset($_SERVER['REDIRECT_URL']))
{
  if(strpos($_SERVER['REDIRECT_URL'], '.php') !== false)
    $url = substr($_SERVER['REDIRECT_URL'], strpos($_SERVER['REDIRECT_URL'], '.php')+4, strlen($_SERVER['REDIRECT_URL']));
  else
    $url = $_SERVER['REDIRECT_URL']; 
}
else if(isset($_SERVER['PATH_INFO']))
  $url = $_SERVER['PATH_INFO']; 
#echo '<span style="color:red;font-size:20px;">'.$url.'</span>';
innoController::setRequest(new innoRequest());
innoController::setRouting(new innoRouting(Spyc::YAMLLoad($inno_routing_dir), $url));

/*
innoController::setRouting(
  new innoRouting(
    Spyc::YAMLLoad($inno_routing_dir), 
    (
      (isset($_SERVER['REDIRECT_URL'])) ? 
        $_SERVER['REDIRECT_URL'] : 
          (
            (isset($_SERVER['PATH_INFO'])) ? 
              $_SERVER['PATH_INFO'] : 
              '/' 
          ) 
    )
  )
);

// exception classes
//include_once(innoDir::get('INNO_LIB').'exception'.DIR_SEP.'Error401Exception.class.php');
//include_once(innoDir::get('INNO_LIB').'exception'.DIR_SEP.'Error403Exception.class.php');
//include_once(innoDir::get('INNO_LIB').'exception'.DIR_SEP.'Error404Exception.class.php');

// set action parameter identifier
//$inno_action_param = 'module';
/*
function _dummy_execute($inno_routing_dir)
{
  // initialize Request();
  global $inno_request, $inno_routing;
  $inno_request = new innoRequest();
  $inno_action_param = $GLOBALS['inno_action_param'];

  $inno_routing = new innoRouting(Spyc::YAMLLoad($inno_routing_dir));
  $inno_route = explode(' ', $inno_routing->route($inno_request->getRoute($inno_action_param, 'homepage')));

  $inno_request->setModule($inno_route[0]);
  $inno_request->setAction($inno_route[1]);

  unset($inno_route);
    
  // get the action
  $inno_action = sprintf(innoDir::get('MODULE_ACTION'), $inno_request->getModule()).$inno_request->getAction().'.action.php';
  // set default layout
  $inno_layout = 'layout';
  $inno_template = 'template';
  
  // if the action deosnt exist revert to the error404 action
  if (!file_exists($inno_action))
  {
    $inno_request->setModule('default');
    $inno_request->setAction('error404');
    $inno_action = sprintf(innoDir::get('MODULE_ACTION'), $inno_request->getModule()).$inno_request->getAction().'.action.php';
  }
  
  try
  {
    // include the module-action
    include_once($inno_action);  
  }
  catch(Error404Exception $e)
  {
    $inno_request->setModule('default');
    $inno_request->setAction('error404');
    $inno_action = sprintf(innoDir::get('MODULE_ACTION'), $inno_request->getModule()).$inno_request->getAction().'.action.php';
    include_once($inno_action);  
  }
  catch(Error403Exception $e)
  {
    $inno_request->setModule('default');
    $inno_request->setAction('error403');
    $inno_action = sprintf(innoDir::get('MODULE_ACTION'), $inno_request->getModule()).$inno_request->getAction().'.action.php';
    include_once($inno_action);  
  }
  catch(Error401Exception $e)
  {
    $inno_request->setModule('default');
    $inno_request->setAction('error401');
    $inno_action = sprintf(innoDir::get('MODULE_ACTION'), $inno_request->getModule()).$inno_request->getAction().'.action.php';
    include_once($inno_action);  
  }

  // use output buffer to get template contents
  // start output buffer
  ob_start();
  include_once(sprintf(innoDir::get('MODULE_TMPLT'), $inno_request->getModule()).$inno_request->getAction().'.tmplt.php');
  $inno_template = ob_get_contents();
  ob_end_clean();
  // end output buffer

  // set template contents
  innoRenderer::setTemplate($inno_template);
  
  if(!innoRenderer::viewLayout($inno_routing->getRouteBase()) || !innoRenderer::isLayoutRenderable())
  {
    innoRenderer::renderTemplate();
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
    
    // render view components
    innoRenderer::renderLayout();
  }
}
*/

