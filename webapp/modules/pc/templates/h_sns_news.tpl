({$inc_html_header|smarty:nodefaults})
<body onload="init('({$feed[0]})','','({$feed[0]})')">
({ext_include file="inc_extension_pagelayout_top.tpl"})
<script src="./js/javascripts/news.js" type="text/javascript"></script>
<style type="text/css">
.clearfix:after {
    content: ".";
    display: block;
    height: 0;
    clear: both;
    visibility: hidden;
}

.clearfix {
  zoom:1;
}

#newstabs {
    float:left;
    width:100%;
    margin:5px;
}

#newstabs ul {
    margin:0;
    padding:0 10px 0 0;
    list-style:none;
    clear:both;
}

#newstabs li {
    display:inline;
    margin:0;
    padding:0;
}

#newstabs a {
    float:left;
    margin:0;
    padding:0 0 0 4px;
    text-decoration:none;
}

#newstabs a span {
    float:left;
    display:block;
    padding:5px 15px 4px 6px;
    color:#404040;
    font-size:13px;
    font-weight:bold;
}

#newstabs a.glbleft {
    background:url(({t_img_url_skin filename=btab_left})) no-repeat left top;
}

#newstabs a span.glbright {
    background:url(({t_img_url_skin filename=btab_right})) no-repeat right top;
}

#newstabs a.cstleft {
    background:url(({t_img_url_skin filename=rtab_left})) no-repeat left top;
}

#newstabs a span.cstright {
    background:url(({t_img_url_skin filename=rtab_right})) no-repeat right top;
}

/* Commented Backslash Hack hides rule from IE5-Mac \*/
    #newstabs a span {float:none;}
/* End IE5-Mac hack */

#newstabs a:hover {
    background-position:0% -42px;
}

#newstabs a:hover span {
    background-position:100% -42px;
    color:#fff;
    font-weight:bold;
}

#newstabs .current a {
    background-position:0% -42px;
}

#newstabs .current a span {
    background-position:100% -42px;
    color:#fff;
}

.newscont li {
    list-style-position: inside; 
}
</style>
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

<div class="border_07 bg_02" style="margin:5px;"">
    <div style="margin: 1px; padding: 3px;text-align:left;font-weight:bold;" class="bg_06">
        <img src="({t_img_url_skin filename=content_header_1})" align="absmiddle">ニュース検索
    </div>
    <div style="padding:5px">
        キーワード&nbsp;<img src="({t_img_url_skin filename=icon_arrow_2})" class="icon">
        <input id="keyword" size="15">&nbsp;
        <input type="submit" class="submit" onClick="init('f',encodeURIComponent(document.getElementById('keyword').value),'');return false;" value=" 検 索 ">
    </div>
</div>

<div id="newstabs">
({if $feed})
<ul>
({foreach from=$feed item="feed"})
<li id="({$feed})"><a href="javascript:void(0)" onClick="init('({$feed})','','({$feed})');return false;" class="cstleft"><span class="cstright"><img src="({t_img_url_skin filename=icon_1})" align="absmiddle">&nbsp;({$feed})</span></a></li>
({/foreach})
</ul>
({/if})
({if $smarty.const.DISPLAY_GOOGLE_TOPIC})
<ul>
<li id="domestic"><a href="javascript:void(0)" onClick="init('domestic','','');return false;" class="glbleft"><span class="glbright"><img src="({t_img_url_skin filename=icon_2})" align="absmiddle">&nbsp;国内</span></a></li>
<li id="local"><a href="javascript:void(0)" onClick="init('local','','');return false;" class="glbleft"><span class="glbright"><img src="({t_img_url_skin filename=icon_2})" align="absmiddle">&nbsp;地域</span></a></li>
<li id="sports"><a href="javascript:void(0)" onClick="init('sports','','');return false;" class="glbleft"><span class="glbright"><img src="({t_img_url_skin filename=icon_2})" align="absmiddle">&nbsp;スポーツ</span></a></li>
<li id="entertainment"><a href="javascript:void(0)" onClick="init('entertainment','','');return false;" class="glbleft"><span class="glbright"><img src="({t_img_url_skin filename=icon_2})" align="absmiddle">&nbsp;エンターテイメント</span></a></li>
<li id="computer"><a href="javascript:void(0)" onClick="init('computer','','');return false;" class="glbleft"><span class="glbright"><img src="({t_img_url_skin filename=icon_2})" align="absmiddle">&nbsp;コンピュータ</span></a></li>
<li id="economy"><a href="javascript:void(0)" onClick="init('economy','','');return false;" class="glbleft"><span class="glbright"><img src="({t_img_url_skin filename=icon_2})" align="absmiddle">&nbsp;経済</span></a></li>
<li id="world"><a href="javascript:void(0)" onClick="init('world','','');return false;" class="glbleft"><span class="glbright"><img src="({t_img_url_skin filename=icon_2})" align="absmiddle">&nbsp;海外</span></a></li>
<li id="science"><a href="javascript:void(0)" onClick="init('science','','');return false;" class="glbleft"><span class="glbright"><img src="({t_img_url_skin filename=icon_2})" align="absmiddle">&nbsp;科学</span></a></li>
</ul>
({/if})
</div>

<div id="placeholder"></div>

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
