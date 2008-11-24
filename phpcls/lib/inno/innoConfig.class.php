<?php
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

class innoConfig 
{
  protected static $config = array();
   
  public static function get($config_key, $default = null)
  {
    return isset(self::$config[$config_key]) ? self::$config[$config_key] : $default;
  }

  public static function getConfgWithKey($confg_key, $strip_key = false)
  {
    $spec_confg = array();
    foreach(self::$config as $key => $value)
    {
      if (!(strstr($key, $confg_key) === false))
      {
        $spec_confg[substr($key, strlen($confg_key), strlen($key)-1)] = $value;
      }      
    }
    return $spec_confg;
  }
  
  public static function set($config_key, $value)
  {
    self::$config[$config_key] = $value;
  }
  
  public static function has($name)
  {
    return array_key_exists($name, self::$config);
  }
  
  public static function add($parameters = array())
  {
    self::$config = array_merge(self::$config, self::addConfig($parameters));
  }
  
  public static function getAll()
  {
    return self::$config;
  }

  public static function clear()
  {
    self::$config = null;
    self::$config = array();
  }
  
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
