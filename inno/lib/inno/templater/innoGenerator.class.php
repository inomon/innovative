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
 * @subpackage: templater.innoGenerator
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
  
  public function generateFile($file_name, $file_content)
  {
    if(!($this->isExisting() && $this->isWritable()))
      return false;
    
    $fp = fopen($this->getDirectory().DIR_SEP.$file_name, 'w');
    fwrite($fp, $file_content);
    fclose($fp);
    
    return file_exists($this->getDirectory().DIR_SEP.$file_name);
  }
  
  public function generateDir($directory)
  {
    $this->directory = $directory;
    if(!($this->isWritable()))
      return false;
    
    return mkdir($this->getDirectory());
  }
  
  
}
