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
 * @subpackage: helper.Loader
 *
 * @todo: _____________
 *
 */

function initializeLoader()
{
  // initialization function
}

function load_helper()
{
  if (is_string(func_get_arg(0)))
    $helpers[] = func_get_arg(0);
  else if (is_array(func_get_arg(0)))
    $helpers = func_get_arg(0);
  else
    $helpers = func_get_args();
  
  foreach ($helpers as $helper)
  {
    $file = innoDir::get('INNO_HELPER').$helper.'.helper.php';
    if(file_exists($file))
    {
      innoAutoload::addHelper($helper, $file);
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
  if (is_string(func_get_arg(0)))
    $classes[] = func_get_arg(0);
  else if (is_array(func_get_arg(0)))
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
        innoAutoload::addClass($class, $dir.$file);
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
  if (is_string(func_get_arg(0)))
    $helpers[] = func_get_arg(0);
  else if (is_array(func_get_arg(0)))
    $helpers = func_get_arg(0);
  else
    $helpers = func_get_args();
  
  foreach ($helpers as $helper)
  {
    $file = innoDir::get('MODULE_HELPER').$helper.'.helper.php';
    if(file_exists($file))
    {
      innoAutoload::addHelper($helper, $file);
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
  if (is_string(func_get_arg(0)))
    $classes[] = func_get_arg(0);
  else if (is_array(func_get_arg(0)))
    $classes = func_get_arg(0);
  else
    $classes = func_get_args();
  
  foreach ($classes as $class)
  {
    $file = innoDir::get('MODULE_CLASS').$class.'.class.php';
    
    if($class_exists)
    {
      innoAutoload::addClass($class, $dir.$file);
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


