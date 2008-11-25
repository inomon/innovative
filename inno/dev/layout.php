<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head><?php echo innoRenderer::renderHeaders() ?>
</head>
<body>
<?php echo innoRenderer::renderTemplate() ?>

<script type="text/javascript">
function removeAd()
{
  // the baddest script ever, removes the ad banner ^_^
  var elements = document.getElementsByTagName('table');
	for(i=0;i<elements.length;i++)
	{
		if('ads_'== elements[i].id.substr(0, 4))
		{
      elements[i].style.display = 'none';
		}
	}
}

window.onload = removeAd;
</script>
</body>
</html>