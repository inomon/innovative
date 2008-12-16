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
 * @subpackage: skeleton.conf.innoConfSkeleton
 *
 * @todo: _____________
 *
 */

load_class('innoSkeleton');

class innoConfSkeleton extends innoSkeleton
{
  public function __construct()
  {
    
  }
  
  public function skeletize($skeleton_type, $content = null)
  {
    switch ($skeleton_type)
    {
      case 'app.yml':
        return $this->createSkeleton($skeleton_type, $content);
        break;
      case 'module.yml':
        return $this->createSkeleton($skeleton_type, $content);
        break;
      case 'routing.yml':
        return $this->createSkeleton($skeleton_type, $content);
        break;
      case 'settings.yml':
        return $this->createSkeleton($skeleton_type, $content);
        break;
      case 'site.yml':
        return $this->createSkeleton($skeleton_type, $content);
        break;
      case 'view.yml':
        return $this->createSkeleton($skeleton_type, $content);
        break;
      case 'web.yml':
        return $this->createSkeleton($skeleton_type, $content);
        break;
      case 'APPLI.ini.php':
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
      case 'app.yml':
        if (is_null($content))
          $skeleton = parent::generateSkeleton(innoDir::get('DATA_SKEL_CONF').$skeleton_type.'.inc');
        else
          $skeleton = $content;
        break;
      case 'module.yml':
        if (is_null($content))
          $skeleton = parent::generateSkeleton(innoDir::get('DATA_SKEL_CONF').$skeleton_type.'.inc');
        else
          $skeleton = $content;
        break;
      case 'routing.yml':
        if (is_null($content))
          $skeleton = parent::generateSkeleton(innoDir::get('DATA_SKEL_CONF').$skeleton_type.'.inc');
        else
          $skeleton = $content;
        break;
      case 'settings.yml':
        if (is_null($content))
          $skeleton = parent::generateSkeleton(innoDir::get('DATA_SKEL_CONF').$skeleton_type.'.inc');
        else
          $skeleton = $content;
        break;
      case 'site.yml':
        if (is_null($content))
          $skeleton = parent::generateSkeleton(innoDir::get('DATA_SKEL_CONF').$skeleton_type.'.inc');
        else
          $skeleton = $content;
        break;
      case 'view.yml':
        if (is_null($content))
          $skeleton = parent::generateSkeleton(innoDir::get('DATA_SKEL_CONF').$skeleton_type.'.inc');
        else
          $skeleton = $content;
        break;
      case 'web.yml':
        if (is_null($content))
          $skeleton = parent::generateSkeleton(innoDir::get('DATA_SKEL_CONF').$skeleton_type.'.inc');
        else
          $skeleton = $content;
        break;
      case 'APPLI.ini.php':
        if (is_null($content))
          $skeleton = parent::generateSkeleton(innoDir::get('DATA_SKEL_CONF').$skeleton_type.'.inc');
        else
          $skeleton = $content;
        break;
    }
    
    return $skeleton;
  }
}
