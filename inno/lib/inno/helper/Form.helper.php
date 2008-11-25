<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');
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

/*
 * Creates a textbox input with options for a tooltip
 * 
 * @param: name     The [name] of the textbox, also associated with its [id]
 * @param: details  The details pertaining to the textbox; [class], [style], tooptip, etc.
 * 
 * @return: textbox Returns the textbox, as a string
 */
function textbox($name, $details = array())
{
  $textbox = '<input type="text" name="'.$name.'" id="'.$name.'"';
  foreach ($details as $attr => $property)
  {
    if ($attr != 'tooltip' && $attr != 'form_name')
      $textbox .= ' '.$attr.'="'.$property.'"';      
  }
  
  if(array_key_exists('tooltip', $details))
  {
    if(array_key_exists('class', $details))
      $textbox = str_replace('class="'.$details['class'].'"', 'class="'.$details['class'].' tooltip"', $textbox);
    else
      $textbox .= ' class="tooltip"';
      
    $textbox .= ' title="'.$details['tooltip'].'" />';
    $textbox .= script_tag("
$$('form input.tooltip').each( function(input) {
  new Tooltip(input, {});
});
    ");
  }
  else
  {
    $textbox .= '/>';
  }

  return $textbox;
}

/*
 * Creates a form initialization tag
 * 
 * @param: url      The url to target the form [action]
 * @param: method   The request method: POST || GET
 * @param: details  The details pertaining to the textbox; [class], [style], tooptip, etc.
 */
function form($url, $method = "post", $details = array())
{
  $form = '<form action="'.$url.'" method="'.$method.'"';
  foreach ($details as $attr => $property)
  {
    if($attr!='submit_to_ajax')
      $form .= ' '.$attr.'="'.$property.'"';
    else
      _submit_form_to_ajax($property);
  }
  $form .= '/>';
  echo $form;
}

/*
 * Creates a submit button 
 * 
 * @param: name     The [name] of the button, also associated with its [id]
 * @param: details  The details pertaining to the button; class, style, tooptip, etc.
 * 
 * @return: submit Returns the submit button, as a string
 */
function submit_tag($name, $details = array())
{
  $is_submitted_to_ajax = false;
  $submit = '<input name="'.$name.'" id="'.$name.'"';
  foreach ($details as $attr => $property)
  {
    if($attr!='submit_to_ajax')
      $submit .= ' '.$attr.'="'.$property.'"';
    else
      $is_submitted_to_ajax = true;
  }
  if(!$is_submitted_to_ajax)
    $submit .= ' type="submit" ';
  else
    $submit .= ' type="button" onclick="'._submit_form_to_ajax(null, true).'"';
  $submit .= '/>';
  
  return $submit;
}

/*
 * Creates a form termination tag
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
