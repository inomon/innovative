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

if(DEBUG)
  error_reporting(E_ALL | E_STRICT);
else
  error_reporting(0);

// include the directory settings file
include_once('inno.dir.php');

// load needed classes
include_once(innoDir::get('INNO_LIB').'utilities/Spyc.class.php');
include_once(innoDir::get('INNO_LIB').'config/innoConfig.class.php');
include_once(innoDir::get('INNO_LIB').'cache/innoCache.class.php');

// load helper classes
include_once(innoDir::get('INNO_HELPER').'Loader.helper.php');

$inno_cache = new innoCache();
if ($inno_cache->isConfCached())
  $inno_cache->loadConfig();
else
{
  // include initialization file depending on environment
  if(!file_exists(innoDir::get('CONF').APPLI.'.ini.php'))
    die('<html><body><font color="red">Environment dependent initialization file, NOT FOUND!!</font></body></html>');
  
  require_once(innoDir::get('CONF').APPLI.'.ini.php');

  // clear config holder
  innoConfig::clear();
  // load the application configuration
  innoConfig::add(Spyc::YAMLLoad(innoDir::get('CONF').'app.yml'));
  // load the module configuration
  innoConfig::add(Spyc::YAMLLoad(innoDir::get('CONF').'module.yml'));
  // load the web configuration
  innoConfig::add(Spyc::YAMLLoad(innoDir::get('CONF').'web.yml'));
  // load the site configuration
  innoConfig::add(Spyc::YAMLLoad(innoDir::get('CONF').'site.yml'));
  // load the view configuration
  innoConfig::add(Spyc::YAMLLoad(innoDir::get('CONF').'view.yml'));

  // load the routing rules
  innoConfig::set('inno_routing_rules', Spyc::YAMLLoad(innoDir::get('CONF').'routing.yml'));
  // load the routing rules
  innoConfig::set('inno_appli_settings', Spyc::YAMLLoad(innoDir::get('CONF').'settings.yml'));
}

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

innoController::setRequest(new innoRequest());
innoController::setRouting(new innoRouting(innoConfig::get('inno_routing_rules'), $url));
innoController::setCache($inno_cache);

