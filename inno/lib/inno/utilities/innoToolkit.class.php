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
 * @subpackage: utilities.innoToolkit
 *
 * @todo: _____________
 *
 */
 
class innoToolkit
{
  public function __construct()
  {
    
  }
  
  public static function fileToString($file, $buffer = false)
  {
    if (!$buffer)
    {      
      return file_get_contents($file);
    }
    
    $file_buffer = '';
    $handle = fopen($file, "r");
    if ($handle) {
      while (!feof($handle)) {
        $file_buffer = fgets($handle);
      }
      fclose($handle);
    }
    
    return $file_buffer;
  }
  
  public static function fileToArray($file)
  {
    return file($file);
  }
}
