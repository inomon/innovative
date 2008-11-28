<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');
/*
 * class: innoTemplateGenerator
 *
 * @author:     Orlino L. Monares Jr. <anxietylost110987@gmail.com, orlino_monares110987@yahoo.com>
 * @package:    inno
 * @subpackage: templater
 *
 * @todo: _____________
 *
 */

require_once('innoGenerator.class.php');

class innoTemplateGenerator extends innoGenerator
{
  public function __construct()
  {
    
  }
  
  public function generateActionFile()
  {
    $this->generateFile();
  }
  
  public function generateTemplateFile()
  {
    
  }
  
  public function generateComponentFile()
  {
    
  }
}
