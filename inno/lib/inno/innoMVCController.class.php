<?php
/*
 *
 * @author:  Orlino L. Monares Jr. <anxietylost110987@gmail.com, orlino_monares110987@yahoo.com>
 *
 * @package:
 * @subpackage:
 *
 * @todo: _____________
 *
 */
//require_once();

class innoMVCController
{
  public static function get($config_key, $default = null)
  {
    return isset(self::$config[$config_key]) ? self::$config[$config_key] : $default;
  }
}
