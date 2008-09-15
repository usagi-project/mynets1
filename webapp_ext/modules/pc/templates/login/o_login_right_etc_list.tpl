            <div><!--サイドバー最新公開日記の月別-->
                <!--現在非表示-->
                <h2>月別の日記</h2>
                <ul>
                    ({foreach from=$diary_month item=item})
                    <li>
                        <a href="({$item.url})" class="top">({$item.subject|t_body:'title'|t_truncate:"20"})</a>
                    </li>
                    ({/foreach})
                </ul>
                <!--サイドバー最新公開日記の月別終わり-->
            </div>

            <div>
            <span class="style1">
            <!--サイドバー最新公開トピック-->
            </span>
            <h2 class="blue style1">最新のOpenCommunity</h2>
            <ul class="style7">
                ({foreach from=$commu_list item=item})
                <li>
                    <a href="({$item.url})" class="top">({$item.info|bbcode2del|t_body:'title'|t_truncate:"20"})</a>
                </li>
                ({/foreach})
            </ul>
            <span class="style7">
            <!--サイドバー最新公開トピック終わり-->
            </span>
            </div>
