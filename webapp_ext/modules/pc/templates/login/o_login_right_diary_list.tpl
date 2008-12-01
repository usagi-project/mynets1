            <h2 class="blue style1 style4">最新の公開日記</h2>
            <ul>
                <!--公開日記ループ処理-->
                ({foreach from=$diary_list item=item})
                <li class="style7">
                    <a href="({$item.url})" class="top">({$item.subject|bbcode2del|t_truncate:"20"|t_body:'title'})</a>
                </li>
                ({/foreach})
                <!--公開日記ループ処理終わり-->
            </ul>
