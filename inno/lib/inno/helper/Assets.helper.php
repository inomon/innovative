<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');
/*
 * This file is a part of the inno package.
 * Copyright (C) 2008 Orlino L. Monares Jr. <anxietylost110987@gmail.com, orlino_monares110987@yahoo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
 * 
 *
 * @author:     Orlino L. Monares Jr. <anxietylost110987@gmail.com, orlino_monares110987@yahoo.com>
 * @package:    inno
 * @subpackage: helper.Assets
 *
 * @todo: _____________
 *
 */

function initializeAssets()
{
  // initialization function
}

function add_js($script)
{
  innoAssets::addScriptHead($script);
}

function add_css($style)
{
  innoAssets::addScriptHead($script);
}

function rem_js($script)
{
  innoAssets::remScriptHead($script);
}

function rem_css($style)
{
  innoAssets::remStyleHead($style);
}

function js_header($script = null)
{
  if (!$script)
  {
    return innoAssets::getScriptHead();
  }
  
  innoAssets::addScriptHead($script);
}

function css_header($style = null)
{
  if (!$style)
  {
    return innoAssets::getStyleHead();
  }
  
  innoAssets::addStyleHead($style);
}
