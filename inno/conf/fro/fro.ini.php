<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');

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

// the directory which contains the routing rules
$inno_routing_dir = innoDir::get('CONF').'routing.yml';
