<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');
/*
 * helper: Loader
 *
 * @author:     Orlino L. Monares Jr. <anxietylost110987@gmail.com, orlino_monares110987@yahoo.com>
 * @package:    inno
 * @subpackage: helper
 *
 * @todo: _____________
 *
 */

function load_helper()
{
  if (is_array(func_get_arg(0)))
    $helpers = func_get_arg(0);
  else
    $helpers = func_get_args();
  
  foreach ($helpers as $helper)
  {
    $file = innoDir::get('INNO_HELPER').$helper.'.helper.php';
    if(file_exists($file))
    {
      innoAutoload::addHelper($file);
      include_once($file);
      $ini = 'initialize'.$helper;
      if(function_exists($ini))
        $ini();
    }
    else 
      die('This helper doesnt exist: '.$file);
  }
  
  return;
}

function load_class()
{
  if (is_array(func_get_arg(0)))
    $classes = func_get_arg(0);
  else
    $classes = func_get_args();
  
  foreach ($classes as $class)
  {
    $class_exists = false;
    $file = $class.'.class.php';
    foreach (innoDir::get('INNO_LIB_DIRS') as $dir)
    {
      if(file_exists($dir.$file))
      {
        innoAutoload::addClass($dir.$file);
        $file = $dir.$file;
        $class_exists = true;
        break;
      }
    }
    
    if($class_exists)
      include_once($file);
    else 
      die('This class doesnt exist: '.$file);
  }
  
  return;
}

function app_helper()
{
  if (is_array(func_get_arg(0)))
    $helpers = func_get_arg(0);
  else
    $helpers = func_get_args();
  
  foreach ($helpers as $helper)
  {
    $file = innoDir::get('MODULE_HELPER').$helper.'.helper.php';
    if(file_exists($file))
    {
      innoAutoload::addHelper($file);
      include_once($file);
      $ini = 'initialize'.$helper;
      if(function_exists($ini))
        $ini();
    }
    else 
      die('This helper doesnt exist: '.$file);
  }
  
  return;
}

function app_class()
{
  if (is_array(func_get_arg(0)))
    $classes = func_get_arg(0);
  else
    $classes = func_get_args();
  
  foreach ($classes as $class)
  {
    $file = innoDir::get('MODULE_CLASS').$class.'.class.php';
    
    if($class_exists)
    {
      innoAutoload::addClass($dir.$file);
      include_once($file);
    }
    else 
      die('This class doesnt exist: '.$file);
  }
  
  return;
}

function load_helper_from_cache()
{
  $helpers = func_get_arg(0);
  
  foreach ($helpers as $helper)
  {
    $substr_end = strpos($helper, '.')-1;
    $substr_str = strrpos($helper, ((stripos($_SERVER["DOCUMENT_ROOT"], ':') === false) ? "/" : "\\" ))+1;
    $helper_name = substr($helper, $substr_str, $substr_end);
    
    include_once($helper);
    $ini = 'initialize'.$helper_name;
    if(function_exists($ini))
      $ini();
  }
  
  return;
}

function load_class_from_cache()
{
  $classes = func_get_arg(0);
  
  foreach ($classes as $class)
  {
    $substr_end = strpos($class, '.')-1;
    $substr_str = strrpos($class, ((stripos($_SERVER["DOCUMENT_ROOT"], ':') === false) ? "/" : "\\" ))+1;
    $class_name = substr($class, $substr_str, $substr_end);
    
    include_once($class);
    $ini = 'initialize'.$class_name;
    if(function_exists($ini))
      $ini();
  }
  
  return;
}

// @todo: add an exception/error try-catch block when a component wants to throw that exception/error
function load_component($module, $component, $include_action = true, $component_values = array())
{
  $cmp_tmplt = sprintf(innoDir::get('MODULE_TMPLT'), $module).$component.'.comp.tmplt.php';
  if($include_action)
    $cmp = sprintf(innoDir::get('MODULE_ACTION'), $module).$component.'.comp.php';
  
  if($include_action)
    if (!file_exists($cmp))
      return 'ERROR: There is no component with that name. : '.$component.'.comp.php';
    
  if (!file_exists($cmp_tmplt))
    return 'ERROR: The components template does not exist. : '.$component.'.comp.tmplt.php';
  
  // @todo: test for dependencies, [DEPRECATED]
  /* start DEPRECATION MARK */
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
  /* end DEPRECATION MARK */
  
  if(count($component_values) > 0 && !is_null($component_values))
  {
    foreach($component_values as $val_name, $val_content)
      $$val_name = $val_content;
  }
  
  if($include_action)
    include_once($cmp);

  ob_start();
  include_once($cmp_tmplt);
  $component = ob_get_contents();
  ob_end_clean();
  
  return $component;
}

