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
  
  public function skeletize($skeleton_type, $content = null)
  {
    switch ($skeleton_type)
    {
      case 'error401.action.php':
        return $this->createSkeleton($skeleton_type, $content);
        break;
      case 'error401.comp.php':
        return $this->createSkeleton($skeleton_type, $content);
        break;
      case 'error403.action.php':
        return $this->createSkeleton($skeleton_type, $content);
        break;
      case 'error403.comp.php':
        return $this->createSkeleton($skeleton_type, $content);
        break;
      case 'error404.action.php':
        return $this->createSkeleton($skeleton_type, $content);
        break;
      case 'error404.comp.php':
        return $this->createSkeleton($skeleton_type, $content);
        break;
      case 'ACTION.action.php':
        return $this->createSkeleton($skeleton_type, $content);
        break;
      case 'COMP.comp.php':
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
      case 'error401.action.php':
        if (!is_null($content))
          $skeleton =
"

";
        else
          $skeleton = $content;
        break;
      case 'error401.comp.php':
        if (!is_null($content))
          $skeleton =
"

";
        else
          $skeleton = $content;
        break;
      case 'error403.action.php':
        if (!is_null($content))
          $skeleton =
"

";
        else
          $skeleton = $content;
        break;
      case 'error403.comp.php':
        $skeleton =
"

";
        break;
      case 'error404.action.php':
        if (!is_null($content))
          $skeleton =
"

";
        else
          $skeleton = $content;
        break;
      case 'error404.comp.php':
        if (!is_null($content))
          $skeleton =
"

";
        else
          $skeleton = $content;
        break;
      case 'ACTION.action.php':
        if (!is_null($content))
          $skeleton =
"

";
        else
          $skeleton = $content;
        break;
      case 'COMP.comp.php':
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


