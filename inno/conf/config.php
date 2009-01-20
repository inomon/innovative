<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');

// @todo: check where the libraries are needed for them to be included in the include_path
set_include_path(realpath(dirname(__FILE__).DIR_SEP.'..'.DIR_SEP.'lib'.DIR_SEP.'classes').((stripos($_SERVER["DOCUMENT_ROOT"], ':') === false) ? ':' : ';').get_include_path());
//  set_include_path(realpath(dirname(__FILE__).DIR_SEP.'..'.DIR_SEP.'lib'.DIR_SEP.'classes').':'.realpath(dirname(__FILE__).DIR_SEP.'..'.DIR_SEP.'lib'.DIR_SEP.'classes').':'. get_include_path());


if(DEBUG)
  error_reporting(E_ALL | E_STRICT);
else
  error_reporting(0);

// include the directory settings file
include_once(dirname(__FILE__).'/../lib/inno/utilities/innoDir.class.php');

// load needed classes to speed-up the initilization 
include_once(innoDir::get('INNO_LIB').'utilities/Spyc.class.php');
include_once(innoDir::get('INNO_LIB').'autoload/innoAutoload.class.php');
include_once(innoDir::get('INNO_LIB').'config/innoConfig.class.php');
include_once(innoDir::get('INNO_LIB').'cache/innoCache.class.php');

// load helper classes
include_once(innoDir::get('INNO_HELPER').'Loader.helper.php');

// include the universal initialization file for i.i
include_once('inno.ini.php');

