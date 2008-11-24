<?php
if(!$inno_request->isAjaxRequest())
  $inno_request->forwardToSecure();
  
$name = $inno_request->getParam('name');
$create_new = false;

if ($inno_request->getParam('submit') != null && !$name)
{
  $create_new = true;
}

