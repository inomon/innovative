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
 * @subpackage: utilities.innoArrayToXml
 *
 * @todo: _____________
 *
 */
 
class innoArrayToXml
{
  protected $root_node = '';
  protected $root_node_details = '';
  
  public function __construct($root_node, $root_node_details)
  {
    $this->root_node = $root_node;
    $this->root_node_details = $root_node_details;
  }
  
  public function toXml($xml_array)
  {
    $xml_file = "<?xml version='1.0' encoding='utf-8'?>\n<".$this->root_node;
    foreach ($this->root_node_details as $attr => $prop)
    {
      $xml_file .= " ".$attr."='".$prop."'";
    }
    $xml_file .= '>';
    
    /*
    // content goes here
    */
    if (is_array($xml_array))
    {
      $xml_file .= $this->toNode($xml_array);
    }
    /*
    // content goes here
    */
    
    $xml_file = '</'.$this->root_node.'>';
  }
  
  protected function toNode($node)
  {
    if (!is_array($node))
    {
      return '';
    }
    
    foreach ($node as $n => $d)
    {
      $elem = '<'.$n;
      foreach ($node[$n]['details'] as $attr => $prop)
      {
        $elem .= " ".$attr."='".$prop."'";
      }
      $elem .= '>';
      unset($node[$n]['details']);
      $elem .= $this->toNode($node[$n]['nodes']);
      $elem .= '</'.$n.'>';
    }
    
    return $elem;
  }
  
}
