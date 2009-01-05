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
 * @subpackage: assets.innoAssets
 *
 * @todo: _____________
 *
 */

class innoAssets
{
  /**
   * Holds the script to put in the header
   *
   * @var string
   */
  protected static $script_head = '';
  /**
   * Holds the styles to put in the header
   *
   * @var string
   */
  protected static $style_head = '';

  /**
   * Includes javascript libraries, from the plugins folder
   *
   * @param string $js_lib
   * @param string $js_load
   */
  public static function incJsLib($js_lib, $js_load = '')
  {
    switch ($js_lib)
    {
      case 'scriptaculous':
        if($js_load != '')
        $js_load = '?load='.$js_load;
        self::addJavascript('builtin/scriptaculous.js'.$js_load);
        break;
      case 'prototype':
        self::addJavascript('builtin/prototype.js');
        break;
      case 'jquery':
        self::addJavascript('builtin/jquery.js');
        break;
    }
  }

  /**
   * Enter description here...
   *
   * @param string $script
   * @return mixed
   */
  public static function addScriptHead($script = null)
  {
    if (strstr(self::$script_head, $script) === false)
    {
      self::$script_head .= $script;
      return $script;
    }

    return false;
  }
  /**
   * Enter description here...
   *
   * @param string $style
   * @return mixed
   */
  public static function addStyleHead($style = null)
  {
    if (strstr(self::$style_head, $style) === false)
    {
      self::$style_head .= $style;
      return $style;
    }

    return false;
  }

  /**
   * Enter description here...
   *
   * @param string $script
   */
  public static function remScriptHead($script = null)
  {
    self::$script_head = str_replace($script, '', self::$script_head);
  }
  
  /**
   * Enter description here...
   *
   * @param string $style
   */
  public static function remStyleHead($style = null)
  {
    self::$style_head = str_replace($style, '', self::$style_head);
  }

  /**
   * Enter description here...
   *
   * @return string
   */
  public static function getScriptHead()
  {
    return self::$script_head;
  }
  
  /**
   * Enter description here...
   *
   * @return string
   */
  public static function getStyleHead()
  {
    return self::$style_head;
  }

  /**
   * Enter description here...
   *
   * @param string $script
   */
  public static function addJavascript($script = null)
  {
    if (!$script)
    {
      return;
    }

    $js_array =  innoConfig::getConfgWithKey('web_javascripts');
    if (in_array($script, $js_array))
    {
      return;
    }
    $js_count = count($js_array);

    innoConfig::set('web_javascripts_'.$js_count, $script);

    return;
  }

  /**
   * Enter description here...
   *
   * @param string $stylesheet
   */
  public static function addStylesheet($stylesheet = null)
  {
    if (!$stylesheet)
    {
      return;
    }

    $css_array = innoConfig::getConfgWithKey('web_stylesheets');
    if (in_array($stylesheet, $css_array))
    {
      return;
    }
    $css_count = count($css_array);

    innoConfig::set('web_stylesheets_'.$css_count, $stylesheet);

    return;
  }

  /**
   * Enter description here...
   *
   * @param string $favicon
   */
  function setFavicon($favicon = null)
  {
    if (!$favicon)
    {
      return;
    }

    if (in_array($stylesheet, innoConfig::get('web_favicon')))
    {
      return;
    }

    innoConfig::set('web_favicon', $favicon);

    return;
  }

}
