<?php
// remove '.' & '..'
function removeUnwanted(&$array)
{
  unset($array[0]);
  unset($array[1]);
}
innoAssets::addStylesheet('dev.css');
innoAssets::addJavascript('plugins/modalbox.js');
innoAssets::addStylesheet('plugins/modalbox.css');

// scan the modules directory
$applications = array();
$appls = scandir(innoDir::get('APPLI'));
removeUnwanted($applis);

foreach ($appls as $app)
{
  $app_path = is_dir(innoDir::get('APP').$app);
  if ($app_path)
  {
    $module_dir = scandir($app_path);
    removeUnwanted($module_dir);
    var_dump($module_dir);
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

/*
// scan the modules directory
$modules = array();
$mdls = scandir(innoDir::get('D_MODULE'));
// remove '.' & '..'
unset($mdls[0]);
unset($mdls[1]);

foreach ($mdls as $mdl)
{
  if (is_dir(innoDir::get('D_MODULE').$mdl))
  {
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
    
    $modules[$truncate_mdl]['actions'] = $actns;
    $modules[$truncate_mdl]['components'] = $comps;
    $modules[$truncate_mdl]['act_templates'] = $tmplts;
    $modules[$truncate_mdl]['comp_templates'] = $comp_tmplts;
    unset($actns);
    unset($comps);
    unset($tmplts);
    unset($comp_tmplts);
  }
}
*/