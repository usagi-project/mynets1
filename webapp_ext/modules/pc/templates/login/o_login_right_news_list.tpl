        ({if $smarty.const.DISPLAY_NEWS_BLOCK && ($before_after === 'after' || ($before_after !== 'after' && $smarty.const.DISPLAY_NEWS_BLOCK_WITHOUT_LOGIN))})
            <span class="style7">({t_assign_news var=side_news_list})</span>
            ({if $side_news_list})
                <div id="sidenews">
                    <div id="side_news_list">
                    <h2 class="green style1">ニュース</h2>
                    ({foreach from=$side_news_list item=item})
                    <p>
                    <a href="({t_url m=pc a=page_h_diary_add})&amp;subject=({'【ニュース】'|escape:'hex':'UTF-8'})({$item.title|escape:'hex':'UTF-8'})&amp;body=({'【ニュース】'|escape:'hex':'UTF-8'})({$item.title|escape:'hex':'UTF-8'})({"\n"|escape:'hex':'UTF-8'})({$item.permalink|smarty:nodefaults|replace:"&amp;":"&"|escape:'hex':'UTF-8'})">
                    <img src="({t_img_url_skin filename=icon_pen})" alt="ニュースを元に日記を書いてみよう！" />
                    </a>
                    &nbsp;<a href="({$item.permalink|smarty:nodefaults})" target="_blank"({if $item.text}) title="({if $item.category})[({$item.category[0]})] ({"\n"})({/if})({$item.text}) ({"\n"})(({$item.date}))"({else}) title="({if $item.category})[({$item.category[0]})] ({/if})(({$item.date}))"({/if})>({$item.title})
                    </a>
                    </p>
                    ({/foreach})
                    </div>
                    <div style="text-align:right;padding:5px;">
                    <img src="./skin/default/img/dummy.gif" class="icon arrow_1" />
                    <a href="?m=pc&amp;a=page_h_sns_news">もっと読む
                    </a>
                    </div>
                </div>
            ({/if})
        ({/if})
