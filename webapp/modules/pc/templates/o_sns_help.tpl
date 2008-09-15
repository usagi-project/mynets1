({$inc_html_header|smarty:nodefaults})
<body>
({ext_include file="inc_extension_pagelayout_top.tpl"})
<table class="mainframe" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="container inc_page_header">
({$inc_page_header|smarty:nodefaults})
</td>
</tr>
<tr>
<td class="container inc_navi">
({$inc_navi|smarty:nodefaults})
</td>
</tr>
<tr>
<td class="container main_content">
<table class="container" border="0" cellspacing="0" cellpadding="0">({*BEGIN:container*})
<tr>
<td class="full_content" align="center">
({***************************})
({**ここから：メインコンテンツ**})
({***************************})

<img src="./skin/dummy.gif" class="v_spacer_l">

<table border="0" cellspacing="0" cellpadding="0" style="width:680px;margin:0px auto;" class="border_07">
<tr>
<td class="bg_00" align="left">
<!-- *ここから：拡張ページ＞内容* -->
({*ここから：body*})
<!-- ここから：主内容 -->

<div style="padding:7px 7px;" class="bg_02">
({if $c_siteadmin != ""})
({$c_siteadmin|smarty:nodefaults})
({else})
ヘルプは、ただいま準備中です。
({/if})
</div>

<!-- ここまで：主内容 -->
({*ここまで：body*})
<!-- *ここまで：拡張ページ＞＞内容* -->
</td>
</tr>
</table>

<img src="./skin/dummy.gif" class="v_spacer_l">
<img src="./skin/dummy.gif" class="v_spacer_l">

({***************************})
({**ここまで：メインコンテンツ**})
({***************************})
</td>
</tr>
</table>({*END:container*})
</td>
</tr>
<tr>
<td class="container inc_page_footer">
({$inc_page_footer|smarty:nodefaults})
</td>
</tr>
</table>


({ext_include file="inc_extension_pagelayout_bottom.tpl"})
</body>
</html>
