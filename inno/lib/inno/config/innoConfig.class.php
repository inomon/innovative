<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');
/*
 * class: innoConfig
 *
 * @author:     Orlino L. Monares Jr. <anxietylost110987@gmail.com, orlino_monares110987@yahoo.com>
 * @package:    inno
 * @subpackage: config
 *
 * @todo: _____________
 *
 */

class innoConfig 
{
  protected static $config = array();
  protected static $flushable_config = array();
  
  /* mutators for non-cacheable/flushable configurations */
  public static function setFlushable($config_key, $value)
  {
    self::$flushable_config[$config_key] = $value;
  }
  
  public static function hasFlushable($name)
  {
    return array_key_exists($name, self::$flushable_config);
  }
  
  public static function getFlushable($config_key, $default = null)
  {
    return isset(self::$flushable_config[$config_key]) ? self::$flushable_config[$config_key] : $default;
  }
  
  public static function getAllFlushable()
  {
    return self::$flushable_config;
  }
  
  /* mutators for cacheable configurations */
  public static function set($config_key, $value)
  {
    self::$config[$config_key] = $value;
  }
  
  public static function has($name)
  {
    return array_key_exists($name, self::$config);
  }
   
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
  
  public static function add($parameters = array())
  {
    self::$config = array_merge(self::$config, self::addConfig($parameters));
  }
  
  public static function addFromCache($parameters)
  {
    self::$config = array_merge(self::$config, $parameters);
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
