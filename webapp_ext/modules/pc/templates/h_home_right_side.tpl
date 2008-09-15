({if $smarty.const.DISPAY_SIDE_BLOCK && ($before_after === 'after' || ($before_after !== 'after' && $smarty.const.DISPLAY_SIDE_BLOCK_WITHOUT_LOGIN))})
({if $side_new_event_list || $side_new_diary_list || $side_new_topic_list || $side_new_review_list || $side_new_user_list || $side_online_user_list})
<div id="sidebar">
<h2>新着情報</h2>

({if $side_new_event_list})
<h2>新着イベント</h2>
<ul>
({foreach from=$side_new_event_list item=item})
<li>
開催日：({$item.open_date|default:"&nbsp;"})<br>

<a href="?m=pc&amp;a=page_c_home&amp;target_c_commu_id=({$item.c_commu_id})" title="({$item.c_commu_name|default:"&nbsp;"})">({$item.c_commu_name|t_truncate:"24"|t_body:'title'|default:"&nbsp;"})</a><br>
<a href="?m=pc&amp;a=page_c_topic_detail&amp;target_c_commu_topic_id=({$item.c_commu_topic_id})" title="({$item.name|default:"&nbsp;"})">({$item.name|t_truncate:"24"|t_body:'title'|default:"&nbsp;"})(({$item.number|default:0}))</a><br></li>
({/foreach})
</ul>

<div align="right"><img src="./skin/default/img/dummy.gif" class="icon arrow_1">
<a href="?m=pc&amp;a=page_h_com_comment_list">もっと読む</a></div>
({/if})

({if $side_new_diary_list})
<h2>新着日記</h2>
<ul>

({foreach from=$side_new_diary_list item=item})
<li>
<a href="?m=pc&amp;a=page_f_home&amp;target_c_member_id=({$item.c_member_id})" title="日付=({$item.r_datetime|default:"&nbsp;"})">({$item.nickname|t_body:'name'})さんの日記</a><br>
<a href="?m=pc&amp;a=page_fh_diary&amp;target_c_diary_id=({$item.c_diary_id})" title="({$item.subject|default:"&nbsp;"})">({$item.subject|t_truncate:"24"|t_body:'title'|default:"&nbsp;"})(({$item.comment_count|default:0})/({$item.etsuran_count|default:0}))</a>
</li>
({/foreach})
</ul>
<div align="right"><img src="./skin/default/img/dummy.gif" class="icon arrow_1">
<a href="?m=pc&amp;a=page_h_diary_list_all">もっと読む</a></div>
({/if})

({if $side_new_topic_list})
<h2>新着トピック</h2>
<ul>
({foreach from=$side_new_topic_list item=item})
<li>
<a href="?m=pc&amp;a=page_c_home&amp;target_c_commu_id=({$item.c_commu_id})" title="({$item.c_commu_name|default:0})">({$item.c_commu_name|t_truncate:"24"|t_body:'title'|default:0})</a><br>
<a href="?m=pc&amp;a=page_c_topic_detail&amp;target_c_commu_topic_id=({$item.c_commu_topic_id})" title="({$item.name|default:0})">({$item.name|t_truncate:"24"|t_body:'title'|default:0})(({$item.number|default:0}))</a><br></li>
({/foreach})
</ul>

<div align="right"><img src="./skin/default/img/dummy.gif" class="icon arrow_1">
<a href="?m=pc&amp;a=page_h_com_comment_list">もっと読む</a></div>
({/if})

({if $side_new_review_list})
<div id="side_new_review_list">
<h2>新着レビュー</h2>
<ul>
({foreach from=$side_new_review_list item=item})
<li>
({if $item.category_disp})<a href="?m=pc&amp;a=page_h_review_search&amp;category=({$item.c_review_category_id})" title="({$item.category_disp|default:0})">({$item.category_disp|t_truncate:"28"|t_body:'title'|default:"&nbsp;"})<br>({/if})
<a href="?m=pc&amp;a=page_h_review_list_product&amp;c_review_id=({$item.c_review_id})" title="({$item.title|default:0}) (({$item.r_datetime|default:"&nbsp;"}))">({$item.title|t_truncate:"28"|t_body:'title'|default:0})</a><br></li>
({/foreach})

</ul>
<div align="right"><img src="./skin/default/img/dummy.gif" class="icon arrow_1">
<a href="?m=pc&amp;a=page_h_review_search">もっと読む</a></div>

</div>
({/if})

({if $side_new_community_list})
<div id="side_new_community_list">
<h2>新着コミュニティ</h2>
<ul>
({foreach from=$side_new_community_list item=item})
<li><a href="?m=pc&amp;a=page_c_home&amp;target_c_commu_id=({$item.c_commu_id})" title="({$item.name|default:''}) (({$item.r_date}))">({$item.name|t_truncate:"26"|t_body:'title'|default:''})</a></li>
({/foreach})

<div align="right"><img src="./skin/dummy.gif" class="icon arrow_1">
<a href="?m=pc&amp;a=page_h_com_find_all">もっと読む</a></div>
</ul>
</div>
({/if})

({if $side_new_user_list})
<h2>新規参加者</h2>
<ul>
({foreach from=$side_new_user_list item=item})
<li>
<a href="?m=pc&amp;a=page_f_home&amp;target_c_member_id=({$item.c_member_id})" title="ID=({$item.c_member_id|default:"&nbsp;"})">({$item.nickname|t_body:'name'})さん</a><br>
</li>
({/foreach})
</ul>
({/if})

({if $side_online_user_list})
<h2>オンラインメンバー</h2>
<ul>
({foreach from=$side_online_user_list item=item})
<li>
<a href="?m=pc&amp;a=page_f_home&amp;target_c_member_id=({$item.c_member_id})" title="ID=({$item.c_member_id|default:"&nbsp;"})">({$item.nickname|t_body:'name'})さん</a><br>
</li>
({/foreach})
</ul>
({/if})

</div>
({/if})
({/if})
