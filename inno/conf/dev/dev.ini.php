<?php if ( ! defined('LIB')) exit('Direct script access is not allowed!');

if(APPLI=='dev') 
{
  innoDir::set('D_ASSETS', innoDir::get('ASSETS'));
  innoDir::set('D_MODULE', innoDir::get('MODULE'));
  innoDir::set('D_MODULE_ACTION', innoDir::get('MODULE_ACTION'));
  innoDir::set('D_MODULE_TMPLT', innoDir::get('MODULE_TMPLT'));

//  innoDir::set('CONF', innoDir::get('CONF').DIR_SEP.'dev'.DIR_SEP);
//  innoDir::set('ASSETS', '../');
  innoDir::set('MODULE', innoDir::get('DEV_MODULE'));
  innoDir::set('MODULE_ACTION', innoDir::get('DEV_MODULE_ACTION'));
  innoDir::set('MODULE_TMPLT', innoDir::get('DEV_MODULE_TMPLT'));
  innoDir::set('MODULE_TMPLT', innoDir::get('DEV_MODULE_TMPLT'));
}
