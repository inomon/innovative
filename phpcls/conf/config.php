<?php
// include the directory settings file
include_once('inno.dir.php');

// load needed classes
include_once(innoDir::get('INNO_LIB').'Spyc.class.php');
include_once(innoDir::get('INNO_LIB').'innoConfig.class.php');

// load helper classes
include_once(innoDir::get('INNO_HELPER').'Loader.helper.php');

// set action parameter identifier
$inno_action_param = 'go';

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
  
  // include the module-action
  include_once($inno_action);

  // use output buffer to get template contents
  // start output buffer
  ob_start();
  include_once(sprintf(innoDir::get('MODULE_TMPLT'), $inno_request->getModule()).$inno_request->getAction().'.tmplt.php');
  $inno_template = ob_get_contents();
  ob_end_clean();
  // end output buffer

  // set template contents
  innoRenderer::setTemplate($inno_template);
  
  if(!innoRenderer::viewLayout($inno_routing->getRouteBase()))
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

// include initialization file depending on environment
if (ENV == 'fro')
  include_once(ENV.'.ini.php');
else if (ENV == 'bak')
  include_once(ENV.'.ini.php');
else if (ENV == 'dev')
  include_once(ENV.'.ini.php');

