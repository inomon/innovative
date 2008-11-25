<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');
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
//require_once();

class innoRenderer
{
  protected static $template = array();
  protected static $layout   = array();
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
  
  /*
   * deprecated
   */
  public static function iniTemplate()
  {
    ob_start();
    include_once MODULES.DIR_SEP.$inno_request->getModule().'.mod'.DIR_SEP.'tmplt'.DIR_SEP.$inno_request->getAction().'.tmplt.php';
    self::$template = ob_get_contents();
    ob_end_clean();
  }
  
  /*
   * deprecated
   */
  public static function iniLayout($layout = 'layout')
  {
    ob_start();
    include_once MODULES.DIR_SEP.$layout.'.php';
    self::$layout = ob_get_contents();
    ob_end_clean();
  }

  public static function iniHeaders()
  {
    self::$headers = "\n";
    
    // set document metas
    //<meta name="author" content="Tom@Lwis (http://www.lwis.net/free-css-drop-down-menu/)" /> 
    $hdr_cnfg = innoConfig::getConfgWithKey('web_metas_', true);
    self::$headers = self::$headers.'<title>'.$hdr_cnfg['title'].'</title>'."\n";      
    foreach ($hdr_cnfg as $key => $config)
    {
      self::$headers = self::$headers.'<meta name='."\"".$key."\"".' content='."\"".$config."\"".' />'."\n";      
    }    
    
    // set http metas
    //<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    $hdr_cnfg = innoConfig::getConfgWithKey('web_http_metas_', true);
    foreach ($hdr_cnfg as $key => $config)
    {
      self::$headers = self::$headers.'<meta http-equiv='."\"".$key."\"".' content='."\"".$config."\"".' />'."\n";      
    }
    
    // set stylesheets
    //<link href="css/dropdown/dropdown.css" media="all" rel="stylesheet" type="text/css" /> 
    $hdr_cnfg = innoConfig::getConfgWithKey('web_stylesheets', true);
    foreach ($hdr_cnfg as $key => $config)
    {
      self::$headers = self::$headers.'<link href='."\"/".innoDir::get('ASSETS')."css/".$config."\"".' media="all" rel="stylesheet" type="text/css" />'."\n";      
    }
    
    // set javascripts
    //<script type="text/javascript" src="js/jquery/jquery.js"></script>
    $hdr_cnfg = innoConfig::getConfgWithKey('web_javascripts', true);
    foreach ($hdr_cnfg as $key => $config)
    {
      self::$headers = self::$headers.'<script type="text/javascript" src='."\"/".innoDir::get('ASSETS')."js/".$config."\"".'></script>'."\n";      
    }

    // set favicon
    self::$headers = self::$headers."<link rel=\"shortcut icon\" href=\"/".innoConfig::get('web_favicon').".ico\" />\n";
    
    if (innoAssets::getScriptHead() != '') 
      self::$headers = self::$headers.'<script type="text/javascript">'.innoAssets::getScriptHead().'</script>'."\n";
    
    if (innoAssets::getStyleHead() != '') 
      self::$headers = self::$headers.style_tag(innoAssets::getStyleHead())."\n";
       
  }

  public static function renderTemplate()
  {
    echo self::$template;
  }
  
  public static function renderLayout()
  {
    echo self::$layout;
  }
  
  public static function renderHeaders()
  {
    echo self::$headers;
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
