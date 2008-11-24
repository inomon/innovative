<?php

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
        'LIB'               => LIB.DIR_SEP.'lib'.DIR_SEP,
        'ORM'               => LIB.DIR_SEP.'lib'.DIR_SEP.'orm'.DIR_SEP,
        'INNO_LIB'          => LIB.DIR_SEP.'lib'.DIR_SEP.'inno'.DIR_SEP,
        'INNO_HELPER'       => LIB.DIR_SEP.'lib'.DIR_SEP.'inno'.DIR_SEP.'helper'.DIR_SEP,
        'CONF'              => LIB.DIR_SEP.'conf'.DIR_SEP,
        'ASSETS'            => '',
        'MODULE'            => LIB.DIR_SEP.'module'.DIR_SEP,
        'MODULE_ACTION'     => LIB.DIR_SEP.'module'.DIR_SEP.'%s.mod'.DIR_SEP,
        'MODULE_TMPLT'      => LIB.DIR_SEP.'module'.DIR_SEP.'%s.mod'.DIR_SEP.'tmplt'.DIR_SEP,
        'D_ASSETS'          => '',
        'D_MODULE'          => '',
        'D_MODULE_ACTION'   => '',
        'D_MODULE_TMPLT'    => '',
        'DEV'               => LIB.DIR_SEP.'dev'.DIR_SEP,
        'DEV_ASSESTS'       => LIB.DIR_SEP.'dev'.DIR_SEP.'assets'.DIR_SEP,
        'DEV_MODULE'        => LIB.DIR_SEP.'dev'.DIR_SEP,
        'DEV_MODULE_ACTION' => LIB.DIR_SEP.'dev'.DIR_SEP.'%s.mod'.DIR_SEP,
        'DEV_MODULE_TMPLT'  => LIB.DIR_SEP.'dev'.DIR_SEP.'%s.mod'.DIR_SEP.'tmplt'.DIR_SEP,
        '~' => ''
      ));

if(ENV=='dev') 
{

  innoDir::set('D_ASSETS', innoDir::get('ASSETS'));
  innoDir::set('D_MODULE', innoDir::get('MODULE'));
  innoDir::set('D_MODULE_ACTION', innoDir::get('MODULE_ACTION'));
  innoDir::set('D_MODULE_TMPLT', innoDir::get('MODULE_TMPLT'));

  innoDir::set('CONF', innoDir::get('CONF').DIR_SEP.'dev_conf'.DIR_SEP);
  innoDir::set('ASSETS', '../');
  innoDir::set('MODULE', innoDir::get('DEV_MODULE'));
  innoDir::set('MODULE_ACTION', innoDir::get('DEV_MODULE_ACTION'));
  innoDir::set('MODULE_TMPLT', innoDir::get('DEV_MODULE_TMPLT'));
  innoDir::set('MODULE_TMPLT', innoDir::get('DEV_MODULE_TMPLT'));
}
