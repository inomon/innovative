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

// not yet implemented!!
function forwardTo($module, $action)
{
  load_action($module, $action);
  
  return;
}

/* conventional forward to errors */
function forwardTo404()
{
  throw new Error404Exception('Error: Page Not Found', 1081404);
}

function forwardTo403()
{
  throw new Error403Exception('Error: Page Access Forbidden', 1081403);
}

function forwardTo401()
{
  throw new Error401Exception('Error: Page Access Unauthorized', 1081401);
}
/* conventional forward to errors */

/* if conditions to forward to error */
function forwardTo404If($cond)
{
  if($cond)
    throw new Error404Exception('Error: Page Not Found', 1082404);
}

function forwardTo403If($cond)
{
  if($cond)
    throw new Error403Exception('Error: Page Access Forbidden', 1082403);
}

function forwardTo401If($cond)
{
  if($cond)
    throw new Error403Exception('Error: Page Access Forbidden', 1082403);
}
/* if conditions to forward to error */

/* unless conditions to forward to error */
function forwardTo404Unless($cond)
{
  if(!$cond)
    throw new Error404Exception('Error: Page Not Found', 1083404);
}

function forwardTo403Unless($cond)
{
  if(!$cond)
    throw new Error403Exception('Error: Page Access Forbidden', 1083403);
}

function forwardTo401Unless($cond)
{
  if(!$cond)
    throw new Error403Exception('Error: Page Access Forbidden', 1083403);
}
/* unless conditions to forward to error */
