<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');
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

class innoCache 
{
  protected $cache_dir = '';
  
  public function __construct()
  {
    $this->cache_dir = innoDir::get('CACHE');
  }
  
  public function isCached()
  {
    
  }
  
  public function loadConfig()
  {
    if (DEBUG) return null;
    
    include innoDir::get('CACHE_CONF').'innoconfig.php';
    
    return null;    
  }
  
  public function loadTemplate()
  {
    if (DEBUG) return null;
    
    if (innoConfig::hasFlushable('inno_routing_url_life'))
    {
      if (innoConfig::getFlushable('inno_routing_url_life') >= innoConfig::get('min_template_life'))
      {
        $current_time = mktime(date("H"), date("i"), date("s"), date("n")  , date("j"), date("Y"));
        $template_atime = filemtime(innoDir::get('CACHE_TMPLT').str_replace('/', '-', innoConfig::getFlushable('inno_routing_url_base')).'.tmplt');
        $time_diff = $current_time - $template_atime;
        if ($time_diff > 0 && $time_diff <= innoConfig::getFlushable('inno_routing_url_life'))
        {
          return 
        }
        else if ($time_diff > innoConfig::getFlushable('inno_routing_url_life') && innoConfig::getFlushable('inno_routing_url_life') >= innoConfig::get('min_template_life'))
        return $this->cache(innoDir::get('CACHE_TMPLT').str_replace('/', '-', innoConfig::getFlushable('inno_routing_url_base')).'.tmplt', $template);
      }
    }
    
    return null;
  }
  
  public function dumpConfig()
  {
    if (DEBUG) return null;
    
    if (file_exists(innoDir::get('CACHE_CONF')) && is_writable($this->cache_dir))
    {
      $config = 'innoConfig::addFromCache('.var_export(innoConfig::getAll(), true).');';
      return $this->cache(innoDir::get('CACHE_CONF').'innoconfig.php', $config);
    }
    
    return null;
  }
  
  public function dumpTemplate($template)
  {
    if (DEBUG) return null;
    
    if (file_exists(innoDir::get('CACHE_TMPLT')) && is_writable($this->cache_dir))
    {
      if (innoConfig::hasFlushable('inno_routing_url_life'))
      {
        if (innoConfig::getFlushable('inno_routing_url_life') >= innoConfig::get('min_template_life'))
        {
          return $this->cache(innoDir::get('CACHE_TMPLT').str_replace('/', '-', innoConfig::getFlushable('inno_routing_url_base')).'.tmplt', $template);
        }
      }
    }
    
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
        if (!$f_handle = fopen($file,'w')) {
             return false;
        }
        if (fwrite($f_handle, $content) === FALSE) {
            return false;
        }
        fclose($f_handle);
        return true;
    } 
    
    return false;    
  }
}
