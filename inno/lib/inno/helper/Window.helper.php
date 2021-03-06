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
 * @subpackage: helper.Window
 *
 * @todo: _____________
 *
 */

function initializeWindow()
{
  add_proto_window_type('default', null);
}

function window($window_type, $url, $method, $header)
{
  return _window($window_type, $url, $method, $header);
}

function add_window_type($type, $details = array())
{
  innoAssets::addScriptHead(_window_type($type, $details));
}

function rem_window_type($type, $details = array())
{
  innoAssets::remScriptHead(_window_type($type, $details));
}

function _window($window_type, $url, $method, $header)
{
  switch ($window_type)
  {
    case 'default':
      return "showWindow('".((APPLI!='fro') ? $_SERVER['PHP_SELF'].'/' : '').$url."', '".$method."', '".$header."')";
      break;
    case 'modal':
      return "showModalWindow('".((APPLI!='fro') ? $_SERVER['PHP_SELF'].'/' : '').$url."', '".$method."', '".$header."')";
      break;
    case 'windowmanager':
      return "showWinlets('".((APPLI!='fro') ? $_SERVER['PHP_SELF'].'/' : '').$url."', '".$method."', '".$header."')";
      break;
    default:
      die('window: '.$window_type.' doesnt exist, please provide correct type.');
      break;
  }
  
  return;
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

