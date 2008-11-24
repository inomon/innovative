<?php
/*
 *
 * @author:  Orlino L. Monares Jr. <ino@ooip.nl, ino@atissoftware.com, orlino_monares110987@yahoo.com>
 *
 * @package:
 * @subpackage:
 *
 * @todo: _____________
 *
 */

function image_tag($img,  $details = array())
{
  $tag = '<img src='."\"".innoDir::get('ASSETS').'img/'.$img."\"";
  foreach ($details as $attr => $property)
  {
    $tag = $tag.' '.$attr."=\"".$property."\"";
  }
  $tag = $tag.'>';
  return $tag;
}

function link_tag($name, $link = '', $details = array())
{
  if (!(strstr($link, '~') === false)) 
  {
    if (!(strstr($link, '?') === false)) 
    {
      $links = explode('?', $link);
      $link = '?go='.Routing::setRoute(substr($links[0], 1)).'&'.$links[1];
    }
    else 
      $link = '?go='.substr($link, 1);
      //$link = '?go='.$link.Routing::setRoute(substr($link, 1));
  }
  
  $tag = '<a href="'.$link.'"';
  foreach ($details as $attr => $property)
  {
    if ($attr != 'tooltip')
      $tag .= ' '.$attr.'="'.$property.'"';
  }
  
  if(array_key_exists('tooltip', $details))
  {
    if(array_key_exists('class', $details))
      $tag = str_replace($tag, 'class="'.$details['class'].' tooltip"', 'class="'.$details['class'].'"');
    else
      $tag .= ' class="tooltip"';
      
    $tag .= ' title="'.$details['tooltip'].'">';
    $tag .= script_tag("
$$('body a.tooltip').each( function(link) {
  new Tooltip(link, {});
});
    ");
  }
  else
    $tag .= '>';  
  $tag .= $name.'</a>';
  return $tag;
}

function script_tag($script, $details = array())
{
  $tag = '<script type='."\"text/javascript\"";
  foreach ($details as $attr => $property)
  {
    $tag = $tag.' '.$attr."=\"".$property."\"";
  }
  $tag = $tag.'>'.$script.'</script>';
  return $tag;
}

function style_tag($style, $details = array())
{
  $tag = '<style type='."\"text/css\"";
  foreach ($details as $attr => $property)
  {
    $tag = $tag.' '.$attr."=\"".$property."\"";
  }
  $tag = $tag.'>'.$style.'</style>';
  return $tag;
}

