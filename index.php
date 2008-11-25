<?php
define('DIR_SEP', '/');
define('LIB',     realpath(dirname(__FILE__).DIR_SEP.'inno'));
define('APPLI',   'fro');
define('DEBUG',   true);

require_once(LIB.DIR_SEP.'conf'.DIR_SEP.'config.php');

$controller = new innoController();
$controller->run();
