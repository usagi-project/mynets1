        <!-- インフォメーション　バナー -->
        <!--<img src="({$smarty.const.OPENPNE_URL})images/login/information_bar.jpg" />-->
        <h3>サイトからのお知らせ</h3>
        ({if $newslist})
            <table>
                <tr>
                    <th class="first"><strong>post</strong> date</th>
                    <th>title</th>
                    <th>description</th>
                </tr>
                ({foreach from=$newslist item=item})
                <tr class="row-a">
                    <td class="first">({$item.r_datetime|date_format:"%m/%d"})</td>
                    <td>({$item.subject})</td>
                    <td>({$item.body|nl2br})</td>
                </tr>
                ({/foreach})
            </table>
        ({else})
            現在サイトからのお知らせはありません
        ({/if})
        <br />
