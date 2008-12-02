<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');
/*
 * class: innoTemplateSkeleton
 *
 * @author:     Orlino L. Monares Jr. <anxietylost110987@gmail.com, orlino_monares110987@yahoo.com>
 * @package:    inno
 * @subpackage: skeleton.template
 *
 * @todo: _____________
 *
 */

require_once('..'.DIR_SEP.'innoSkeleton.class.php');

class innoTemplateSkeleton extends innoSkeleton
{
  public function __construct()
  {
    
  }
  
  public function generateSkeleton($skeleton_type, $content)
  {
    switch ($skeleton_type)
    {
      case 'error401.tmplt.php':
        break;
      case 'error401.comp.tmplt.php':
        break;
      case 'error403.tmplt.php':
        break;
      case 'error403.comp.tmplt.php':
        break;
      case 'error404.tmplt.php':
        break;
      case 'error404.comp.tmplt.php':
        break;
      case 'TEMPLATE.tmplt.php':
        break;
      case 'TEMPLATE.comp.tmplt.php':
        break;
    }
  }
}