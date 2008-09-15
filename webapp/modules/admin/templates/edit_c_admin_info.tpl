({$inc_header|smarty:nodefaults})
<h2>SNS設定：お知らせ変更・HTML挿入</h2>

<table>
<tr>
<td style="vertical-align:top;">

<p>お知らせ</p>
<ul>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_admin_info')})&amp;target=h_home">【PC版】 h_homeのお知らせ(固定表示)</a></li>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_information_check')})">【PC版】 h_homeのお知らせ(リスト表示)</a></li>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_admin_info')})&amp;target=k_h_home">【携帯】 h_homeのお知らせ</a></li>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_admin_info')})&amp;target=k_fh_diary">【携帯】 fh_diaryのお知らせ</a></li>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_admin_info')})&amp;target=k_f_home">【携帯】 f_homeのお知らせ</a></li>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_admin_info')})&amp;target=k_c_home">【携帯】 c_homeのお知らせ</a></li>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_admin_info')})&amp;target=daily_news_head">デイリーニュース上部</a></li>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_admin_info')})&amp;target=daily_news_foot">デイリーニュース下部</a></li>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_admin_info')})&amp;target=inc_side_menu">プロフィール写真下メニュー編集</a></li>
</ul>

<p>規約</p>
<ul>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_admin_info')})&amp;target=sns_kiyaku">利用規約</a></li>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_admin_info')})&amp;target=sns_privacy">プライバシーポリシー</a></li>
</ul>

<p>ヘルプページ</p>
<ul>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_admin_info')})&amp;target=o_sns_help">ログイン前ヘルプ</a></li>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_admin_info')})&amp;target=h_sns_help">ログイン後ヘルプ</a></li>
</ul>

<p>HTML挿入</p>
<ul>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_admin_info')})&amp;target=inc_page_footer_before">ログイン前フッター</a></li>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_admin_info')})&amp;target=inc_page_footer_after">ログイン後フッター</a></li>
</ul>

PC版全ページ共通
<ul>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_admin_info')})&amp;target=inc_html_head">HTML挿入(HTML head内)</a></li>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_admin_info')})&amp;target=inc_page_top2">HTML挿入&nbsp;A</a></li>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_admin_info')})&amp;target=inc_page_top">HTML挿入&nbsp;B</a></li>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_admin_info')})&amp;target=inc_page_bottom2">HTML挿入&nbsp;C</a></li>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_admin_info')})&amp;target=inc_page_bottom">HTML挿入&nbsp;D</a></li>
</ul>

携帯版全ページ共通
<ul>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_admin_info')})&amp;target=inc_ktai_html_head">HTML挿入(HTML head内)</a></li>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_admin_info')})&amp;target=inc_ktai_header">HTML挿入(ページ上部)</a></li>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_admin_info')})&amp;target=inc_ktai_footer">HTML挿入(ページ下部)</a></li>
</ul>

（上級者向け設定）
<ul>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_entry_point')})">テンプレート挿入</a></li>
</ul>
</td>

<td style="vertical-align:top;">

<p>
({if $requests.target == 'h_home'})
＜ＰＣ版＞ホームのお知らせ
({elseif $requests.target == 'k_h_home'})
＜携帯版＞ホームのお知らせ
({elseif $requests.target == 'k_fh_diary'})
＜携帯版＞日記ページのお知らせ
({elseif $requests.target == 'k_f_home'})
＜携帯版＞フレンドページのお知らせ
({elseif $requests.target == 'k_c_home'})
＜携帯版＞コミュニティページのお知らせ
({elseif $requests.target == 'sns_kiyaku'})
利用規約
({elseif $requests.target == 'sns_privacy'})
プライバシーポリシー
({elseif $requests.target == 'daily_news_head'})
デイリーニュース上部
({elseif $requests.target == 'daily_news_foot'})
デイリーニュース下部
({elseif $requests.target == 'inc_html_head'})
【PC版】HTML挿入(HTML head内)
({elseif $requests.target == 'inc_page_top2'})
【PC版】HTML挿入 A
({elseif $requests.target == 'inc_page_top'})
【PC版】HTML挿入 B　（旧：【PC版】HTML挿入(ページ上部)）
({elseif $requests.target == 'inc_page_bottom2'})
【PC版】HTML挿入 C
({elseif $requests.target == 'inc_page_bottom'})
【PC版】HTML挿入 D　（旧：【PC版】HTML挿入(ページ下部)）
({elseif $requests.target == 'inc_ktai_html_head'})
【携帯】HTML挿入(HTML head内)
({elseif $requests.target == 'inc_ktai_header'})
【携帯】HTML挿入(ページ上部)
({elseif $requests.target == 'inc_ktai_footer'})
【携帯】HTML挿入(ページ下部)
({/if})
</p>

({if $msg})
<div class="caution">({$msg})</div>
({/if})

<form action="./" method="post">
<input type="hidden" name="m" value="({$module_name})">
<input type="hidden" name="a" value="do_({$hash_tbl->hash('edit_c_admin_info','do')})">
<input type="hidden" name="sessid" value="({$PHPSESSID})">
<input type="hidden" name="target" value="({$requests.target})">
<textarea name="body" cols="({$cols|default:60})" rows="({$rows|default:10})">({$c_siteadmin.body})</textarea><br>
<input type="submit" class="submit" value="変更">
</form>

({if $requests.target == 'sns_kiyaku' || $requests.target == 'sns_privacy'})
<p class="caution">※HTMLタグは使用<strong>できません</strong>が、URLはリンクされます。</p>
({elseif $requests.target == 'o_sns_help' || $requests.target == 'h_sns_help'})
<p class="caution">※HTMLタグが使用できますが、タグの閉じ忘れ等がありますと表示が崩れる等<br>
の問題が起こることがありますのでご注意ください。</p>
<br>
<p class="caution">ログイン前ヘルプのリンク<br>
&lt;a href="?m=pc&a=page_o_sns_help" target="_blank"&gt;ヘルプ&lt;/a&gt;<br>
<br>
ログイン後ヘルプのリンク<br>
&lt;a href="?m=pc&a=page_h_sns_help" target="_top"&gt;ヘルプ&lt;/a&gt;</p>
({elseif $requests.target == 'daily_news_head' || $requests.target == 'daily_news_foot'})
({else})
<p class="caution">※PCの場合はHTMLタグが使用できますが、タグの閉じ忘れ等がありますと表示が崩れる等<br>
の問題が起こることがありますのでご注意ください。</p>
<br>
<p class="caution">※携帯の場合は、ダイレクトにURLへジャンプをさせないため（セキュリティを考慮）HTMLタグが<br>使用できません。URLを直接入力するとリンク変換されます。又改行はテキストエリア内で改行<br>を行うと反映されます。</p>
({/if})

({if $requests.target == 'inc_page_top2' || $requests.target == 'inc_page_top' || $requests.target == 'inc_page_bottom2' || $requests.target == 'inc_page_bottom'})
<p class="caution">※内容が空のときはHTML挿入部分が表示されないので各HTML挿入部分に該当する隙間はブラウザ内枠との間に生じません。</p>

<p>
<img src="modules/admin/img/HTML_sounyu.gif" style="border: 2px solid #FF0000;">
</p>

({/if})

</td>
</tr>
</table>

({$inc_footer|smarty:nodefaults})