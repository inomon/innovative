<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');
/*
 * helper: Tag
 *
 * @author:     Orlino L. Monares Jr. <anxietylost110987@gmail.com, orlino_monares110987@yahoo.com>
 * @package:    inno
 * @subpackage: helper
 *
 * @todo: _____________
 *
 */

// function for creating an image tag
function image_tag($img,  $details = array())
{
  $tag = '<img src='."\"/".innoDir::get('ASSETS').'img/'.$img."\""._tag_details('img', $details).'>';
  return $tag;
}

// function for creating a smart link tag
function link_tag($name, $link = '', $details = array())
{
  $routing_rules = innoConfig::get('inno_routing_rules');
  $new_link = $link;
  
  if(strpos($link, '~') !== false)
  {
    $alias = substr($link, 1, ((strpos($link, '?')!==false) ? strpos($link, '?')-1 : strlen($link) ))
    $new_link = $routing_rules[$alias];
  }
  
  if (!(strpos($link, '~') !== false)) 
    $new_link .= substr($link, (strpos($link, '?'), strlen($link));
  
  $tag = '<a href="'.$new_link.'"'._tag_details('a', $details);
  $tag .= '>';
  
  // perform garbage collection
  unset($routing_rules, $new_link, $details, $name, $link);
  
  return $tag;
}

function script_tag($script, $details = array())
{
  $tag = '<script type='."\"text/javascript\""._tag_details('script', $details);
  
  $tag .= '>'.$script.'</script>';
  return $tag;
}

function style_tag($style, $details = array())
{
  $tag = '<style type='."\"text/css\""._tag_details('style', $details);
  
  $tag .= '>'.$style.'</style>';
  return $tag;
}

function _tag_details($tag_type, $details)
{
  $special_attr = array('confirm', 'tooltip');
  $tag = '';
  foreach ($details as $attr => $property)
  {
    if(array_search($attr, $special_attr) === false)
      $tag .= ' '.$attr."=\"".$property."\"";
  }  
  
  // @todo: create an algo, for binding a confirm[onlick] function into an object
  if(array_key_exists('confirm', $details))
  {
    $tag .= " onclick=\"if(confirm('".$details['confirm']."'')){return true;}else{return false;}\"";
  }
  
  return $tag;
}

