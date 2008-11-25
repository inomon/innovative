<?php
define('DIR_SEP', '/');
define('LIB',     realpath(dirname(__FILE__).DIR_SEP.'inno'));
define('APPLI',   'bak');
define('DEBUG',   false);

require_once(LIB.DIR_SEP.'conf'.DIR_SEP.'config.php');

$controller = new innoController();
$controller->run();
