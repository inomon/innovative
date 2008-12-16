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
 * @subpackage: utilities.innoDirectoryCrawler
 *
 * @todo: _____________
 *
 */
 
class innoDirectoryCrawler
{
  public function __construct()
  {
    
  }
  
  /*
   * 
   */
  protected static function pruneTree($tree)
  {
    unset($tree[0]);
    unset($tree[1]);
    
    return $tree;
  }
  
  /*
   * 
   */
  protected static function buildTree($directory, $files)
  {
    $files = self::pruneTree($files);
    
    foreach ($files as $index => $file)
    {
      if(is_dir($directory.DIR_SEP.$file))
      {
        unset($files[$index]);
        $files[$file] = self::buildTree($directory, scandir($directory.DIR_SEP.$file));
      }
    }
    
    return $files;
  }
  
  /*
   * @description: build a directory array, with branchings/sub-directories based on the passed path
   * @param: directory
   * @return: false if directory is not a valid directory path, the files & directories array if there are & 0 if there are none 
   */
  public static function directoryTree($directory)
  {
    if(!is_dir($directory))
      return false;
    
    $separator_position = strrpos($directory, ((stripos($_SERVER['DOCUMENT_ROOT'], ':') === false) ? "/" : "\\"));
    if ($separator_position == (strlen($directory)-1))
      $directory .= substr($directory, 0, $separator_position-1);
    
    $files = scandir($directory);
    $files = self::buildTree($directory, $files);
    array_multisort($files, SORT_ASC, SORT_STRING);
    
    return ((count($files)>0) ? $files : 0 );
  }
  
  /*
   * @param: directory
   * @return: false if directory is not a valid directory path, the directory array if there are directories & 0 if there are none 
   */
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
    unset($files);
    
    return ((count($dir_list)>0) ? $dir_list : 0 );
  }
  
  /*
   * @param: directory
   * @return: false if directory is not a valid directory path, the file array if there are files & 0 if there are none 
   */
  public static function listFile($directory)
  {
    if(!is_dir($directory))
      return false;
    
    $files = scandir($directory);
    $file_list = array();
    
    foreach($files as $file)
    {
      if(is_file($directory.DIR_SEP.$file))
        $file_list[] = $file;
    }    
    unset($files);
    
    return ((count($file_list)>0) ? $file_list : 0 );
  }
}
