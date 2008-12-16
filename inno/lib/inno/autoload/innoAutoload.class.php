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
 * @subpackage: autoload.innoAutoload
 *
 * @todo: _____________
 *
 */

class innoAutoload
{
  protected static $helpers = array();
  protected static $classes = array();
  
  public static function addClass($class, $file)
  {
    self::$classes[$class] = $file;
  }
  
  public static function addHelper($helper, $file)
  {
    self::$helpers[$helper] = $file;
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
