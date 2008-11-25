<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');
/*
 *
 * @author:  Orlino L. Monares Jr. <ino@ooip.nl, ino@atissoftware.com, orlino_monares110987@yahoo.com>
 *
 * @package:
 * @subpackage:
 *
 * @todo: _____________
 *
 */

abstract class innoConfigHandler
{
  protected static $config_handler = array();
  
  private static function addConfig($config)
  {   
    foreach ($config as $conf => $set)
    {
      if (is_array($set))
      {
        self::traverseConfigArr($set, $conf);
      }
      else 
      {
        self::$config_handler[$conf] = $set;
      }
    }
    
    return self::$config_handler;
  }
  
  private static function traverseConfigArr($arrays, $parent)
  {
    foreach ($arrays as $key => $value)
    {
      if (is_array($value))
      {
        self::traverseConfigArr($value, $parent.'_'.$key);
      }
      else 
      {
        self::$config_handler[$parent.'_'.$key] = $value;
      }
    }
  }
  
  }
