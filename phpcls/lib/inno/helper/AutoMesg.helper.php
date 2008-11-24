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

function textbox_automsg($textbox, $msg, $auto_close = true)
{
  _automsg_assets();
  $auto_msg_cnt = _automsg_count();
  if (!$auto_close)
    $textbox = $textbox.' onFocus="javascript:showMsg('.$auto_msg_cnt.')" />'."\n".'<input id="msgstatus'.$auto_msg_cnt.'" type="hidden" value="0" />'."\n".'<div class="msg" id="msg'.$auto_msg_cnt.'" style="display:none;">'.$msg."\n".'<br /><a href="#" onclick="javascript:hideMenu('.$auto_msg_cnt.')">Close</a></div>'."\n";
  else
    $textbox = $textbox.' onFocus="javascript:showMsg('.$auto_msg_cnt.')" onmouseout="javascript:hideMenu('.$auto_msg_cnt.')" />'."\n".'<input id="msgstatus'.$auto_msg_cnt.'" type="hidden" value="0" />'."\n".'<div class="msg" id="msg'.$auto_msg_cnt.'" style="display:none;">'.$msg."\n".'</div>'."\n";

  return $textbox;
}

function link_automsg($link, $name, $msg, $auto_close = true)
{
  _automsg_assets();
  $auto_msg_cnt = _automsg_count();
  if (!$auto_close)
    $link = $link.' onmouseover="javascript:showMsg('.$auto_msg_cnt.')">'."\n".$name.'<input id="msgstatus'.$auto_msg_cnt.'" type="hidden" value="0" />'."\n".'<div class="msg" id="msg'.$auto_msg_cnt.'" style="display:none;">'.$msg."\n".'<br /><a href="#" onclick="javascript:hideMenu('.$auto_msg_cnt.')">Close</a></div>'."\n";
  else
    $link = $link.' onmouseover="javascript:showMsg('.$auto_msg_cnt.')" onmouseout="javascript:hideMenu('.$auto_msg_cnt.')">'."\n".$name.'<input id="msgstatus'.$auto_msg_cnt.'" type="hidden" value="0" />'."\n".'<div class="msg" id="msg'.$auto_msg_cnt.'" style="display:none;">'.$msg."\n".'</div>'."\n";
  
  return $link;
}

function _automsg_count()
{
  static $cnt = 1;
  return $cnt++;
}

function _automsg_assets()
{
  Assets::incJsLib('prototype');
  Assets::incJsLib('scriptaculous');
  
  Assets::addScriptHead(
    "
function showMsg(idElement){
	idEl=idElement;
	msgStatus = document.getElementById('msgstatus'+idEl);
	if(msgStatus.value==0){
		msgStatus.value=1;
		Effect.toggle('msg'+idEl,'appear'); return false;
	}
}
function hideMenu(idElement){
	idEl=idElement;
	msgStatus = document.getElementById('msgstatus'+idEl);
	if(msgStatus.value==1){
		msgStatus.value=0;
		Effect.toggle('msg'+idEl,'appear'); return false;
	}
}
    "
  );
  Assets::addStyleHead(
    "
div.msg{ 
  position:absolute;
	background:#333333 url(img/arw.gif) no-repeat left top;  
	color:#FFFFFF;
	margin-left:0px; 
	padding:6px;
	padding-top:22px; 
	width:200px;
}
div.msg a{color:#999999;}
    "    
  );
}

