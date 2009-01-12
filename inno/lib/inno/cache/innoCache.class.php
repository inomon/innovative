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
 * @subpackage: cache.innoCache
 *
 * @todo: _____________
 *
 */

class innoCache 
{
  protected $cache_dir = '';
  
  public function __construct()
  {
    $this->cache_dir = innoDir::get('CACHE');
  }
  
  public function isConfCached()
  {
    if (DEBUG) return false;

    if (file_exists(innoDir::get('CACHE_CONF').'innoconfig.php') && file_exists(innoDir::get('CACHE_CONF').'innoautoload.php'))
      return true;
    
    innoConfig::setFlushable('inno_cache_schedule_caching_conf', true);
    
    return false;
  }
  
  public function isTmpltCached()
  {
    if (DEBUG) return false;
    
    if (innoConfig::hasFlushable('inno_routing_url_life'))
    {
      if (innoConfig::getFlushable('inno_routing_url_life') >= innoConfig::get('min_template_life'))
      {
        $template_name = innoDir::get('CACHE_TMPLT').str_replace('/', '-', innoConfig::getFlushable('inno_routing_url_base')).'.tmplt';
        if (!file_exists($template_name))
          return false;
        
        $current_time = mktime(date("H"), date("i"), date("s"), date("n")  , date("j"), date("Y"));
        $template_atime = filemtime($template_name);
        $time_diff = $current_time - $template_atime;
        // retrieve the cached template if the time difference is <= the life of the page && if the difference is 
        if ($time_diff > 0 && $time_diff <= innoConfig::getFlushable('inno_routing_url_life'))
          return true;
        
        innoConfig::setFlushable('inno_cache_schedule_caching_tmplt', true);
        
        return false;
      }
      return false;
    }
    
    return false;
  }
  
  public function loadConfig()
  {
    if (DEBUG) return null;
    
    $this->getCache(innoDir::get('CACHE_CONF').'innoconfig.php', 'conf');
    $this->getCache(innoDir::get('CACHE_CONF').'innoautoload.php', 'conf');
    
    return null;    
  }
  
  public function loadTemplate()
  {
    if (DEBUG) return null;
    
    return $this->getCache(innoDir::get('CACHE_TMPLT').md5(innoConfig::getFlushable('inno_routing_url_base').'.tmplt'), 'tmplt');
  }
  
  public function dumpConfig()
  {
    if (DEBUG) return null;
    
    if (file_exists(innoDir::get('CACHE_CONF')) && is_writable($this->cache_dir) && innoConfig::getFlushable('inno_cache_schedule_caching_conf'))
    {
      $conf = var_export(innoConfig::getAll(), true);
      $class = var_export(innoAutoload::getClasses(), true);
      $helper = var_export(innoAutoload::getHelpers(), true);
      $configuration = 
"
<?php if ( ! defined('LIB')) exit('Direct script access is not allowed!');\n
innoConfig::addFromCache(".$conf.");\n\n
if(innoConfig::get('inno_appli_settings_database', null, 'enable_conn') === true)\n
{\n
  require_once('propel/Propel.php');\n
  Propel::init(innoDir::get('PROPEL_CONF').innoConfig::get('inno_appli_settings_propel', null, 'project').'-conf.php');\n
}\n
";
      $autoload = 
"
<?php if ( ! defined('LIB')) exit('Direct script access is not allowed!');\n
load_class_from_cache(".$class.");\n\n
load_helper_from_cache(".$helper.");\n\n
";
      return ($this->cache(innoDir::get('CACHE_CONF').'innoconfig.php', $configuration) && $this->cache(innoDir::get('CACHE_CONF').'innoautoload.php', $autoload));
    }
    
    return null;
  }
  
  public function dumpTemplate($template)
  {
    if (DEBUG) return null;
    
    if (!(innoConfig::getFlushable('inno_cache_schedule_caching_tmplt')))
      return null;
    
    return $this->cache(innoDir::get('CACHE_TMPLT').md5(innoConfig::getFlushable('inno_routing_url_base').'.tmplt'), $template);
    
    return null;
  }
  
  public function getCache($file, $type)
  {
    if (file_exists($file))
    {
      if ($type == 'conf')
      {
        include($file);
        return true;
      }
      else if ($type == 'tmplt')
      {
        ob_start();
        include $file;
        $tmplt = ob_get_contents();
        ob_clean_end();
        return $tmplt;
      }
    }
    
    return null;
  }
  
  public function cache($file, $content)
  {
    if (is_writable($this->cache_dir)) {
        if (!$f_handle = fopen($file,'w'))
             return false;
        
        if (fwrite($f_handle, $content) === FALSE)
            return false;
        
        fclose($f_handle);
        return true;
    } 
    
    return false;    
  }
}
