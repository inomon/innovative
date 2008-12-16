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
 * @subpackage: helper.Fragment
 *
 * @todo: _____________
 *
 */
 
function initializeFragment()
{
  // initialization function
}

/*
 * loads a fragment of template and returns the output to be used/rendered
 * 
 * @todo: _____________
 *
 */
function load_fragment($module, $fragment, $fragment_values = null)
{
  $fragment_file = '__'.sprintf(innoDir::get('MODULE_TMPLT'), $module).$fragment.'.php';
  if (!file_exists($fragment_file))
    return 'ERROR: The fragment does not exist. : _'.$component.'.php';
  
  if(!is_null($fragment_values))
  {
    foreach($fragment_values as $val_name, $val_content)
      $$val_name = $val_content;
  }
  
  ob_start();
  include_once($fragment_file);
  $fragment = ob_get_contents();
  ob_end_clean();
  
  return $fragment;
}

/*
 * loads a fragment of template and returns the output to be used/rendered
 * 
 * @todo: add an exception/error try-catch block when a component wants to throw that exception/error
 *
 */
function load_component($module, $component, $include_action = true, $component_values = null)
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
  
  if(!is_null($component_values))
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
