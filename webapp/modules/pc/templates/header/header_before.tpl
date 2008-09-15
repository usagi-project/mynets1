<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Expires" content="Thu, 01 Dec 1994 16:00:00 GMT">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<link rel="shortcut icon" href="favicon.ico">
<title>({$title})</title>
<link rel="stylesheet" href="./skin/default/default.css" type="text/css">
<script src="./js/usagi.js" type="text/javascript"></script>
<style type="text/css">
<!--
({foreach from=$inc_border_color key=key item=item})
.({$key}){border:#({$item}) 1px solid;}
({/foreach})
({foreach from=$inc_bg_color key=key item=item})
.({$key}){background-color:#({$item});}
({/foreach})
({$inc_custom_css|smarty:nodefaults})
#login_close {
 background: url(./skin/({$smarty.const.SKIN_FOLDER})/img/skin_login.jpg) no-repeat;
}
#login_open {
 background: url(./skin/({$smarty.const.SKIN_FOLDER})/img/skin_login_open.jpg) no-repeat;
}
/*
#footer {
background: url(./skin/({$smarty.const.SKIN_FOLDER})/img/skin_footer.jpg) 0 0 no-repeat;
}
*/
-->
</style>
({ext_include file="new_templates/init_javascript.tpl"})
({$inc_html_head|smarty:nodefaults})
