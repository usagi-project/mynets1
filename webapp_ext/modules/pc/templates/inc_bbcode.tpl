({if defined('BBCODE_USE_FOR_INPUT') && $smarty.const.BBCODE_USE_FOR_INPUT})
({***** BBCode始まり *****})
({if defined('BBCODE_USE_SCRIPTACULOUS') && $smarty.const.BBCODE_USE_SCRIPTACULOUS})
<script type="text/javascript" src="./js/javascripts/scriptaculous.js?load=effects,dragdrop"></script>
({/if})
({literal})
<script type="text/javascript" src="./js/bbcode/bbcode.cmd.js"></script>
<script type="text/javascript" src="./js/bbcode/bbcode.taglib.js"></script>
<script type="text/javascript" src="./js/bbcode/bbcode.colorpicker.js"></script>
<script type="text/javascript" src="./js/bbcode/bbcode.selector.js"></script>
<script type="text/javascript" src="./js/bbcode/bbcode.controller.js"></script>
<script type="text/javascript">
<!--
Event.observe(window,'load',bbcodeInsertVisible,false);
function bbcodeInsertVisible() {
    var bbinsobj = document.getElementById("bbcode_insert");
    bbinsobj.style.visibility = "visible";
    bbinsobj.style.height = "";
    var bbhelp = document.getElementById("bbcode_helplines");
    bbhelp.style.height = "3.0em";
({/literal})
    BBCodeTags.setValueAll("base_url","'({$smarty.const.OPENPNE_URL})'");
({if defined('BBCODE_USE_PNE_TAG') && $smarty.const.BBCODE_USE_PNE_TAG})
({literal})
    BBCode.pnetag_mode = true;
    BBCodeTags.setValueAll("use_pne_tag",true);
    BBCodeTags.url.help += BBCodeTags.url.help_pne_tag;
({/literal})
({if defined('BBCODE_USE_DOCCI_TAG') && $smarty.const.BBCODE_USE_DOCCI_TAG})
({literal})
    BBCodeTags.url.get_docci = function(v){
        return (v.match(/\?m=(ktai|pc)_docci&a=page_view&docci_topic_id=(\d+)/)) ? RegExp.$2 : -1;
    }
({/literal})
({/if})
({/if})
({literal})
}
//-->
</script>
<noscript>
<strong style="color:#ff0000;">JavaScriptを実行できないためBBCode入力支援機能が使用できません。<br />
JavaScriptの実行を許可するように設定を変更してください。</strong>
</noscript>
<div id="bbcode_insert" class="bbcode-insert" style="height:0px;visibility:hidden;">
<div id="bbcode_content" class="bbcode-content">
<span id="bbcode_help_popup" class="bbcode-help-popup"></span>
<span id="bbcode_help_mod" onMouseOver="bbcode_help_popup('mod');" onMouseOut="bbcode_help_popup('mod');" style="border-bottom:1px dashed red;cursor:help;">文字の修飾</span>ができます。<span style="color:red;">（※<span id="bbcode_help_tag" onMouseOver="bbcode_help_popup('tag');" onMouseOut="bbcode_help_popup('tag');" style="border-bottom: 1px dashed red;cursor:help;">タグの閉じ忘れ</span>にご注意ください）</span>
</div>
<div id="bbcode_items" class="bbcode-items">
<span id="bbcode_b"><input type="button" id="addbbcode_b" onClick="insertBBCode(this.form,'b','')" onMouseOver="helpBBCode('b')" class="bbcode-button-bold" title="太字" value="　"></span><span id="bbcode_i"><input type="button" id="addbbcode_i" onClick="insertBBCode(this.form,'i','')" onMouseOver="helpBBCode('i')" class="bbcode-button-italic" title="斜体" value="　"></span><span id="bbcode_u"><input type="button" id="addbbcode_u" onClick="insertBBCode(this.form,'u','')" onMouseOver="helpBBCode('u')" class="bbcode-button-underline" title="下線" value="　"></span><span id="bbcode_s" class="bbcode"><input type="button" id="addbbcode_s"  onClick="insertBBCode(this.form,'s','')" onMouseOver="helpBBCode('s')" class="bbcode-button-strike" title="打ち消し線" value="　"></span><span id="bbcode_sub"><input type="button" id="addbbcode_sub" onClick="insertBBCode(this.form,'sub','')" onMouseOver="helpBBCode('sub')" class="bbcode-button-sub" title="添え字" value="　"></span><span id="bbcode_sup"><input type="button" id="addbbcode_sup" onClick="insertBBCode(this.form,'sup','')" onMouseOver="helpBBCode('sup')" class="bbcode-button-sup" title="上付き文字" value="　"></span><span id="bbcode_color" class="bbcode"><input type="button" id="addbbcode_color" onMouseDown="color_pallet_popup(this.form,'color','')" onMouseOver="helpBBCode('color')" class="bbcode-button-color" title="文字の色" value="　"></span><span id="bbcode_highlight" class="bbcode"><input type="button" id="addbbcode_highlight" onMouseDown="color_pallet_popup(this.form,'highlight','')" onMouseOver="helpBBCode('highlight')" class="bbcode-button-highlight" title="ハイライト" value="　"></span><span id="bbcode_size" class="bbcode"><input type="button" id="addbbcode_size" onMouseDown="size_selector_pulldown(this.form,'size','')" onMouseOver="helpBBCode('size')" class="bbcode-button-size" title="文字のサイズ" value="　"></span><span id="bbcode_font" class="bbcode"><input type="button" id="addbbcode_font" onMouseDown="size_selector_pulldown(this.form,'font','')" onMouseOver="helpBBCode('font')" class="bbcode-button-font" title="フォント" value="　"></span><span id="bbcode_center" class="bbcode"><input type="button" id="addbbcode_center"  onClick="insertBBCode(this.form,'center','')" onMouseOver="helpBBCode('center')" class="bbcode-button-center" title="中央寄せ" value="　"></span><span id="bbcode_right" class="bbcode"><input type="button" id="addbbcode_right"  onClick="insertBBCode(this.form,'right','')" onMouseOver="helpBBCode('right')" class="bbcode-button-right" title="右寄せ" value="　"></span><span id="bbcode_indent" class="bbcode"><input type="button" id="addbbcode_indent"  onClick="insertBBCode(this.form,'indent','')" onMouseOver="helpBBCode('indent')" class="bbcode-button-indent" title="インデント" value="　"></span><span id="bbcode_list" class="bbcode"><input type="button" id="addbbcode_list" onClick="insertBBCode(this.form,'list','')" onMouseOver="helpBBCode('list')" class="bbcode-button-list" title="番号付箇条書き" value="　"></span><span id="bbcode_list_ul" class="bbcode"><input type="button" id="addbbcode_list_ul" onClick="insertBBCode(this.form,'listul','')" onMouseOver="helpBBCode('listul')" class="bbcode-button-list-ul" title="番号なし箇条書き" value="　"></span><span id="bbcode_marquee" class="bbcode"><input type="button" id="addbbcode_marquee" onMouseDown="size_selector_pulldown(this.form,'marquee','')" onMouseOver="helpBBCode('marquee')" class="bbcode-button-marquee" title="文字を動かす" value="　"></span>
<br>
<span id="bbcode_quote" class="bbcode"><input type="button" id="addbbcode_quote" onClick="insertBBCode(this.form,'quote','');return false;" onMouseOver="helpBBCode('quote')" class="bbcode-button-quote" title="引用" value="　"></span><span id="bbcode_code" class="bbcode"><input type="button" id="addbbcode_code" onClick="insertBBCode(this.form,'code','')" onMouseOver="helpBBCode('code')" class="bbcode-button-code" title="コード表示" value="　"></span><span id="bbcode_noparse" class="bbcode"><input type="button" id="addbbcode_noparse" onClick="insertBBCode(this.form,'noparse','')" onMouseOver="helpBBCode('noparse')" class="bbcode-button-noparse" title="BBCode表示" value="　"></span><span id="bbcode_img" class="bbcode"><input type="button" id="addbbcode_img" onClick="insertBBCode(this.form,'img','')" onMouseOver="helpBBCode('img')" class="bbcode-button-img" title="画像を挿入" value="　"></span><span id="bbcode_url" class="bbcode"><input type="button" id="addbbcode_url" onClick="insertBBCode(this.form,'url','')" onMouseOver="helpBBCode('url')" class="bbcode-button-url" title="リンクを挿入" value="　"></span><span id="bbcode_email" class="bbcode"><input type="button" id="addbbcode_email" onClick="insertBBCode(this.form,'email','')" onMouseOver="helpBBCode('email')" class="bbcode-button-email" title="メールアドレスを挿入" value="　"></span><span id="bbcode_cmd" class="bbcode"><input type="button" id="addbbcode_cmd" onClick="insertBBCode(this.form,'cmd','')" onMouseOver="helpBBCode('cmd')" class="bbcode-button-cmd" title="小窓を挿入" value="　"></span>
</div>
<div id="bbcode_helpline_and_tagclose" style="padding: 4px;">
<div id="bbcode_helplines" class="bbcode-helplines">&nbsp;</div>
</div>
<div id="bbcode_size_selector" class="bbcode-size-selector"></div>
<div id="bbcode_color_picker" class="bbcode-color-picker"></div>
</div>
({/literal})
({***** BBCode終わり *****})
({/if})
