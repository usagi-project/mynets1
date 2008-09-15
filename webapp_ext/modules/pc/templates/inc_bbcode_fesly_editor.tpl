({if defined('BBCODE_USE_FOR_INPUT_FESLY') && $smarty.const.BBCODE_USE_FOR_INPUT_FESLY})
({***** BBCode始まり *****})
({if !(defined('BBCODE_USE_FOR_INPUT') && $smarty.const.BBCODE_USE_FOR_INPUT)})
({literal})
<script type="text/javascript" src="./js/bbcode/FeslyBBcodeJS/shima_script/bbcode_taglib.js"></script>
<script type="text/javascript" src="./js/bbcode/FeslyBBcodeJS/shima_script/bbcode_controller.js"></script>
({/literal})
({/if})
({literal})
<script type="text/javascript" src="./js/bbcode/FeslyBBcodeJS/bbcode_popHelp.js"></script>
<script type="text/javascript" src="./js/bbcode/FeslyBBcodeJS/bbcode_color_palette.js"></script>
<script type="text/javascript" src="./js/bbcode/FeslyBBcodeJS/bbcode_marker_palette.js"></script>
<script type="text/javascript" src="./js/bbcode/FeslyBBcodeJS/bbcode_effects_tag.js"></script>
<div style="width:439px; margin:0 0 3px 0; padding:0;" id="FeslyBBcode">
    <div style="margin:0; padding:0 0 0 3px;">
        <div style="font-size:11px; margin:4px 0; text-align:left;">装飾したい文字列を指定してアイコンをクリックするとタグが自動的に入力されます。</div>
<!-- ************************************************************************************************************************************************************** -->
<!-- *******************************************************タグ挿入エディター部分********************************************************************************* -->
<!-- ************************************************************************************************************************************************************** -->
        <div id="BBcode_Editor">
            <p><a href="javascript:add_tag(document.editForm.body, 'b');" id="code_b" onmouseover="popHelp('bH', event.pageX, event.pageY);" onmouseout="hiddenHelp('bH');"><span>太字</span></a></p>
            <p><a href="javascript:add_tag(document.editForm.body, 'i');" id="code_i" onmouseover="popHelp('iH', event.pageX, event.pageY);" onmouseout="hiddenHelp('iH');"><span>斜体</span></a></p>
            <p><a href="javascript:add_tag(document.editForm.body, 'u');" id="code_u" onmouseover="popHelp('uH', event.pageX, event.pageY);" onmouseout="hiddenHelp('uH');"><span>下線</span></a></p>
            <p><a href="javascript:add_tag(document.editForm.body, 'd');" id="code_d" onmouseover="popHelp('dH', event.pageX, event.pageY);" onmouseout="hiddenHelp('dH');"><span>打消線</span></a></p>
            <p><img src="./skin/dummy.gif" width="7" height="22" alt="" /></p>
            <p><a href="javascript:add_tag(document.editForm.body, 'large');" id="code_size1" onmouseover="popHelp('largeH', event.pageX, event.pageY);" onmouseout="hiddenHelp('largeH');"><span>フォントサイズ大</span></a></p>
            <p><a href="javascript:add_tag(document.editForm.body, 'small');" id="code_size2" onmouseover="popHelp('smallH', event.pageX, event.pageY);" onmouseout="hiddenHelp('smallH');"><span>フォントサイズ小</span></a></p>
            <p><a href="javascript:void(0)" onclick="openPalette(event);" id="code_color" onmouseover="popHelp('colorH', event.pageX, event.pageY);" onmouseout="hiddenHelp('colorH');"><span>フォント色</span></a></p>
            <p><a href="javascript:void(0)" onclick="openPalette2(event);" id="code_marker" onmouseover="popHelp('markerH', event.pageX, event.pageY);" onmouseout="hiddenHelp('markerH');"><span>マーカー</span></a></p>
            <p><img src="./skin/dummy.gif" width="7" height="22" alt="" /></p>
            <p><a href="javascript:add_tag(document.editForm.body, 'left');" id="code_left" onmouseover="popHelp('leftH', event.pageX, event.pageY);" onmouseout="hiddenHelp('leftH');"><span>位置（左）</span></a></p>
            <p><a href="javascript:add_tag(document.editForm.body, 'center');" id="code_center" onmouseover="popHelp('centerH', event.pageX, event.pageY);" onmouseout="hiddenHelp('centerH');"><span>位置（中）</span></a></p>
            <p><a href="javascript:add_tag(document.editForm.body, 'right');" id="code_right" onmouseover="popHelp('rightH', event.pageX, event.pageY);" onmouseout="hiddenHelp('rightH');"><span>位置（右）</span></a></p>
            <p><a href="javascript:add_tag(document.editForm.body, 'justify');" id="code_justify" onmouseover="popHelp('justifyH', event.pageX, event.pageY);" onmouseout="hiddenHelp('justifyH');"><span>均等割付</span></a></p>
            <p><img src="./skin/dummy.gif" width="7" height="22" alt="" /></p>
            <p><a href="javascript:add_tag(document.editForm.body, 'quo');" id="code_quote" onmouseover="popHelp('quoteH', event.pageX, event.pageY);" onmouseout="hiddenHelp('quoteH');"><span>引用文</span></a></p>
            <p><a href="javascript:add_tag(document.editForm.body, 'code');" id="code_code" onmouseover="popHelp('codeH', event.pageX, event.pageY);" onmouseout="hiddenHelp('codeH');"><span>コード</span></a></p>
            <p><a href="javascript:add_tag(document.editForm.body, 'noparse');" id="code_noparse" onmouseover="popHelp('noparseH', event.pageX, event.pageY);" onmouseout="hiddenHelp('noparseH');"><span>ビービーコード</span></a></p>
            <p><a href="javascript:void(0);" onclick="insertBBCode(document.editForm,'url','');return false;" id="code_url" onmouseover="popHelp('urlH', event.pageX, event.pageY)" onmouseout="hiddenHelp('urlH');"><span>ウェブリンク</span></a></p>
            <p><a href="javascript:add_tag(document.editForm.body, 'wiki');" id="code_wiki" onmouseover="popHelp('wikiH', event.pageX, event.pageY);" onmouseout="hiddenHelp('wikiH');"><span>ウィキペディア</span></a></p>
            <p><a href="javascript:add_tag(document.editForm.body, 'marquee');" id="code_marquee" onmouseover="popHelp('marqueeH', event.pageX, event.pageY);" onmouseout="hiddenHelp('marqueeH');"><span>マーキー</span></a></p>
        </div>
<!-- ************************************************************************************************************************************************************** -->
<!-- *******************************************************各機能のポップヘルプ文章******************************************************************************* -->
<!-- ************************************************************************************************************************************************************** -->
        <div id="bH" class="pophelp">文字を太くすることができます。<br />普通 → <span style="font-weight:bold;">太字</span></div>
        <div id="iH" class="pophelp">文字を斜体にすることができます。<br />普通 → <span style="font-style:italic;">斜体</span></div>
        <div id="uH" class="pophelp">文字に下線を加えることができます。<br />普通 → <span style="text-decoration:underline;">下線</span></div>
        <div id="dH" class="pophelp">文字に打消線を加えることができます。<br />普通 → <span style="text-decoration:line-through;">打消線</span></div>
        <div id="largeH" class="pophelp">文字の大きさを大きくすることができます。<br />普通サイズ → <span style="font-size:120%; line-height:100%;">大きいサイズ</span></div>
        <div id="smallH" class="pophelp">文字の大きさを小さくすることができます。<br />普通サイズ → <span style="font-size:80%; line-height:100%;">小さいサイズ</span></div>
        <div id="colorH" class="pophelp">文字の色を変えたい時に使用します。クリックするとカラーパレットが開きますので好きな色を選択してください。</div>
        <div id="leftH" class="pophelp">文字の位置を左寄りにします。</div>
        <div id="centerH" class="pophelp">文字の位置を真中寄りにします。</div>
        <div id="rightH" class="pophelp">文字の位置を右寄りにします。</div>
        <div id="justifyH" class="pophelp">文字を均等割付します。</div>
        <div id="markerH" class="pophelp">文字の背景色を変えたい時に使用します。蛍光ペンのマーカーの様な機能です。</div>
        <div id="quoteH" class="pophelp">文章が引用文であることがわかるようにする際に使用します。</div>
        <div id="codeH" class="pophelp">技術的なコード（PHP.CGI.XHTML.CSS.etc）を記載する際に使用します。</div>
        <div id="noparseH" class="pophelp">BBcodeをそのまま記載する際に使用します。変換は行われずに表示されます。</div>
        <div id="urlH" class="pophelp">ウェブリンクを記載することができます。</div>
        <div id="wikiH" class="pophelp">指定語句のウィキペディアへのリンクを記載することができます。</div>
        <div id="marqueeH" class="pophelp">電光掲示板の様に文字を動かすことができます。</div>
        <span id="marker_palette" class="palette_pop"></span>
        <span id="color_palette" class="palette_pop"></span>
    </div>
</div>
({/literal})
({***** BBCode終わり *****})
({/if})
