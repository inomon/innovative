<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');
/*
 * class: innoMiscSkeleton
 *
 * @author:     Orlino L. Monares Jr. <anxietylost110987@gmail.com, orlino_monares110987@yahoo.com>
 * @package:    inno
 * @subpackage: skeleton.misc
 *
 * @todo: _____________
 *
 */

require_once('..'.DIR_SEP.'innoSkeleton.class.php');

class innoMiscSkeleton extends innoSkeleton
{
  public function __construct()
  {
    
  }
  
  public function skeletize($skeleton_type, $content = null)
  {
    switch ($skeleton_type)
    {
      case '':
        return $this->createSkeleton($skeleton_type, $content);
        break;
      case '':
        return $this->createSkeleton($skeleton_type, $content);
        break;
    }
    
    return;
  }
  
  protected function createSkeleton($skeleton_type, $content = null)
  {
    $skeleton = '';
    
    switch ($skeleton_type)
    {
      case '':
        if (!is_null($content))
          $skeleton =
"

";
        else
          $skeleton = $content;
        break;
      case '':
        if (!is_null($content))
          $skeleton =
"

";
        else
          $skeleton = $content;
        break;
    }
    
    return $skeleton;
  }
}
