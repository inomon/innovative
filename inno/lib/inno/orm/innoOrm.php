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
 * @subpackage: orm.innoOrm
 *
 * @todo: _____________
 *
 */

class innoOrm
{
  protected $orm = '';
  
  public function __construct($orm)
  {
    $this->setOrm($orm);
  }
  
  public function setOrm($orm)
  {
    $this->orm = $orm;
  }
  
  public function getOrm()
  {
    return $this->orm;
  }
  
  public function setProperties($properties = null)
  {
    if (!is_array($properties))
    {
      return;
    }
    
    return;
  }
}