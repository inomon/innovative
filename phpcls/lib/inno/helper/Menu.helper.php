<?php
/*
 * @desc: Provides a helper for a 3 dimensional menu
 * 
 * @author:  Orlino L. Monares Jr. <ino@ooip.nl, ino@atissoftware.com, orlino_monares110987@yahoo.com>
 *
 * @package:
 * @subpackage:
 *
 * @todo: _____________
 *
 */

/*
 * Create a rich menu based on th type chosen.
 * Type: simple.horizontal, 
 * 
 * items <array>  the list of items to render as menu
 * type  <string> the type of menu
 *
 * return menu <string>
 *
 */
function create_rich_menu($items, $type = 'simple.horizontal')
{
  $menu = '';
  $menu_category = substr($type, 0, strpos($type, "."));
  
  switch ($type)
  {
    case 'simple.horizontal':
      innoAssets::addStylesheet('dropdown/dropdown.css');
      innoAssets::addStylesheet('dropdown/themes/default/default.css');
      $menu = _menu_list($items, 'dropdown dropdown-horizontal');
      break;
    case 'simple.horizontal.upward':
      innoAssets::addStylesheet('dropdown/dropdown.upward.css');
      innoAssets::addStylesheet('dropdown/themes/default/default.css');
      $menu = _menu_list($items, 'dropdown dropdown-horizontal dropdown-upward');
      break;
    case 'simple.vertical':
      innoAssets::addStylesheet('dropdown/dropdown.css');
      innoAssets::addStylesheet('dropdown/dropdown.vertical.css');
      innoAssets::addStylesheet('dropdown/themes/default/default.css');
      $menu = _menu_list($items, 'dropdown dropdown-vertical');
      break;
    case 'simple.vertical.rtl':
      innoAssets::addStylesheet('dropdown/dropdown.css');
      innoAssets::addStylesheet('dropdown/dropdown.vertical.css');
      innoAssets::addStylesheet('dropdown/dropdown.vertical.rtl.css');
      innoAssets::addStylesheet('dropdown/themes/default/default.css');
      $menu = _menu_list($items, 'dropdown dropdown-vertical dropdown-vertical-rtl');
      break;
    case 'simple.linear':
      innoAssets::addStylesheet('dropdown/dropdown.linear.css');
      innoAssets::addStylesheet('dropdown/themes/default/default.linear.css');
      $menu = _menu_list($items, 'dropdown dropdown-linear');
      break;
    case 'ultimate.horizontal':
      innoAssets::addStylesheet('dropdown/dropdown.css');
      innoAssets::addStylesheet('dropdown/themes/default/default.ultimate.css');
      $menu = _menu_list($items, 'dropdown dropdown-horizontal', $menu_category);
      break;
    case 'ultimate.horizontal.upward':
      innoAssets::addStylesheet('dropdown/dropdown.upward.css');
      innoAssets::addStylesheet('dropdown/themes/default/default.ultimate.css');
      $menu = _menu_list($items, 'dropdown dropdown-upward', $menu_category);
      break;
    case 'ultimate.vertical':
      innoAssets::addStylesheet('dropdown/dropdown.css');
      innoAssets::addStylesheet('dropdown/dropdown.vertical.css');
      innoAssets::addStylesheet('dropdown/themes/default/default.ultimate.css');
      $menu = _menu_list($items, 'dropdown dropdown-vertical', $menu_category);
      break;
    case 'ultimate.vertical.rtl':
      innoAssets::addStylesheet('dropdown/dropdown.css');
      innoAssets::addStylesheet('dropdown/dropdown.vertical.css');
      innoAssets::addStylesheet('dropdown/dropdown.vertical.rtl.css');
      innoAssets::addStylesheet('dropdown/themes/default/default.ultimate.css');
      $menu = _menu_list($items, 'dropdown dropdown-vertical dropdown-vertical-rtl', $menu_category);
      break;
    case 'ultimate.linear':
      innoAssets::addStylesheet('dropdown/dropdown.linear.css');
      innoAssets::addStylesheet('dropdown/themes/default/helper.css');
      innoAssets::addStylesheet('dropdown/themes/default/default.ultimate.linear.css');
      $menu = _menu_list($items, 'dropdown dropdown-linear', $menu_category);
      break;
    default:
      $menu = '';
      break;
  }
  
  if ($menu == '')
  {
    return "That menu [$type] style doesnt exist!";
  }
  
  innoAssets::incJsLib('jquery');
  innoAssets::addJavascript('jquery/jquery.dropdown.js');

  return $menu;
}

function _menu_list($items, $ul_class_type, $menu_category = 'simple')
{
  $menu = '<div class="menu navigation">'."\n";
  $menu = $menu.'<ul id="nav" class="'.$ul_class_type.'">'."\n";
  foreach ($items as $menu_key => $item)
  {
    if (is_array($item))
    {
      if ($menu_category == 'simple')
      {
        $menu = $menu.'<li class='."\"".'dir'."\">".((!$items[$menu_key]['link']) ? $menu_key : link_tag($menu_key, $items[$menu_key]['link']) ).'<ul>'."\n";
      }
      else
      {
        $menu = $menu.'<li>'.((!$items[$menu_key]['link']) ? '<span class="dir">'.$menu_key.'</span>' : link_tag($menu_key, $items[$menu_key]['link'], array('class'=>'dir')) ).'<ul>'."\n";
      }
      foreach ($item as $submenu_key => $itm)
      {
        if (is_array($itm))
        {
          if ($menu_category == 'simple')
          {
            $menu = $menu.'<li class='."\"".'dir'."\">".((!$items[$menu_key][$submenu_key]['link']) ? $submenu_key : link_tag($submenu_key, $item[$submenu_key]['link']) ).'<ul>'."\n";
          }
          else
          {
            $menu = $menu.'<li>'.((!$items[$menu_key][$submenu_key]['link']) ? '<span class="dir">'.$submenu_key.'</span>' : link_tag($submenu_key, $item[$submenu_key]['link'], array('class'=>'dir')) ).'<ul>'."\n";
          }
          foreach ($itm as $subsubmenu_key => $tm)
          {
            $menu = $menu.'<li>'.link_tag($subsubmenu_key, $tm).'</li>'."\n";        
          }
          $menu = $menu.'</ul></li>'."\n";
        }
        else if($submenu_key != 'link')
        {
          $menu = $menu.'<li>'.link_tag($submenu_key, $itm).'</li>'."\n";                
        }
      }
      $menu = $menu.'</ul></li>'."\n";
    }
    else
    {
      $menu = $menu.'<li>'.link_tag($menu_key, $item).'</li>'."\n";
    }
  }
  $menu = $menu.'<ul>'."\n";
  $menu = $menu.'</div>'."\n";
  
  return $menu;
}

