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
    return $this->createSkeleton($skeleton_type, $content);
  }
  
  protected function createSkeleton($skeleton_type, $content = null)
  {
    $skeleton = '';
    
    switch ($skeleton_type)
    {
      case 'error401':
        if (is_null($content))
        {          
          $skeleton = parent::generateSkeleton(innoDir::get('DATA_SKEL_ACTION').$skeleton_type.'.action.php.inc');
        }
        else
        {          
          $skeleton = $content;
        }
        break;
      case 'error403':
        if (is_null($content))
        {          
          $skeleton = parent::generateSkeleton(innoDir::get('DATA_SKEL_ACTION').$skeleton_type.'.action.php.inc');
        }
        else
        {          
          $skeleton = $content;
        }
        break;
      case 'error404':
        if (is_null($content))
        {          
          $skeleton = parent::generateSkeleton(innoDir::get('DATA_SKEL_ACTION').$skeleton_type.'.action.php.inc');
        }
        else
        {          
          $skeleton = $content;
        }
        break;
      case 'ACTION':
        if (is_null($content))
        {          
          $skeleton = parent::generateSkeleton(innoDir::get('DATA_SKEL_ACTION').$skeleton_type.'.action.php.inc');
        }
        else
        {          
          $skeleton = $content;
        }
        break;
      case 'COMPONENT':
        if (is_null($content))
        {          
          $skeleton = parent::generateSkeleton(innoDir::get('DATA_SKEL_ACTION').$skeleton_type.'.comp.php.inc');
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


