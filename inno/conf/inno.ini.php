<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');

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
  'innoController',
  'innoError401Exception',
  'innoError403Exception',
  'innoError404Exception',
  'innoSkipActionException'
);

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

