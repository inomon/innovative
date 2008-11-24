<pre>
module: action
action: create
</pre>
<?php if($inno_request->getMethod() == innoRequest::GET): ?>
  <?php load_helper('Form') ?>

  <?php /*form('','post', array(
    'id' => 'form_create_action',
    'name' => 'form_create_action',
    'submit_to_ajax' => "javascript:submitForm('index.php?".$inno_action_param."=action_add&'+getFormValues($('form_create_action')), 'post');",
    'onsubmit' => 'return false;'
    ))*/ ?>
    <form action="" onsubmit="return false;" method="post">
      <?php echo textbox('name', array('tooltip'=>'asdfgha aosidu oasiaos aosid aso asoi asoi aso diasodasoid aosi', 'class'=>'inputbox')) ?>
      <br />
      <button name="submit" id="submit" onclick="javascript:submitForm('index.php?<?php echo $inno_action_param ?>=action_add&'+getFormValues($('form_create_action')), 'post');">create action</button>
    </form>
  <?php //end_form('submit') ?>
<br />
<br />
<br />
<?php else: ?>
  create new action!<br /><br />
  action: <?php echo $name ?>
<?php endif; ?>