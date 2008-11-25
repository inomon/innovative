<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');

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

// clear config holder
innoConfig::clear();
// load the application configuration
innoConfig::add(Spyc::YAMLLoad(innoDir::get('CONF').'app.yml'));
// load the module configuration
innoConfig::add(Spyc::YAMLLoad(innoDir::get('CONF').'module.yml'));
// load the web configuration
innoConfig::add(Spyc::YAMLLoad(innoDir::get('CONF').'web.yml'));
// load the site configuration
innoConfig::add(Spyc::YAMLLoad(innoDir::get('CONF').'site.yml'));
// load the view configuration
innoConfig::add(Spyc::YAMLLoad(innoDir::get('CONF').'view.yml'));

// load the routing rules
innoConfig::set('inno_routing_rules', Spyc::YAMLLoad(innoDir::get('CONF').'routing.yml'));

/* @todo: check for dependencies, [DEPRECATED] */
// the directory which contains the routing rules
#$inno_routing_dir = innoDir::get('CONF').'routing.yml';
