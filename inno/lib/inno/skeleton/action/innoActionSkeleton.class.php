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
 * @subpackage: skeleton.action.innoActionSkeleton
 *
 * @todo: _____________
 *
 */

load_class('innoSkeleton');

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
      case 'error403.action.php':
        return $this->createSkeleton($skeleton_type, $content);
        break;
      case 'error404.action.php':
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
        if (is_null($content))
          $skeleton = parent::generateSkeleton(innoDir::get('DATA_SKEL_ACTION').$skeleton_type.'.inc');
        else
          $skeleton = $content;
        break;
      case 'error403.action.php':
        if (is_null($content))
          $skeleton = parent::generateSkeleton(innoDir::get('DATA_SKEL_ACTION').$skeleton_type.'.inc');
        else
          $skeleton = $content;
        break;
      case 'error404.action.php':
        if (is_null($content))
          $skeleton = parent::generateSkeleton(innoDir::get('DATA_SKEL_ACTION').$skeleton_type.'.inc');
        else
          $skeleton = $content;
        break;
      case 'ACTION.action.php':
        if (is_null($content))
          $skeleton = parent::generateSkeleton(innoDir::get('DATA_SKEL_ACTION').$skeleton_type.'.inc');
        else
          $skeleton = $content;
        break;
      case 'COMP.comp.php':
        if (is_null($content))
          $skeleton = parent::generateSkeleton(innoDir::get('DATA_SKEL_ACTION').$skeleton_type.'.inc');
        else
          $skeleton = $content;
        break;
    }    
    
    return $skeleton;
  }
}


