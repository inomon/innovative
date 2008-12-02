<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');
/*
 * class: innoConfSkeleton
 *
 * @author:     Orlino L. Monares Jr. <anxietylost110987@gmail.com, orlino_monares110987@yahoo.com>
 * @package:    inno
 * @subpackage: skeleton.conf
 *
 * @todo: _____________
 *
 */

require_once('..'.DIR_SEP.'innoSkeleton.class.php');

class innoConfSkeleton extends innoSkeleton
{
  public function __construct()
  {
    
  }
  
  public function generateSkeleton($skeleton_type, $content)
  {
    switch ($skeleton_type)
    {
      case 'app.yml':
        break;
      case 'module.yml':
        break;
      case 'routing.yml':
        break;
      case 'settings.yml':
        break;
      case 'site.yml':
        break;
      case 'view.yml':
        break;
      case 'web.yml':
        break;
      case 'APPLI.ini.php':
        break;
    }
  }
  
}