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
 * @subpackage: helper.FishEye
 *
 * @todo: _____________
 *
 */

function initializeFishEye()
{
  innoAssets::addJavascript('plugins/fisheye.js');
  innoAssets::addStylesheet('plugins/fisheye-menu.css');
}

function fisheye_menu($menus, $div_props = null)
{
  if(!is_array($menus))
    return '<span style="color:red;text-weight:bold;">The passed argument is not a valid menu array!</span>';
  
  $menu = '<ul id="fisheye_menu">';
  foreach ($menus as $item)
  {
    $menu .= '<li><a href="'.$menus[$item]['href'].'"><img src="'.$menus[$item]['src'].'" alt="'.$menus[$item]['alt'].'"/><span>'.$menus[$item]['label'].'</span></a></li>';
  }
  $menu .= '</ul>';
  
  if (!is_null($div_props))
    $menu = '<div'._tag_details('div', $div_props).'>'.$menu.'</div>';
  else 
    $menu = '<div>'.$menu.'</div>';
    
  return $menu;
}


