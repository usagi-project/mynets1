<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
({literal})
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Expires" content="Thu, 01 Dec 1994 16:00:00 GMT">
<meta http-equiv="Content-Style-Type" content="text/css">
({/literal})
<title>({$INC_HEADER_title}) - プレビュー</title>
<link rel="stylesheet" href="./css/default.css" type="text/css">
({if defined('MYNETS_PREFIX_NAME')})
<script type="text/javascript" src="./js/javascripts/prototype.js"></script>
<script type="text/javascript" src="./js/usagi.js"></script>
({else})
<script type="text/javascript" src="./js/prototype.js"></script>
<script type="text/javascript" src="./js/pne.js"></script>
({/if})
({literal})
<style type="text/css">
<!--
({/literal})
body { background-color: #({$INC_HEADER_color_config.bg_12}) ; }
.container { background-color: #({$INC_HEADER_color_config.bg_13}) ; }

* { font-family: "Hiragino Kaku Gothic Pro", "Hiragino Kaku Ghothic Pro W3", "ヒラギノ角ゴ Pro W3",({* "メイリオ", Meiryo,*}) "ＭＳ Ｐゴシック", Osaka, sans-serif ; }

({$INC_HEADER_inc_custom_css|smarty:nodefaults})
({literal})
-->
</style>
<script type="text/javascript">
//<![CDATA[
function showPreviewBody() {
    //親画面のロード中画像を非表示にし、プレビュー領域を表示する
    try {
        //IFRAME内に遷移しないよう、アンカーのターゲットを変更
        var pre=$('preview_body');
        var a=pre.getElementsByTagName('a');
        for (var i=0;i<a.length;i++) {
            a.item(i).setAttribute('target','_blank');
        }
        //プレビュー本体表示
        //pre.style.visibility='visible';
        window.parent.previewBBCodeHideLoading(document,'preview_body');
    }catch(e){}
}
function hidePreviewBody() {
    //プレビュー終了
    try {
        var name = window.parent.BBCode.preview.get_preview_area_id();
        var preview_window = window.parent.document.getElementById(name);
        window.parent.previewBBCodeHidden(preview_window,false);
    }catch(e){}
    return false;
}
//]]>
</script>
<style type="text/css">
<!--
body, div, img, span {
 margin: 0;
 padding: 0;
 border:none;
 text-align: left;
}
#preview_body {
 width:410px;
 height:250px;
 visibility:hidden;
}
#preview_body div.body {
 width:410px;
 height:228px;
 overflow:auto;
 white-space:nowrap;
 word-wrap:normal
}
-->
</style>
</head>
({/literal})
<body id="pc_page_({$INC_HEADER_page_name})" onload="showPreviewBody();">
<div id="preview_body">
<div class="body">
({if $type == 'c_edit' || $type == 'h_com'})
({*** コミュニティ ***})
({$body|nl2br|bbcode2html|t_url2cmd:'community':$c_member_id|t_cmd:'community'})
({elseif $type == 'c_event'})
({*** イベント ***})
({$body|nl2br|bbcode2html|t_url2cmd:'community':$c_member_id|t_cmd:'community'})
({elseif $type == 'c_topic'})
({*** トピック ***})
({$body|nl2br|bbcode2html|t_url2cmd:'community':$c_member_id|t_cmd:'community'})
({elseif $type == 'h_diary'})
({*** 日記 ***})
({$body|nl2br|bbcode2html|t_url2cmd:'diary':$c_member_id|t_cmd:'diary'})
({elseif $type == 'h_review'})
({*** レビュー ***})
({$body|nl2br|bbcode2html})
({else})
({$body|nl2br|bbcode2html})
({/if})
</div>
</div>
<form id="preview_form" name="preview_form" action="./" method="post">
<input type="hidden" name="m" value="pc" />
<input type="hidden" name="a" value="page_h_bbcode_preview" />
<input type="hidden" name="body" value="" />
<input type="hidden" name="target_id" value="" />
<input type="hidden" name="id" value="" />
<input type="hidden" name="page" value="" />
<input type="hidden" name="browser" value="" />
</form>
</body>
</html>
