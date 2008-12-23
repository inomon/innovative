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
  
  /* deprecated - start */
  public function setAppController($controller)
  {
    $this->app_controller = $controller;
  }
  
  public function getAppController()
  {
    return $this->app_controller;
  }
  /* deprecated - end */
  
  public function generateAppli($controller)
  {
    $default_action = array(
      'error401' => 'error401.action.php', 
      'error403' => 'error403.action.php', 
      'error404' => 'error404.action.php', 
      'ACTION'   => 'index.action.php'
      );
    $default_tmplt = array(
      'error401' => 'error401.tmplt.php', 
      'error403' => 'error403.tmplt.php', 
      'error404' => 'error404.tmplt.php', 
      'ACTION'   => 'index.tmplt.php'
    );
    $default_conf = array(
      'app'      => 'app.yml', 
      'module'   => 'module.yml', 
      'routing'  => 'routing.yml', 
      'settings' => 'settings.yml', 
      'site'     => 'site.yml', 
      'view'     => 'view.yml', 
      'web'      => 'web.yml',
      'APPLI'    => $this->appli.'.ini.php'
    );
    $default_misc = array();
    
    parent::generateDir(innoDir::get('APP').DIR_SEP.$this->appli);
    parent::generateDir(innoDir::get('APP').DIR_SEP.$this->appli.DIR_SEP.'default.mod');
    
    // generate the default actions
    $action = new innoActionSkeleton();
    parent::setDirectory(innoDir::get('APP').DIR_SEP.$this->appli.DIR_SEP.'default.mod');
    foreach($default_action as $index => $file)
    {
      parent::generateFile($file, $action->skeletize($index));
    }
    
    // generate the default templates
    $template = new innoTemplateSkeleton();
    parent::setDirectory(innoDir::get('APP').DIR_SEP.$this->appli.DIR_SEP.'default.mod'.DIR_SEP.'tmplt');
    foreach($default_tmplt as $index => $file)
    {
      parent::generateFile($file, $template->skeletize($index));
    }
    
    // generate the default conf
    $conf = new innoConfSkeleton();
    parent::setDirectory(innoDir::get('CONF_BASE').DIR_SEP.$this->appli);
    foreach($default_conf as $index => $file)
    {
      parent::generateFile($file, $conf->skeletize($index));
    }
    
    // generate misc. files
    $misc = new innoMiscSkeleton();
    parent::setDirectory(realpath(dirname(__FILE__)));
    foreach($default_conf as $index => $file)
    {
      parent::generateFile($file, $conf->skeletize($index));
    }
    parent::generateFile($controller.'.php', str_replace('###APPLI_NAME###', $this->appli, $misc->skeletize('index')));
  }
  
  public function generateModule($module)
  {
    $module_path = innoDir::get('APP').DIR_SEP.$appli.DIR_SEP.$module.'.mod';
    parent::generateDir($module_path);
    
    $action = new innoActionSkeleton();
    parent::setDirectory($module_path);
    parent::generateFile('index.action.php', $action->skeletize('ACTION'));
    
    $template = new innoTemplateSkeleton();
    parent::setDirectory($module_path);
    parent::generateFile('index.tmplt.php', $template->skeletize('TEMPLATE'));
  }
  
  public function generateAction($actn, $module, $tmplt = null)
  {
    $appli_path = innoDir::get('APP').DIR_SEP.$this->appli.DIR_SEP.$module.'.mod';
    parent::setDirectory($appli_path);
    
    $action = new innoActionSkeleton();
    parent::generateFile($actn.'.action.php', $action->skeletize('ACTION'));
    
    if (!is_null($template))
    {
      parent::setDirectory($appli_path.DIR_SEP.'tmplt');
      $template = new innoActionSkeleton();
      parent::generateFile($tmplt.'.tmplt.php', $template->skeletize('TEMPLATE'));
    }
  }
  
  public function generateTemplate($tmplt, $module)
  {
    $appli_path = innoDir::get('APP').DIR_SEP.$this->appli.DIR_SEP.$module.'.mod'.DIR_SEP.'tmplt';
    parent::setDirectory($appli_path);
    
    $template = new innoActionSkeleton();
    parent::generateFile($tmplt.'.tmplt.php', $template->skeletize('TEMPLATE'));
  }
  
  public function generateComponent($component, $module)
  {
    $action = new innoActionSkeleton();
    parent::setDirectory(innoDir::get('APP').DIR_SEP.$this->appli.DIR_SEP.$module.'.mod');
    parent::generateFile($component.'.comp.php', $action->skeletize('COMPONENT'));
    
    $template = new innoTemplateSkeleton();
    parent::setDirectory(innoDir::get('APP').DIR_SEP.$this->appli.DIR_SEP.$module.'.mod'.DIR_SEP.'tmplt');
    parent::generateFile($component.'.comp.tmplt.php', $template->skeletize('COMPONENT'));
  }

  public function generateFragment($fragment, $module)
  {
    $template = new innoTemplateSkeleton();
    parent::setDirectory(innoDir::get('APP').DIR_SEP.$this->appli.DIR_SEP.$module.'.mod'.DIR_SEP.'tmplt');
    parent::generateFile('__'.$fragment.'.php', $template->skeletize('COMPONENT'));
  }
}
