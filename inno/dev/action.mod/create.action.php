<?php
if(!$inno_request->isAjaxRequest())
  $this->getRequest()->forwardTo403();
  
$name = $inno_request->get('name');
$create_new = false;

if ($inno_request->get('submit') != null && !$name)
{
  $create_new = true;
}

