<?php
// clear config holder
innoConfig::clear();
// load the application configuration
//innoConfig::add(Spyc::YAMLLoad(innoDir::get('CONF').DIR_SEP.'dev_conf'.DIR_SEP.'dev_app.yml'));
innoConfig::add(Spyc::YAMLLoad(innoDir::get('CONF').'dev_app.yml'));
// load the module configuration
//innoConfig::add(Spyc::YAMLLoad(innoDir::get('CONF').DIR_SEP.'dev_conf'.DIR_SEP.'dev_module.yml'));
innoConfig::add(Spyc::YAMLLoad(innoDir::get('CONF').'dev_module.yml'));
// load the web configuration
//innoConfig::add(Spyc::YAMLLoad(innoDir::get('CONF').DIR_SEP.'dev_conf'.DIR_SEP.'dev_web.yml'));
innoConfig::add(Spyc::YAMLLoad(innoDir::get('CONF').'dev_web.yml'));
// load the site configuration
//innoConfig::add(Spyc::YAMLLoad(innoDir::get('CONF').DIR_SEP.'dev_conf'.DIR_SEP.'dev_site.yml'));
innoConfig::add(Spyc::YAMLLoad(innoDir::get('CONF').'dev_site.yml'));
// load the view configuration
//innoConfig::add(Spyc::YAMLLoad(innoDir::get('CONF').DIR_SEP.'dev_conf'.DIR_SEP.'dev_view.yml'));
innoConfig::add(Spyc::YAMLLoad(innoDir::get('CONF').'dev_view.yml'));

// initialize default loaded classes and helpers
load_helper('Tag');
load_class('innoAssets', 'innoRenderer', 'innoRequest', 'innoRouting');

_dummy_execute(innoDir::get('CONF').'dev_routing.yml');

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
*/
