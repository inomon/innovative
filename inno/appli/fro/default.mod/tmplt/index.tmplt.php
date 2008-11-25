<pre style="font-size:11px;">
<?php echo image_tag('icon2_small.gif') ?>
<?php
//echo load_component('default', 'error404', false);
echo $ok."\n";
var_dump($this->getRequest()->getAllParam());
?>
Module: <?php echo $this->getRouting()->getModule()."\n" ?>
Action: <?php echo $this->getRouting()->getAction()."\n" ?>
<?php echo $this->getRequest()->getMethod() ?>
  
<?php var_dump($this->getRouting()->getRoutes()) ?>
</pre>