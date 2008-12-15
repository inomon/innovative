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

load_class('innoSkeleton');

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
      case 'error403.tmplt.php':
        return $this->createSkeleton($skeleton_type, $content);
        break;
      case 'error404.tmplt.php':
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
        if (is_null($content))
          $skeleton = parent::generateSkeleton(innoDir:get('DATA_SKEL_TEMPLATE').$skeleton_type.'.inc');
        else
          $skeleton = $content;
        break;
      case 'error403.tmplt.php':
        if (is_null($content))
          $skeleton = parent::generateSkeleton(innoDir:get('DATA_SKEL_TEMPLATE').$skeleton_type.'.inc');
        else
          $skeleton = $content;
        break;
      case 'error404.tmplt.php':
        if (is_null($content))
          $skeleton = parent::generateSkeleton(innoDir:get('DATA_SKEL_TEMPLATE').$skeleton_type.'.inc');
        else
          $skeleton = $content;
        break;
      case 'TEMPLATE.tmplt.php':
        if (is_null($content))
          $skeleton = parent::generateSkeleton(innoDir:get('DATA_SKEL_TEMPLATE').$skeleton_type.'.inc');
        else
          $skeleton = $content;
        break;
      case 'TEMPLATE.comp.tmplt.php':
        if (is_null($content))
          $skeleton = parent::generateSkeleton(innoDir:get('DATA_SKEL_TEMPLATE').$skeleton_type.'.inc');
        else
          $skeleton = $content;
        break;
    }
    
    return $skeleton;
  }
}
