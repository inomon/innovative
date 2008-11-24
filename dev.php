<?php
define('DIR_SEP', '/');
define('LIB',     realpath(dirname(__FILE__)));
define('ENV',     'dev');

require_once(LIB.DIR_SEP.'conf'.DIR_SEP.'config.php');
