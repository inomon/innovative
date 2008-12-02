<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');
/*
 * class: innoAutoload
 *
 * @author:     Orlino L. Monares Jr. <anxietylost110987@gmail.com, orlino_monares110987@yahoo.com>
 * @package:    inno
 * @subpackage: autoload
 *
 * @todo: _____________
 *
 */

class innoAutoload
{
  protected static $helpers = array();
  protected static $classes = array();
  
  public static function addClass($class)
  {
    self::$classes[] = $class;    
  }
  
  public static function addHelper($helper)
  {
    self::$helpers[] = $helper;
  }
  
  public static function getClasses()
  {
    return self::$classes;
  }
  
  public static function getHelpers()
  {
    return self::$helpers;
  }
}
