<?php load_helper('Widget') ?>
<?php rem_proto_window_type('default') ?>
<?php add_proto_window_type('window-manager', array('window_manager_div'=>'window-manager')) ?>
MODULES: 
<?php echo link_tag(
  image_tag('add.gif', array('width'=>'11px','height'=>'11px')),
  '#', 
  array(
    "onclick"=>"if(!confirm('Create new module?')){return false;}else{".proto_window_mgr('module_add', 'get', 'innovative: New Module')."; return false;}"
  )) ?>
<ul class="treeview">
<?php foreach($modules as $key => $files): ?>
  <li class="parent"> 
  Module: <?php echo $key ?>
  <?php echo link_tag(
    image_tag('del.gif', array('width'=>'13px','height'=>'11px')),
    '#', 
    array(
      "onclick"=>"if(!confirm('Delete module: ".$key."?')){return false;}else{".proto_window_mgr('module_del?module_name='.$key, 'get', 'innovative: Delete Module')."; return false;}"
    )) ?>
  <?php echo link_tag(
    image_tag('edit.png', array('width'=>'12px','height'=>'12px')),
    '#', 
    array(
      "onclick"=>"if(!confirm('Rename module: ".$key."?')){return false;}else{".proto_window_mgr('module_ren?module_name='.$key, 'get', 'innovative: Rename Module')."; return false;}"
    )) ?>
  <?php if(is_array($files)): ?>
    <ul style="margin-left:3px;">
      <li> 
        Actions: 
        <?php echo link_tag(
          image_tag('add.gif', array('width'=>'11px','height'=>'11px')),
          '#', 
          array(
            "onclick"=>"if(!confirm('Create new action?')){return false;}else{".proto_window_mgr('action_add', 'get', 'innovative: New Action')."; return false;}"
          )) ?>
        <ul style="margin-left:3px;">
        <?php if(count($files['actions']) > 0): ?>
            <?php foreach($files['actions'] as $value): ?>
              <li class="file"> <?php echo $value ?> 
              <?php echo link_tag(
                image_tag('del.gif', array('width'=>'13px','height'=>'11px')),
                '#', 
                array(
                  "onclick"=>"if(!confirm('Delete action: ".$value."?')){return false;}else{".proto_window_mgr('action_del?module_name='.$key.'&action_name='.$value, 'get', 'innovative: Delete Action')."; return false;}"
                )) ?>
              <?php echo link_tag(
                image_tag('edit.png', array('width'=>'13px','height'=>'11px')),
                '#', 
                array(
                  "onclick"=>"if(!confirm('Edit action: ".$value."?')){return false;}else{".proto_window_mgr('action_ren?module_name='.$key.'&action_name='.$value, 'get', 'innovative: Rename Action')."; return false;}"
                )) ?>
              </li>
            <?php endforeach; ?>
        <?php else: ?>
          <li class="file"><span style="color:black;background:yellow;">No Actions</span></li>
        <?php endif; ?>
        </ul>
      </li>
      <li> 
        Components: 
        <?php echo link_tag(
          image_tag('add.gif', array('width'=>'11px','height'=>'11px')),
          '#', 
          array(
            "onclick"=>"if(!confirm('Create new component?')){return false;}else{".proto_window_mgr('comp_add', 'get', 'innovative: New Component')."; return false;}"
          )) ?>
        <ul style="margin-left:3px;">
        <?php if(count($files['components']) > 0): ?>
            <?php foreach($files['components'] as $value): ?>
              <li class="file"> <?php echo $value ?> 
              <?php echo link_tag(
                image_tag('del.gif', array('width'=>'13px','height'=>'11px')),
                '#', 
                array(
                  "onclick"=>"if(!confirm('Delete component: ".$value."?')){return false;}else{".proto_window_mgr('comp_del?module_name='.$key.'&component='.$value, 'get', 'innovative: Delete Component')."; return false;}"
                )) ?>
              <?php echo link_tag(
                image_tag('edit.png', array('width'=>'13px','height'=>'11px')),
                '#', 
                array(
                  "onclick"=>"if(!confirm('Rename component: ".$value."?')){return false;}else{".proto_window_mgr('comp_ren?module_name='.$key.'&component='.$value, 'get', 'innovative: Rename Component')."; return false;}"
                )) ?>
              </li>
            <?php endforeach; ?>
        <?php else: ?>
          <li class="file"><span style="color:black;background:yellow;">No Components</span></li>
        <?php endif; ?>
        </ul>
      </li>
      <li>
        Templates: 
        <ul style="margin-left:3px;">
          <li>
            Action Templates: 
            <?php echo link_tag(
              image_tag('add.gif', array('width'=>'11px','height'=>'11px')),
              '#', 
              array(
                "onclick"=>"if(!confirm('Create new action template?')){return false;}else{".proto_window_mgr('act_tmplt_add', 'get', 'innovative: New Action Template')."; return false;}"
              )) ?>
            <ul style="margin-left:3px;">
            <?php if(count($files['act_templates']) > 0): ?>
                <?php foreach($files['act_templates'] as $value): ?>
                  <li class="file"> <?php echo $value ?> 
                  <?php echo link_tag(
                    image_tag('del.gif', array('width'=>'13px','height'=>'11px')),
                    '#', 
                    array(
                      "onclick"=>"if(!confirm('Delete action template: ".$value."?')){return false;}else{".proto_window_mgr('act_tmplt_del?module_name='.$key.'&template='.$value, 'get', 'innovative: Delete Action Template')."; return false;}"
                    )) ?>
                  <?php echo link_tag(
                    image_tag('edit.png', array('width'=>'13px','height'=>'11px')),
                    '#', 
                    array(
                      "onclick"=>"if(!confirm('Rename action template: ".$value."?')){return false;}else{".proto_window_mgr('act_tmplt_ren?module_name='.$key.'&template='.$value, 'get', 'innovative: Rename Action Template')."; return false;}"
                    )) ?>
                  </li>
                <?php endforeach; ?>
            <?php else: ?> 
              <li class="file"><span style="color:black;background:yellow;">No Action Templates</span></li>
            <?php endif; ?> 
            </ul>
          </li>
          <li>
            Component Templates: 
            <?php echo link_tag(
              image_tag('add.gif', array('width'=>'11px','height'=>'11px')),
              '#', 
              array(
                "onclick"=>"if(!confirm('Create new component template?')){return false;}else{".proto_window_mgr('comp_tmplt_add', 'get', 'innovative: New Component Template')."; return false;}"
              )) ?>
            <ul style="margin-left:3px;">
            <?php if(count($files['comp_templates']) > 0): ?>
                <?php foreach($files['comp_templates'] as $value): ?>
                  <li class="file"><?php echo $value ?> 
                  <?php echo link_tag(
                    image_tag('del.gif', array('width'=>'13px','height'=>'11px')),
                    '#', 
                    array(
                      "onclick"=>"if(!confirm('Delete component template: ".$value."?')){return false;}else{".proto_window_mgr('comp_tmplt_del?module_name='.$key.'&template='.$value, 'get', 'innovative: Delete Component Template')."; return false;}"
                    )) ?>
                  <?php echo link_tag(
                    image_tag('edit.png', array('width'=>'13px','height'=>'11px')),
                    '#', 
                    array(
                      "onclick"=>"if(!confirm('Rename component template: ".$value."?')){return false;}else{".proto_window_mgr('comp_tmplt_ren?module_name='.$key.'&template='.$value, 'get', 'innovative: Rename Component Template')."; return false;}"
                    )) ?>
                  </li>
                <?php endforeach; ?>
            <?php else: ?> 
              <li class="file"><span style="color:black;background:yellow;">No Component Templates</span></li>
            <?php endif; ?>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
  <?php endif; ?>
  </li>
<?php endforeach; ?>
</ul>