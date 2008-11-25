<?php
// remove '.' & '..'
function removeUnwanted(&$array)
{
  unset($array[0]);
  unset($array[1]);
}

innoAssets::addStylesheet('dev.css');
/*
innoAssets::addJavascript('plugins/modalbox.js');
innoAssets::addStylesheet('plugins/modalbox.css');
*/
// scan the modules directory
$applications = array();
$appls = scandir(innoDir::get('APPLI'));
removeUnwanted($appls);
$ok = innoDir::get('APPLI');

foreach ($appls as $app)
{
  $app_path = innoDir::get('APPLI').$app;

  if (is_dir($app_path))
  {
    $module_dir = scandir($app_path);
    removeUnwanted($module_dir);
    
    $layout_tmplt = array();
    foreach($module_dir as $key => $content)
    {
      $module = $app_path.DIR_SEP.$content;
      if(is_dir($module))
      {
        $action_dir = scandir($module);
        removeUnwanted($action_dir);
        
        $tmplts = array();
        foreach($action_dir as $ref => $action)
        {
          $tmplt = $module.DIR_SEP.$action;
          if(is_dir($tmplt))
          {
            $tmplt_dir = scandir($tmplt);
            removeUnwanted($tmplt_dir);
            unset($action_dir[$ref]);
            $action_dir['tmplt'] = $tmplt_dir;
          }
        }
        
        unset($module_dir[$key]);
        $module_dir[$content] = $action_dir;
      }
      else
      {
        $layout_tmplt[] = $content;
        unset($module_dir[$key]);
      }
    }
    $applications[$app]['modules'] = $module_dir;
    $applications[$app]['layouts'] = $layout_tmplt;
    /*
    $modules['layout'] = '';
    $truncate_mdl = substr($mdl, 0, strpos($mdl, '.'));
    $actns = scandir(sprintf(innoDir::get('D_MODULE_ACTION'), $truncate_mdl));
    unset($actns[0]);
    unset($actns[1]);
    foreach($actns as $key => $actn)
    {
      if(is_dir(sprintf(innoDir::get('D_MODULE_ACTION'), $truncate_mdl).$actn)) unset($actns[$key]);
      else
      {
        if(!strpos($actn, '.comp.') === false)
        {
          $comps[] = $actn;
          unset($actns[$key]);
        }
      }
    }
    
    $tmplts = scandir(sprintf(innoDir::get('D_MODULE_TMPLT'), $truncate_mdl));
    unset($tmplts[0]);
    unset($tmplts[1]);
    foreach($tmplts as $key => $tmplt)
    {
      if(is_dir(sprintf(innoDir::get('D_MODULE_TMPLT'), $truncate_mdl).$tmplt)) unset($tmplts[$key]);
      else
      {
        if(!strpos($tmplt, '.comp.tmplt.') === false)
        {
          $comp_tmplts[] = $tmplt;
          unset($tmplts[$key]);
        }
      }
    }
    
    $applications[$truncate_mdl]['actions'] = $actns;
    $applications[$truncate_mdl]['components'] = $comps;
    $applications[$truncate_mdl]['act_templates'] = $tmplts;
    $applications[$truncate_mdl]['comp_templates'] = $comp_tmplts;
    unset($actns);
    unset($comps);
    unset($tmplts);
    unset($comp_tmplts);
    */
  }
}
