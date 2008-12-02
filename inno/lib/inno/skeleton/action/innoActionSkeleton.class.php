<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');
/*
 * class: innoActionSkeleton
 *
 * @author:     Orlino L. Monares Jr. <anxietylost110987@gmail.com, orlino_monares110987@yahoo.com>
 * @package:    inno
 * @subpackage: skeleton.action
 *
 * @todo: _____________
 *
 */

require_once('..'.DIR_SEP.'innoSkeleton.class.php');

class innoActionSkeleton extends innoSkeleton
{
  public function __construct()
  {
    
  }
  
  public function generateSkeleton($skeleton_type, $content)
  {
    switch ($skeleton_type)
    {
      case 'error401.action.php':
        break;
      case 'error401.comp.php':
        break;
      case 'error403.action.php':
        break;
      case 'error403.comp.php':
        break;
      case 'error404.action.php':
        break;
      case 'error404.comp.php':
        break;
      case 'ACTION.action.php':
        break;
      case 'COMP.comp.php':
        break;
    }
  }
}