<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
({$tpl.html_header|smarty:nodefaults})
</head>
<body>
({if !$IS_CLOSED_SNS && (($smarty.const.OPENPNE_REGIST_FROM) & ($smarty.const.OPENPNE_REGIST_FROM_PC))})
<div id="login_open">
({else})
<div id="login_close">
({/if})
({$tpl.login|smarty:nodefaults})
({$tpl.html_footer|smarty:nodefaults})
</div>({* login_???? *})
</body>
</html>
