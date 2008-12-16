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
 * @subpackage: templater.innoTemplateGenerator
 *
 * @todo: _____________
 *
 */

load_class('innoGenerator', 'innoActionSkeleton', 'innoConfSkeleton', 'innoMiscSkeleton', 'innoTemplateSkeleton');

class innoTemplateGenerator extends innoGenerator
{
  protected $appli;
  protected $app_controller;
  
  public function __construct($appli)
  {
    $this->appli = $appli;
  }
  
  public function setAppController($controller)
  {
    $this->app_controller = $controller;
  }
  
  public function getAppController()
  {
    return $this->app_controller;
  }
  
  public function generateAppli()
  {
    $default_action = array('error401.action.php', 'error403.action.php', 'error404.action.php');
    $default_tmplt = array('error401.tmplt.php', 'error403.tmplt.php', 'error404.tmplt.php');
    $default_conf = array('app.yml', 'module.yml', 'routing.yml', 'settings.yml', 'site.yml', 'view.yml', 'web.yml');
    $default_misc = array();
    
    parent::generateDir(innoDir::get('APP').DIR_SEP.$this->appli);
    parent::generateDir(innoDir::get('APP').DIR_SEP.$this->appli.DIR_SEP.'default.mod');
    
    // generate the default actions
    $action = new innoActionSkeleton();
    parent::setDirectory(innoDir::get('APP').DIR_SEP.$this->appli.DIR_SEP.'default.mod');
    $foreach($default_action as $file)
    {
      parent::generateFile($file, $action->skeletize($file));
    }
    parent::generateFile('index.action.php', $action->skeletize('ACTION.action.php'));
    
    // generate the default templates
    $template = new innoTemplateSkeleton();
    parent::setDirectory(innoDir::get('APP').DIR_SEP.$this->appli.DIR_SEP.'default.mod'.DIR_SEP.'tmplt');
    $foreach($default_tmplt as $file)
    {
      parent::generateFile($file, $template->skeletize($file));
    }
    parent::generateFile('index.tmplt.php', $action->skeletize('TEMPLATE.tmplt.php'));
    
    // generate the default conf
    $conf = new innoConfSkeleton();
    parent::setDirectory(innoDir::get('CONF_BASE').DIR_SEP.$this->appli);
    $foreach($default_conf as $file)
    {
      parent::generateFile($file, $conf->skeletize($file));
    }
    parent::generateFile($this->appli.'.ini.php', $action->skeletize('APPLI.ini.php'));
    
    // generate misc. files
    $conf = new innoMiscSkeleton();
    parent::setDirectory(realpath(dirname(__FILE__));
    parent::generateFile($this->getAppController().'.php', str_replace('###APPLI_NAME###', $this->appli, $action->skeletize('index.php')));
  }
  
  public function generateModule($module)
  {
    $module_path = innoDir::get('APP').DIR_SEP.$appli.DIR_SEP.$module.'.mod';
    parent::generateDir($module_path);
    
    $action = new innoActionSkeleton();
    parent::setDirectory($module_path);
    parent::generateFile('index.action.php', $action->skeletize('ACTION.action.php'));
    
    $template = new innoTemplateSkeleton();
    parent::setDirectory($module_path);
    parent::generateFile('index.tmplt.php', $template->skeletize('TEMPLATE.tmplt.php'));
  }
  
  public function generateActionFile($actn, $module, $tmplt = null)
  {
    $appli_path = innoDir::get('APP').DIR_SEP.$this->appli.DIR_SEP.$module.'.mod';
    parent::setDirectory($appli_path);
    $action = new innoActionSkeleton();
    parent::generateFile($actn.'.action.php', $action->skeletize('ACTION.action.php'));
    
    if (!is_null($template))
    {
      parent::setDirectory($appli_path.DIR_SEP.'tmplt');
      $template = new innoActionSkeleton();
      parent::generateFile($tmplt.'.tmplt.php', $template->skeletize('TEMPLATE.tmplt.php'));
    }
  }
  
  public function generateTemplateFile($tmplt, $module)
  {
    $appli_path = innoDir::get('APP').DIR_SEP.$this->appli.DIR_SEP.$module.'.mod'.DIR_SEP.'tmplt';
    parent::setDirectory($appli_path);
    $template = new innoActionSkeleton();
    parent::generateFile($tmplt.'.tmplt.php', $template->skeletize('TEMPLATE.tmplt.php'));
  }
  
  public function generateComponentFile($file)
  {
    parent::generateFile($file);
  }
}
