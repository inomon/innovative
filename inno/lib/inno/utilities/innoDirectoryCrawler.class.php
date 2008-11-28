<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');
/*
 * class: innoDirectoryCrawler
 *
 * @author:     Orlino L. Monares Jr. <anxietylost110987@gmail.com, orlino_monares110987@yahoo.com>
 * @package:    inno
 * @subpackage: utilities
 *
 * @todo: _____________
 *
 */
 
class innoDirectoryCrawler
{
  public function __construct()
  {
    
  }
  
  public static function listDir($directory)
  {
    if(!is_dir($directory))
      return false;
    
    $files = scandir($directory);
    $dir_list = array();
    
    foreach($files as $file)
    {
      if(is_dir($directory.DIR_SEP.$file))
        $dir_list[] = $file;
    }
    
    return ((count($dir_list)>0) ? $dir_list : 0 );
  }
  
  
  public static function listFiles($directory)
  {
    if(!is_dir($directory))
      return false;
    
    $files = scandir($directory);
    $dir_list = array();
    
    foreach($files as $file)
    {
      if(is_file($directory.DIR_SEP.$file))
        $dir_list[] = $file;
    }    
    
    return ((count($dir_list)>0) ? $dir_list : 0 );
  }
}
