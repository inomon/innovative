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
 * @subpackage: helper.Form
 *
 * @todo: _____________
 *
 */
 
function initializeForm()
{
  // initialize
}

/*
 * Creates a smart input textbox
 * 
 * @param: name     The [name] of the textbox, also associated with its [id]
 * @param: details  The details pertaining to the textbox; [class], [style], tooptip, etc.
 * 
 * @return: textbox Returns the textbox, as a string
 */
function textbox($name, $details = array())
{
  $textbox = '<input type="text" name="'.$name.'" id="'.$name.'"'._tag_details('input.textbox', $details).'/>';

  return $textbox;
}

/*
 * Creates a smart form initialization tag
 * 
 * @param: url      The url to target the form [action]
 * @param: method   The request method: POST || GET
 * @param: details  The details pertaining to the textbox; [class], [style], tooptip, etc.
 */
function form($url, $method = "post", $details = array())
{
  $form = '<form action="'.$url.'" method="'.$method.'"'._tag_details('form', $details).'>';
  
  echo $form;
}

/*
 * Creates a smart submit button 
 * 
 * @param: name     The [name] of the button, also associated with its [id]
 * @param: details  The details pertaining to the button; class, style, tooptip, etc.
 * 
 * @return: submit Returns the submit button, as a string
 */
function submit_tag($name, $details = array())
{
  $submit = '<input name="'.$name.'" id="'.$name.'"'._tag_details('input.submit', $details).'/>';
  
  return $submit;
}

/*
 * Creates a smart form termination tag
 * 
 */
function end_form($name, $details = array())
{
  echo submit_tag($name, $details);
  echo '</form>';
}

/*
 * Dummy function: for the ajax submission
 * 
 * @param: submit_to_ajax  The ajax url to target
 * @param: close           Clears submit_to_url 
 * 
 * @return: submit_to_url  The url, pertaining to the submission 
 */
function _submit_form_to_ajax($submit_to_ajax, $close = false)
{
  //static $is_ajax, $submit_to_url;
  static $submit_to_url;
  if ($close)
    return $submit_to_url;
    
  if($submit_to_ajax!=null)
  {
    $submit_to_url = $submit_to_ajax;
    return $submit_to_url;
  }
}

function _dummy_ajax_submit_status()
{
  static $close;
}
