<?php
if(!$inno_request->isAjaxRequest())
  $inno_request->forwardToSecure();
