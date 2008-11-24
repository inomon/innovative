<div class="fish-eye-menu" id="fish-eye-menu" style="position:absolute;background:#fff;border:4px #ddd solid;">
  <ul id="fisheye_menu">
    <li><a href="#"><?php echo image_tag('icon.gif')?><span>Home</span></a></li>
    <li><a href="#"><?php echo image_tag('icon2.gif')?><span>Icon 2</span></a></li>
    <li><a href="#"><?php echo image_tag('icon.gif')?><span>Icon 3</span></a></li>
    <li><a href="#"><?php echo image_tag('icon2.gif')?><span>Icon 4</span></a></li>
    <li><a href="#"><?php echo image_tag('icon.gif')?><span>Icon 5</span></a></li>
    <li><a href="#"><?php echo image_tag('icon2.gif')?><span>Icon 6</span></a></li>
  </ul>
</div>
<script type="text/javascript">
Event.observe(window, 'resize', positionMenu);
Event.observe(window, 'scroll', positionMenu);
Event.observe(window, 'load', positionMenu);
function positionMenu(event){
  var topPos = document.viewport.getScrollOffsets().top;
  var leftPos = (document.width - $('fish-eye-menu').getWidth()) / 2;
  $('fish-eye-menu').setStyle({
        left: leftPos+'px',
        top: topPos+'px',
        zIndex: 1000
      });
}
</script>
<div class="spacer" style="height:90px;"></div>
<span>
[<a href="#" onclick="$('fish-eye-menu').toggle(); return false;">show/hide menu</a>]
</span>
<br />
<div class="notice" id="notice" style="width:100%;border:1px #000000 dashed;">NOTICE</div>
<span>
[<a href="#" onclick="$('notice').toggle(); return false;">show/hide notice</a>]
</span>
<br />
<?php
innoAssets::addScriptHead("
function resizeWorkingDesktop()
{
  if(!$('treeview').visible())
  {
    var docWidth = document.width-45;
    $('window-manager').setStyle({
        width: docWidth+'px'
      });
  }
}
function maximizeDesktop()
{
  Event.observe(window, 'resize', resizeWorkingDesktop);
  if($('treeview').visible())
  {
    $('treeview').hide();
    var docWidth = document.width-45;
    $('window-manager').setStyle({
        width: docWidth+'px'
      });
  }
  else
  {
    $('treeview').show();
    $('window-manager').setStyle({
        width: '60%'
      });
  }
}
")
?>
<span>
[<a href="#" onclick="javascript:maximizeDesktop(); return false;">show/hide directory tree</a>]
</span>
<div id="treeview" class="treeview">
<?php echo load_component('default', 'treeview') ?>
</div>

<div id="window-manager" class="window-manager" name="window-manager">
</div>
<?php
/*
innoAssets::addScriptHead(
"
function getFormValues(fobj)
{
  var str = '';
  
  for(var i = 0; i < fobj.elements.length; i++) {
    if (fobj.elements[i].value!='') 
      str += fobj.elements[i].name + '=' + escape(fobj.elements[i].value) + '&';
  }
  
  return str;
}

function submitForm(url, submitMethod)
{
  new Ajax.Request(url, {
    method: submitMethod,
    onSuccess: function(transport) {
      var notice = $('notice');
      notice.update(transport.responseText);
      Modalbox.hide();
    },
    onFailure: function(transport) {
      var notice = $('notice');
      notice.update('Request Error!!');
      Modalbox.hide();
    }
  });
}
"
);
*/
?>
<pre>
<?php
//var_dump(innoDir::getAll());
//print_r($modules);
//var_dump(innoConfig::getAll());
?>
</pre>