<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');

$inno_cache = new innoCache();
$is_cached = $inno_cache->isConfCached();

if (!$is_cached)
{
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
  // load the application settings
  foreach(Spyc::YAMLLoad(innoDir::get('CONF').'settings.yml') as $key => $value)
  {
    innoConfig::set('inno_appli_settings_' . $key, $value);
  }
  
  // initialize default loaded classes and helpers
  include_helper(innoConfig::get('inno_appli_settings_inno_autoload', null, 'helpers'));
  include_library(innoConfig::get('inno_appli_settings_inno_autoload', null, 'classes'));
  
  // initialize database connection, if enabled
  if(innoConfig::get('inno_appli_settings_database', null, 'enable_conn') === true)
  {
    require_once('propel/Propel.php');
    Propel::init(innoDir::get('PROPEL_CONF').innoConfig::get('inno_appli_settings_propel', null, 'project').'-conf.php');
  }
}
else
{
  $inno_cache->loadConfig();
}

// resolve the uri/url of the requested page
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

// initialize the needed controller objects 
innoController::setRequest(new innoRequest());
innoController::setRouting(new innoRouting(innoConfig::get('inno_routing_rules'), $url));
innoController::setCache($inno_cache);

// include initialization file depending on environment
if(!file_exists(innoDir::get('CONF').APPLI.'.ini.php'))
  die('<html><body><font color="red">Environment dependent initialization file, NOT FOUND!!</font></body></html>');

require_once(innoDir::get('CONF').APPLI.'.ini.php');
