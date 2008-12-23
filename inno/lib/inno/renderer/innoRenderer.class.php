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
 * @subpackage: renderer.innoRenderer
 *
 * @todo: _____________
 *
 */

class innoRenderer
{
  protected static $template = array();
  protected static $layout   = '';
  protected static $headers  = array();
  protected static $layout_renderable  = true;
  
  public static function setTemplate($template)
  {
    self::$template = $template;
  }
  
  public static function setLayout($layout)
  {
    self::$layout = $layout;
  }

  public static function setHeaders($headers)
  {
    self::$headers = $headers;
  }
  
  public static function getTemplate()
  {
    return self::$template;
  }
  
  public static function getLayout()
  {
    return self::$layout;
  }

  public static function getHeaders()
  {
    return self::$headers;
  }

  public static function iniHeaders()
  {
    self::$headers = "\n";
    
    // set document metas
    $hdr_cnfg = innoConfig::getConfgWithKey('web_metas_', true);
    self::$headers = self::$headers.'<title>'.$hdr_cnfg['title'].'</title>'."\n";      
    foreach ($hdr_cnfg as $key => $config)
    {
      self::$headers = self::$headers.'<meta name='."\"".$key."\"".' content='."\"".$config."\"".' />'."\n";      
    }    
    
    // set http metas
    $hdr_cnfg = innoConfig::getConfgWithKey('web_http_metas_', true);
    foreach ($hdr_cnfg as $key => $config)
    {
      self::$headers = self::$headers.'<meta http-equiv='."\"".$key."\"".' content='."\"".$config."\"".' />'."\n";      
    }
    
    // set stylesheets
    $hdr_cnfg = innoConfig::getConfgWithKey('web_stylesheets', true);
    foreach ($hdr_cnfg as $key => $config)
    {
      self::$headers = self::$headers.'<link href='."\"/".innoDir::get('ASSETS')."css/".$config."\"".' media="all" rel="stylesheet" type="text/css" />'."\n";      
    }
    
    // set javascripts
    $hdr_cnfg = innoConfig::getConfgWithKey('web_javascripts', true);
    foreach ($hdr_cnfg as $key => $config)
    {
      self::$headers = self::$headers.'<script type="text/javascript" src='."\"/".innoDir::get('ASSETS')."js/".$config."\"".'></script>'."\n";      
    }

    // set favicon
    self::$headers = self::$headers."<link rel=\"shortcut icon\" href=\"/".innoConfig::get('web_favicon').".ico\" />\n";
    
    // set scripts, in the header
    if (innoAssets::getScriptHead() != '') 
      self::$headers = self::$headers.script_tag(innoAssets::getScriptHead())."\n";
    
    // set styles, in the header
    if (innoAssets::getStyleHead() != '') 
      self::$headers = self::$headers.style_tag(innoAssets::getStyleHead())."\n";
       
  }
  
  /*
   * Return the rendered template, which will be used for cache dumping
   *
   *
   */
  public static function renderTemplate()
  {
    echo self::$template;
  }
  
  /*
   * Return the rendered headers, which will be used for cache dumping
   *
   *
   */
  public static function renderHeaders()
  {
    echo self::$headers;
  }
  
  /*
   * Return the rendered layout, which will be used for cache dumping
   *
   *
   */
  public static function renderLayout()
  {
    return self::$layout;
  }
  
  public static function viewLayout($alias)
  {
    $view_layout = innoConfig::getConfgWithKey('view_layout_', true);
    //var_dump($view_layout);
    if(array_key_exists($alias, $view_layout))
      return $view_layout[$alias];    
      
    return true;
  }
  
  public static function isLayoutRenderable($renderable = null)
  {
    if(!is_null($renderable))
      self::$layout_renderable = $renderable;

    return self::$layout_renderable;
  }

}
