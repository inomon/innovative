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

include_library('skeleton.innoSkeleton');

class innoConfSkeleton extends innoSkeleton
{
  public function __construct()
  {
    
  }
  
  public function skeletize($skeleton_type, $content = null)
  {
    return $this->createSkeleton($skeleton_type, $content);
  }
  
  protected function createSkeleton($skeleton_type, $content = null)
  {
    $skeleton = '';
    
    switch ($skeleton_type)
    {
      case 'app':
        if (is_null($content))
        {          
          $skeleton = parent::generateSkeleton(innoDir::get('DATA_SKEL_CONF').$skeleton_type.'.yml.inc');
        }
        else
        {          
          $skeleton = $content;
        }
        break;
      case 'module':
        if (is_null($content))
        {          
          $skeleton = parent::generateSkeleton(innoDir::get('DATA_SKEL_CONF').$skeleton_type.'.yml.inc');
        }
        else
        {          
          $skeleton = $content;
        }
        break;
      case 'routing':
        if (is_null($content))
        {          
          $skeleton = parent::generateSkeleton(innoDir::get('DATA_SKEL_CONF').$skeleton_type.'.yml.inc');
        }
        else
        {          
          $skeleton = $content;
        }
        break;
      case 'settings':
        if (is_null($content))
        {
          $skeleton = parent::generateSkeleton(innoDir::get('DATA_SKEL_CONF').$skeleton_type.'.yml.inc');          
        }
        else
        {          
          $skeleton = $content;
        }
        break;
      case 'site':
        if (is_null($content))
        {          
          $skeleton = parent::generateSkeleton(innoDir::get('DATA_SKEL_CONF').$skeleton_type.'.yml.inc');
        }
        else
        {          
          $skeleton = $content;
        }
        break;
      case 'view':
        if (is_null($content))
        {
          $skeleton = parent::generateSkeleton(innoDir::get('DATA_SKEL_CONF').$skeleton_type.'.yml.inc');          
        }
        else
          $skeleton = $content;
        break;
      case 'web':
        if (is_null($content))
        {          
          $skeleton = parent::generateSkeleton(innoDir::get('DATA_SKEL_CONF').$skeleton_type.'.yml.inc');
        }
        else
        {          
          $skeleton = $content;
        }
        break;
      case 'APPLI':
        if (is_null($content))
        {          
          $skeleton = parent::generateSkeleton(innoDir::get('DATA_SKEL_CONF').$skeleton_type.'.ini.php.inc');
        }
        else
        {          
          $skeleton = $content;
        }
        break;
    }
    
    return $skeleton;
  }
}
