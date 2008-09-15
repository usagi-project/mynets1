<div id="news" style="text-align:left;">
    ({if $data})
    ({foreach from=$data item="data" key="key"})
    <!-- ループスタート -->
    <div style="margin:10px;border:#cccccc 1px dotted;background:#ffffff;clear:both;" class="clearfix">
        <div style="font-size:12px;padding:10px;">
            ({if $data.date})
            <div>
                <img src="({t_img_url_skin filename=icon_3})" style="margin-right:5px;" align="absmiddle">&nbsp;({$data.date|date_format:"%Y年%m月%d日%H:%M"})
            </div>
            ({/if})
            <div style="font-size:14px;padding:5px 0;font-weight:bold;">
                <a href="({$data.permalink|smarty:nodefaults})" target="_blank">({$data.title|smarty:nodefaults})</a>
            </div>
            ({if $data.text != '' && $data.body == ''})
            <div>
                ({$data.text})
            </div>
            ({elseif $data.body != ''})
            <div id="text({$key})" class="newscont">
                ({$data.text})&nbsp;<a href="javascript:void(0);" onclick="$('text({$key})').innerHTML = $('body({$key})').innerHTML" class="exception">もっと詳しく</a>
            </div>
            ({/if})
        </div>
        <div style="text-align:right;margin:1px;padding:5px;" class="bg_06">
            <img src="({t_img_url_skin filename=icon_arrow_1})" align="absmiddle">&nbsp;<a href="({t_url m=pc a=page_h_diary_add})&amp;subject=({'【ニュース】'|escape:'hex':'UTF-8'})({$data.title|escape:'hex':'UTF-8'})&amp;body=({'【ニュース】'|escape:'hex':'UTF-8'})({$data.title|escape:'hex':'UTF-8'})({"\n"|escape:'hex':'UTF-8'})({$data.permalink|smarty:nodefaults|replace:"&amp;":"&"|escape:'hex':'UTF-8'})" class="exception">この記事で日記を書く</a>
        </div>
        ({if $data.body})
        <div style="display:none;" id="body({$key})">
            ({$data.body|smarty:nodefaults})
        </div>
        ({/if})
    </div>
    <!-- ループエンド -->
    ({/foreach})
    ({else})
    <div style="margin:10px;padding:10px;border:#cccccc 1px dotted;background:#ffffff;clear:both;">
        ニュースがありません
    </div>
    ({/if})
</div>
