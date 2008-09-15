<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
({$tpl.html_header|smarty:nodefaults})
</head>
<body>
<div id="wrapper">
<div id="header">
<div id="banner">
({$tpl.banner|smarty:nodefaults})
</div>
({$tpl.navibar1|smarty:nodefaults})
</div>
({$tpl.navibar2|smarty:nodefaults})
<div id="container" class="bg_13">
  ({$tpl.infobox|smarty:nodefaults})
<div id="left">
 ({$tpl.menubar|smarty:nodefaults})
</div>
<div id="right">
  ({$tpl.main|smarty:nodefaults})
</div>
</div>({* end of container*})
({$tpl.html_footer|smarty:nodefaults})
</div>
</body>
</html>
