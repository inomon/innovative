<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');
/*
 * This file is a part of the inno package.
 * Copyright (C) 2008 Orlino L. Monares Jr. <anxietylost110987@gmail.com, orlino_monares110987@yahoo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
 * 
 *
 * @author:     Orlino L. Monares Jr. <anxietylost110987@gmail.com, orlino_monares110987@yahoo.com>
 * @package:    inno
 * @subpackage: config.innoConfigHandler
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
