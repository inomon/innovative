<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');
/*
 * class: innoGenerator
 *
 * @author:     Orlino L. Monares Jr. <anxietylost110987@gmail.com, orlino_monares110987@yahoo.com>
 * @package:    inno
 * @subpackage: templater
 *
 * @todo: _____________
 *
 */

class innoGenerator
{
  protected $directory = '';
  
  public function __construct()
  {
    
  }
  
  public function setDirectory($dir)
  {
    $this->directory = $dir;
  }
  
  public function getDirectory()
  {
    return $this->directory;
  }
  
  public function isWritable()
  {
    return is_writable($this->directory);
  }
  
  public function isExisting()
  {
    return file_exists($this->directory);
  }
  
  public function generateFile($file_content)
  {
    if(!($this->isExisting() && $this->isWritable()))
      return false;
    
    
  }
}
