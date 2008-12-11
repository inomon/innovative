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
  
  public function skeletize($skeleton_type, $content = null)
  {
    switch ($skeleton_type)
    {
      case 'error401.tmplt.php':
        return $this->createSkeleton($skeleton_type, $content);
        break;
      case 'error401.comp.tmplt.php':
        return $this->createSkeleton($skeleton_type, $content);
        break;
      case 'error403.tmplt.php':
        return $this->createSkeleton($skeleton_type, $content);
        break;
      case 'error403.comp.tmplt.php':
        return $this->createSkeleton($skeleton_type, $content);
        break;
      case 'error404.tmplt.php':
        return $this->createSkeleton($skeleton_type, $content);
        break;
      case 'error404.comp.tmplt.php':
        return $this->createSkeleton($skeleton_type, $content);
        break;
      case 'TEMPLATE.tmplt.php':
        return $this->createSkeleton($skeleton_type, $content);
        break;
      case 'TEMPLATE.comp.tmplt.php':
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
      case 'error401.tmplt.php':
        if (!is_null($content))
          $skeleton =
"

";
        else
          $skeleton = $content;
        break;
      case 'error401.comp.tmplt.php':
        if (!is_null($content))
          $skeleton =
"

";
        else
          $skeleton = $content;
        break;
      case 'error403.tmplt.php':
        if (!is_null($content))
          $skeleton =
"

";
        else
          $skeleton = $content;
        break;
      case 'error403.comp.tmplt.php':
        if (!is_null($content))
          $skeleton =
"

";
        else
          $skeleton = $content;
        break;
      case 'error404.tmplt.php':
        if (!is_null($content))
          $skeleton =
"

";
        else
          $skeleton = $content;
        break;
      case 'error404.comp.tmplt.php':
        if (!is_null($content))
          $skeleton =
"

";
        else
          $skeleton = $content;
        break;
      case 'TEMPLATE.tmplt.php':
        if (!is_null($content))
          $skeleton =
"

";
        else
          $skeleton = $content;
        break;
      case 'TEMPLATE.comp.tmplt.php':
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
