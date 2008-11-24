<?php load_helper('Menu') ?>
<?php

echo create_rich_menu(array(
  'Home'  => '~homepage',
  'Projects'  => array(
      'link' => '?go=projects',
      'ModalBox' => '?go=projects&proj=modalbox',
      'LightBox' => '?go=projects&proj=lightbox'
    ),
  'Affiliates'  => array(
      'Wikipedia' => 'http://www.wikipedia.org',
      'Mozilla' => 'http://www.mozilla.com'
    ),
  'About Us'  => './'
), 'simple.vertical')

?>
<pre>
<?php
echo load_component('default', 'error404');
echo $ok;
echo $inno_request->getMethod();
?>
</pre>