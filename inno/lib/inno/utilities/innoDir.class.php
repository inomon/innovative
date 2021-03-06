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
 * @subpackage: utilities.innoDir
 *
 * @todo: _____________
 *
 */
 
class innoDir 
{
  protected static $inno_dir = array();
  
  public static function get($dir)
  {
    if(!array_key_exists(strtoupper($dir), self::$inno_dir))
      die('Directory doesnt exist: '.$dir);
      
    return self::$inno_dir[strtoupper($dir)];    
  }

  public static function set($dir, $value)
  {
    self::$inno_dir[strtoupper($dir)] = $value;    
  }

  public static function add($dir, $value)
  {
    self::set($dir, $value);    
  }
  
  public static function clear()
  {
    self::$inno_dir = null;
    self::$inno_dir = array();
  }
  
  public static function initialize($dirs)
  {
    self::clear();
    self::$inno_dir = $dirs;
  }
  
  public static function getAll()
  {
    return self::$inno_dir;    
  }
}

innoDir::initialize(array(
        // appli directory
        'APPLI'             => LIB.DIR_SEP.'appli'.DIR_SEP,
        'APP'               => LIB.DIR_SEP.'appli'.DIR_SEP,
        // project classes & ORM directory
        'LIB'               => LIB.DIR_SEP.'lib'.DIR_SEP,
        'ORM'               => LIB.DIR_SEP.'lib'.DIR_SEP.'classes'.DIR_SEP,
        'PROJ_LIB'          => LIB.DIR_SEP.'lib'.DIR_SEP.'classes'.DIR_SEP.'%s'.DIR_SEP,
        'USED_ORM'          => LIB.DIR_SEP.'lib'.DIR_SEP.'classes'.DIR_SEP.'%s'.DIR_SEP,
        // inno library directory
        'INNO_LIB'          => LIB.DIR_SEP.'lib'.DIR_SEP.'inno'.DIR_SEP,
        'INNO_HELPER'       => LIB.DIR_SEP.'lib'.DIR_SEP.'inno'.DIR_SEP.'helper'.DIR_SEP,
        // configuration directory
        'CONF'              => LIB.DIR_SEP.'conf'.DIR_SEP.APPLI.DIR_SEP,
        'CONF_BASE'         => LIB.DIR_SEP.'conf'.DIR_SEP,
        'ORM_CONF'          => LIB.DIR_SEP.'conf'.DIR_SEP.'%s'.DIR_SEP,
        // cache directory
        'CACHE'             => LIB.DIR_SEP.'cache'.DIR_SEP,
        'CACHE_CONF'        => LIB.DIR_SEP.'cache'.DIR_SEP.'conf'.DIR_SEP.APPLI.DIR_SEP,
        'CACHE_TMPLT'       => LIB.DIR_SEP.'cache'.DIR_SEP.'tmplt'.DIR_SEP.APPLI.DIR_SEP,
        // assets directory
        'ASSETS'            => '',
        // module directory
        'MODULE'            => LIB.DIR_SEP.'appli'.DIR_SEP.APPLI.DIR_SEP,
        'MODULE_LIB'        => LIB.DIR_SEP.'appli'.DIR_SEP.APPLI.DIR_SEP.'lib'.DIR_SEP,
        'MODULE_CLASS'      => LIB.DIR_SEP.'appli'.DIR_SEP.APPLI.DIR_SEP.'lib'.DIR_SEP.'classes'.DIR_SEP,
        'MODULE_HELPER'     => LIB.DIR_SEP.'appli'.DIR_SEP.APPLI.DIR_SEP.'lib'.DIR_SEP.'helper'.DIR_SEP,
        'MODULE_ACTION'     => LIB.DIR_SEP.'appli'.DIR_SEP.APPLI.DIR_SEP.'%s.mod'.DIR_SEP,
        'MODULE_TMPLT'      => LIB.DIR_SEP.'appli'.DIR_SEP.APPLI.DIR_SEP.'%s.mod'.DIR_SEP.'tmplt'.DIR_SEP,
        // synonmous to the appli directory of the module
        'D_ASSETS'          => '',
        'D_MODULE'          => '',
        'D_MODULE_ACTION'   => '',
        'D_MODULE_TMPLT'    => '',
        // [development panel appli] directory
        'DEV'               => LIB.DIR_SEP.'dev'.DIR_SEP,
        'DEV_ASSESTS'       => LIB.DIR_SEP.'dev'.DIR_SEP.'assets'.DIR_SEP,
        'DEV_MODULE'        => LIB.DIR_SEP.'dev'.DIR_SEP,
        'DEV_MODULE_ACTION' => LIB.DIR_SEP.'dev'.DIR_SEP.'%s.mod'.DIR_SEP,
        'DEV_MODULE_TMPLT'  => LIB.DIR_SEP.'dev'.DIR_SEP.'%s.mod'.DIR_SEP.'tmplt'.DIR_SEP,
        // data directory
        'DATA_SKEL_ACTION'   => LIB.DIR_SEP.'data'.DIR_SEP.'skeleton'.DIR_SEP.'action'.DIR_SEP,
        'DATA_SKEL_CONF'     => LIB.DIR_SEP.'data'.DIR_SEP.'skeleton'.DIR_SEP.'conf'.DIR_SEP,
        'DATA_SKEL_MISC'     => LIB.DIR_SEP.'data'.DIR_SEP.'skeleton'.DIR_SEP.'misc'.DIR_SEP,
        'DATA_SKEL_TEMPLATE' => LIB.DIR_SEP.'data'.DIR_SEP.'skeleton'.DIR_SEP.'template'.DIR_SEP,
        'DATA_PROJECT'       => LIB.DIR_SEP.'data'.DIR_SEP.'project'.DIR_SEP,
        // the core inno library directories
        'INNO_LIB_DIRS'     => array(
                                  // library directories
                                  LIB.DIR_SEP.'lib'.DIR_SEP.'inno'.DIR_SEP.'assets'.DIR_SEP,
                                  LIB.DIR_SEP.'lib'.DIR_SEP.'inno'.DIR_SEP.'autoload'.DIR_SEP,
                                  LIB.DIR_SEP.'lib'.DIR_SEP.'inno'.DIR_SEP.'cache'.DIR_SEP,
                                  LIB.DIR_SEP.'lib'.DIR_SEP.'inno'.DIR_SEP.'config'.DIR_SEP,
                                  LIB.DIR_SEP.'lib'.DIR_SEP.'inno'.DIR_SEP.'controller'.DIR_SEP,
                                  LIB.DIR_SEP.'lib'.DIR_SEP.'inno'.DIR_SEP.'exception'.DIR_SEP,
                                  LIB.DIR_SEP.'lib'.DIR_SEP.'inno'.DIR_SEP.'renderer'.DIR_SEP,
                                  LIB.DIR_SEP.'lib'.DIR_SEP.'inno'.DIR_SEP.'request'.DIR_SEP,
                                  LIB.DIR_SEP.'lib'.DIR_SEP.'inno'.DIR_SEP.'routing'.DIR_SEP,
                                  LIB.DIR_SEP.'lib'.DIR_SEP.'inno'.DIR_SEP.'scaffolding'.DIR_SEP,
                                  LIB.DIR_SEP.'lib'.DIR_SEP.'inno'.DIR_SEP.'skeleton'.DIR_SEP,
                                  LIB.DIR_SEP.'lib'.DIR_SEP.'inno'.DIR_SEP.'templater'.DIR_SEP,
                                  LIB.DIR_SEP.'lib'.DIR_SEP.'inno'.DIR_SEP.'utilities'.DIR_SEP,
                                  
                                  // skeleton sub-directory
                                  LIB.DIR_SEP.'lib'.DIR_SEP.'inno'.DIR_SEP.'skeleton'.DIR_SEP.'action'.DIR_SEP,
                                  LIB.DIR_SEP.'lib'.DIR_SEP.'inno'.DIR_SEP.'skeleton'.DIR_SEP.'conf'.DIR_SEP,
                                  LIB.DIR_SEP.'lib'.DIR_SEP.'inno'.DIR_SEP.'skeleton'.DIR_SEP.'misc'.DIR_SEP,
                                  LIB.DIR_SEP.'lib'.DIR_SEP.'inno'.DIR_SEP.'skeleton'.DIR_SEP.'template'.DIR_SEP,
                                ),
      ));

