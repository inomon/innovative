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

function initialize()
{
  add_proto_window_type('default', null);
}

function proto_window($url, $method, $header)
{
  return "showWindow('".$url."', '".$method."', '".$header."')";
}

function proto_window_modal($url, $method, $header)
{
  return "showModalWindow('".$url."', '".$method."', '".$header."')";
}

function proto_window_mgr($url, $method, $header)
{
  return "showWinlets('".$url."', '".$method."', '".$header."')";
}

function add_proto_window_type($type, $details = array())
{
  innoAssets::addScriptHead(_window_type($type, $details));
}

function rem_proto_window_type($type, $details = array())
{
  innoAssets::remScriptHead(_window_type($type, $details));
}

function _window_type($type, $details = array())
{
  $script = 'no matching script type: '.$type;
  
  switch($type)
  {
    case 'default':
      $script = "
var iniLeft = 20;
var iniTop = 20;
function showWindow(reqUrl, reqMethod, reqHeader) {
  iniLeft += 25;
  iniTop += 25;
  new UI.Window({width:400, left:iniLeft, top:iniTop}).show().setAjaxContent(reqUrl, {
    method: reqMethod, 
    onCreate: function() {   
      this.setContent(\"<div class='ajaxloader_message'>Please wait...</div><div class='ajaxloader'></div>\");
      this.header.update(reqHeader);
    },
    onSuccess: function(transport) {      
      this.setContent(transport.responseText);   
    }
  });
}";
      break;
    case 'modal':
      $script = "
var iniLeft = 20;
var iniTop = 20;
function showModalWindow(reqUrl, reqMethod, reqHeader) {
  new UI.Window({width:400, left:100, top:100}).show(true).setAjaxContent(reqUrl, {
    method: reqMethod, 
    onCreate: function() {   
      this.setContent(\"<div class='ajaxloader_message'>Please wait...</div><div class='ajaxloader'></div>\");
      this.header.update(reqHeader);
    },
    onSuccess: function(transport) {      
      this.setContent(transport.responseText);   
    }
  });
}";
      break;
    case 'window-manager':
      $script = "
Event.observe(window, 'load', iniWindowMgr);
var iniLeft = 0;
var iniTop = 0;
var wmName = '".$details['window_manager_div']."';
var wWidth = 320;
var wHeight = 240;

function iniWindowMgr()
{
  wMngr = new UI.WindowManager({container: wmName});
}

function showWinlets(reqUrl, reqMethod, reqHeader) {
  iniLeft += 20;
  iniTop += 20;
  if((iniLeft+(wWidth)) >= $(wmName).getWidth())
    iniLeft = 10;
  if((iniTop+(wHeight)) >= $(wmName).getHeight())
    iniTop = 10;
    
  new UI.Window({width:wWidth, height:wHeight, left:iniLeft, top:iniTop, windowManager:wMngr}).show().setAjaxContent(reqUrl, {
    method: reqMethod, 
    onCreate: function() {   
      this.setContent(\"<div class='ajaxloader_message'>Please wait...</div><div class='ajaxloader'></div>\");
      this.header.update('<span style=\'font-size:11px;\'>'+reqHeader+'</span>');
    },
    onSuccess: function(transport) {      
      this.setContent(transport.responseText);   
    }
  });
}";
      break;
  }
  
  return $script;
}

