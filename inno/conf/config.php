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

innoController::setRequest(new innoRequest());
innoController::setRouting(new innoRouting(innoConfig::get('inno_routing_rules'), $url));
