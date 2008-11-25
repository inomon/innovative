<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');
/*
 *
 * @author:  Orlino L. Monares Jr. <anxietylost110987@gmail.com, orlino_monares110987@yahoo.com>
 *
 * @package:
 * @subpackage:
 *
 * @todo: _____________
 *
 */

function load_helper()
{
  $helpers = func_get_args();
  foreach ($helpers as $helper)
  {
    $file = innoDir::get('INNO_HELPER').$helper.'.helper.php';
    if(file_exists($file))
    {
      include_once($file);
      if(function_exists('initialize'))
        initialize();
    }
    else 
      die('This helper doesnt exist: '.$helper.'.helper.php');
  }
}

function load_class()
{
  $classes = func_get_args();
  foreach ($classes as $class)
  {
    $file = innoDir::get('INNO_LIB').$class.'.class.php';
    if(file_exists($file))
      include_once($file);
    else 
      die('This class doesnt exist: '.$class.'.class.php');
  }
}

function load_custom_helper()
{
  $helpers = func_get_args();
  foreach ($helpers as $helper)
  {
    $file = LIB.DIR_SEP.(($loc) ? $loc.DIR_SEP : '').$helper.'.helper.php';
    if(file_exists($file))
    {
      include_once($file);
      if(function_exists('initialize'))
        initialize();
    }
    else 
      die('This custom helper doesnt exist: '.(($loc) ? $loc.DIR_SEP : '').$helper.'.helper.php');
  }
  
  if (!$helpers)
  {
    return;
  }
  
  if (is_string($helpers))
  {
  }
  else
  {
    foreach ($helper as $helper)
      include_once(LIB.DIR_SEP.(($loc) ? $loc.DIR_SEP : '').$helper.'.helper.php');
  }
}

function load_custom_class($classes = null, $loc = '')
{
  if (!$classes)
  {
    return;
  }
  
  if (is_string($classes))
  {
    include_once(LIB.DIR_SEP.(($loc) ? $loc.DIR_SEP : '').$class.'.class.php');
  }
  else
  {
    foreach ($classes as $class)
      include_once(LIB.DIR_SEP.(($loc) ? $loc.DIR_SEP : '').$class.'.class.php');
  }

}


// @todo: add an exception/error try-catch block when a component wants to throw that exception/error
function load_component($module, $component, $include_action = true)
{
  $cmp_tmplt = sprintf(innoDir::get('MODULE_TMPLT'), $module).$component.'.comp.tmplt.php';
  if($include_action)
    $cmp = sprintf(innoDir::get('MODULE_ACTION'), $module).$component.'.comp.php';
  
  if($include_action)
    if (!file_exists($cmp))
      return 'ERROR: There is no component with that name. : '.$component.'.comp.php';
    
  if (!file_exists($cmp_tmplt))
    return 'ERROR: The components template does not exist. : '.$component.'.comp.tmplt.php';
  
  // makes the object created at the action, ('INNO' variables)  available in this component
  foreach ($GLOBALS as $key => $value)
  {
    if (is_object($value) && !(strpos($key, 'inno') === false))
    {
      $$key = $value;
    }
    if (is_string($value) && !(strpos($key, 'inno') === false))
    {
      $$key = $value;
    }
  }  
  
  if($include_action)
    include_once($cmp);

  ob_start();
  include_once($cmp_tmplt);
  $component = ob_get_contents();
  ob_end_clean();
  
  return $component;
}
