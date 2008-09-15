({$inc_html_header|smarty:nodefaults})
<body onload="loadData('./?m=pc&amp;a=page_h_gmaps_list_data')" onunload="GUnload()">
<script src="./googlemapsapi.php" type="text/javascript"></script>
<script src="./js/javascripts/mapset.js" type="text/javascript" charset="UTF-8"></script>
<script type="text/javascript" charset="UTF-8">
var domain = "({$smarty.const.OPENPNE_URL})";
var type = "({if $type})({$type})({/if})";
var id = "({if $id})({$id})({/if})";
</script>
<style type="text/css">
.clearfix:after {
    content: "."; 
    display: block; 
    height: 0; 
    clear: both; 
    visibility: hidden;
}

.clearfix{
  zoom:1;
}

#mapcnt {
   width:713px;
   background:#ffffff;
   margin-bottom:5px;
}

#mapsearch {
   filter:alpha(opacity=90);
   -moz-opacity: 0.9;
   opacity: 0.9;
   display:none;
}

.viewcell {
    filter:alpha(opacity=90);
    -moz-opacity: 0.9;
    opacity: 0.9;
}

.d_cell {
    width:89px;
    height:18px;
    float:left;
    padding:2px;
}

.c_cell {
    width:90px;
    height:18px;
    float:right;
    padding:2px;
}

.viewitemcell {
    border-left:#cccccc 1px solid;
    border-right:#cccccc 1px solid;
    border-bottom:#cccccc 1px solid;
    background:#ffffff;
    padding:5px 0;
    height:200px;
}
</style>
({ext_include file="inc_extension_pagelayout_top.tpl"})
<table class="mainframe" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="container inc_page_header">
({$inc_page_header|smarty:nodefaults})
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
<table border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td colspan="2">
            <div class="border_07 bg_02" id="mapcnt">
                <div style="margin:1px;padding:3px;text-align:left;font-weight:bold;" class="bg_06">
                    <img src="({t_img_url_skin filename=content_header_1})" align="absmiddle">ナビゲーション
                </div>
                <div style="padding:3px;line-height:150%">
                    <div style="padding:3px;text-align:left;border-bottom:1px solid #cccccc">
                        <input type="text" size="15" value="" id="pname" maxlength="12">&nbsp;<input type="button" class="submit" value="ブックマーク" onClick="addPoint()">&nbsp;|&nbsp;<input type="button" class="submit" value="削除" onClick="deletePoint()"><br>
                    </div>
                    <div>
                        <div style="text-align:left;padding:3px;" id="mapnavi">
                            <a href="javaScript:void(0)" onClick="reSize(-5.615985819155327,137.8233,1)">世界</a>&nbsp;|&nbsp;<a href="javaScript:void(0)" onClick="reSize(37.5,137.8233,5)">日本</a>
                        </div>
                    </div>
                </div>
                <div id="uribox" style="border-top:1px dotted #cccccc;padding:5px;display:none;">
                    <div id="uri"></div>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td valign="top">
            <div id="map" style="width:548px;height:620px;text-align:left;">
                <div style="padiing:5px;">マップを読み込み中です・・・</div>
            </div>
        </td>
        <td>
            <div style="width:160px;height:620px;">
                <div style="width:160px;margin-bottom:5px;">
                    <div class="border_07 bg_02">
                        <div style="margin: 1px; padding: 3px;text-align:left;font-weight:bold;" class="bg_06">
                            <img src="({t_img_url_skin filename=content_header_1})" align="absmiddle">日記マップ
                        </div>
                        <div style="margin: 1px; padding: 3px;text-align:left;border-bottom:1px solid #cccccc" class="bg_13">
                            <span id="num1"></span>
                            <div id="pager1"></div>
                        </div>
                        <div id="d_page" style="height:240px; overflow:auto">
                        </div>
                    </div>
                </div>
                <div style="width:160px;">
                    <div  class="border_07 bg_02">
                        <div style="margin: 1px; padding: 3px;text-align:left;font-weight:bold;" class="bg_06">
                            <img src="({t_img_url_skin filename=content_header_1})" align="absmiddle">コミュニティマップ
                        </div>
                        <div style="margin: 1px; padding: 3px;text-align:left;border-bottom:1px solid #cccccc" class="bg_13">
                            <span id="num2"></span>
                            <div id="pager2"></div>
                        </div>
                        <div id="c_page" style="height:240px; overflow:auto">
                        </div>
                    </div>
                </div>
            </div>
        </td>
    </tr>
</table>

<!-- 検索パーツ -->
<div id="mapsearch">
    <div style="margin-bottom:5px;">
        <input type="text" size="15" value="" id="kwd" style="width:100px;padding:3px;">&nbsp;<input type="button" class="submit" onClick="search(document.getElementById('kwd').value);return false;" value="検索" style="padding:3px;">
    </div>
</div>

<!-- イメージウィンドウパーツ -->
<div id="viewwindow">
    <div id="d_viewwindow" style="width:214px;display:none;">
        <table border="0" cellspacing="0" cellpadding="0" width="214" height="200">
            <tr>
                <td width="12">
                    <img src="./skin/default/img/lmove.gif" style="cursor: pointer;" onclick="d_vlmove();return false;">
                </td>
                <td width="190" align="center" class="viewcell">
                    <div class="clearfix">
                        <div class="d_cell" style="border-top:#00c000 2px solid;border-right:#cccccc 1px solid;border-left:#cccccc 1px solid;background:url(./skin/default/img/view_cell_current.gif) repeat-x top left;font-weight:bold;">日記</div>
                        <div class="c_cell" style="border-top:#cccccc 1px solid;border-right:#cccccc 1px solid;border-bottom:#cccccc 1px solid;background:url(./skin/default/img/view_cell.gif) repeat-x bottom left;cursor:pointer;" onclick="c_opr(true);return false;">コミュニティ</div>
                    </div>
                    <div class="viewitemcell">
                        <div id="d_viewcell">
                        </div>
                        <div id="d_noimg" style="display:none;">イメージはありません</div>
                    </div>
                </td>
                <td width="12">
                    <img src="./skin/default/img/rmove.gif" style="cursor: pointer;" onclick="d_vrmove();return false;">
                </td>
            </tr>
        </table>
    </div>

    <div id="c_viewwindow" style="width:214px;display:none;">
        <table border="0" cellspacing="0" cellpadding="0" width="214" height="200">
            <tr>
                <td width="12">
                    <img src="./skin/default/img/lmove.gif" style="cursor: pointer;" onclick="c_vlmove();return false;">
                </td>
                <td width="190" align="center" class="viewcell">
                    <div class="clearfix">
                        <div class="d_cell" style="border:#cccccc 1px solid;background:url(./skin/default/img/view_cell.gif) repeat-x bottom left;cursor:pointer;" onclick="d_opr(true);return false;">日記</div>
                        <div class="c_cell" style="border-top:#c00000 2px solid;border-right:#cccccc 1px solid;background:url(./skin/default/img/view_cell_current.gif) repeat-x top left;font-weight:bold;">コミュニティ</div>
                    </div>
                    <div class="viewitemcell">
                        <div id="c_viewcell">
                        </div>
                        <div id="c_noimg" style="display:none;">イメージはありません</div>
                    </div>
                </td>
                <td width="12">
                    <img src="./skin/default/img/rmove.gif" style="cursor: pointer;" onclick="c_vrmove();return false;">
                </td>
            </tr>
        </table>
    </div>
    <div id="svcheckbox" style="width:180px;padding:4px;margin:0 13px;background:#7C99E9;color:#ffffff;display:none;">
        <input type="checkbox" id="svol" onclick='cheksvol();' style="border:none;background:none;">&nbsp;<label for="svol">ストリートビューエリア表示</label>
    </div>
</div>

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
