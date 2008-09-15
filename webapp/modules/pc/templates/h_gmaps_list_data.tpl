({if $d_total_num})({$d_total_num|smarty:nodefaults})({/if})
({if $c_total_num})({$c_total_num|smarty:nodefaults})({/if})
({if $d_page_link})({$d_page_link|smarty:nodefaults})({/if})
({if $c_page_link})({$c_page_link|smarty:nodefaults})({/if})
({if $new_diary_list})
pointData = [
({foreach from=$new_diary_list item="diary" name="diary"})
{
'lat':'({$diary.lat})',
'lon':'({$diary.lon})',
'zoom':'({$diary.zoom})',
'nickname':'({$diary.c_member.nickname|replace:"\\":"\\\\"|replace:"&#039;":"\'"|t_body:'name'})',
'mid':'({$diary.c_member.c_member_id})',
'title':'({$diary.subject|strip|replace:"\\":"\\\\"|replace:"&#039;":"\'"|t_body:'title'})',
'info':'({$diary.subject|strip|replace:"\\":"\\\\"|replace:"&#039;":"\'"|t_body:'title'})({if $diary.comment_number != "top"})(コメント({$diary.comment_number}))({else})(日記)({/if})({if $diary.comment_number != "top"}) - ({$diary.body|bbcode2del|strip|t_truncate:30:"…"|replace:"\\":"\\\\"|replace:"&#039;":"\'"|t_body:'title'})({/if})',
'note':'({$diary.body|bbcode2del|strip|t_truncate:90:"…"|replace:"\\":"\\\\"|replace:"&#039;":"\'"|t_body:'title'})',
'img':'({$diary.image_filename_1})','date':'({$diary.r_datetime|date_format:"%m月%d日 %H:%M"})',
'url':'./?m=pc&a=page_fh_diary&target_c_diary_id=({$diary.c_diary_id})&page=({$diary.c_diary_link})',
'inid':'({$diary.c_diary_id})',
'oneid':'({$diary.c_diary_comment_id})'
}({if $smarty.foreach.diary.last})({else}),({/if})
({/foreach})
];
({/if})
({if $new_topic_list})
pointData2 = [
({foreach from=$new_topic_list item="topic" name="topic"})
{
'lat':'({$topic.lat})',
'lon':'({$topic.lon})',
'zoom':'({$topic.zoom})',
'nickname':'({$topic.c_member.nickname|replace:"\\":"\\\\"|replace:"&#039;":"\'"|t_body:'name'})',
'mid':'({$topic.c_member.c_member_id})',
'cmtitle':'({$topic.communame|strip|replace:"\\":"\\\\"|replace:"&#039;":"\'"|t_body:'title'})',
'title':'({$topic.communame|strip|replace:"\\":"\\\\"|replace:"&#039;":"\'"|t_body:'title'}) - ({$topic.commutopicname|strip|replace:"\\":"\\\\"|replace:"&#039;":"\'"|t_body:'title'})',
'info':'({$topic.communame|strip|replace:"\\":"\\\\"|replace:"&#039;":"\'"|t_body:'title'}) - ({$topic.commutopicname|strip|replace:"\\":"\\\\"|replace:"&#039;":"\'"|t_body:'title'})({if $topic.number})(書込({$topic.number}))({elseif $topic.event_flag})(イベント)({else})(トピック)({/if})({if $topic.number}) - ({$topic.body|bbcode2del|strip|t_truncate:30:"…"|replace:"\\":"\\\\"|replace:"&#039;":"\'"|t_body:'title'})({/if})',
'note':'({$topic.body|bbcode2del|strip|t_truncate:90:"…"|replace:"\\":"\\\\"|replace:"&#039;":"\'"|t_body:'title'})',
'img':'({$topic.image_filename1})',
'date':'({$topic.r_datetime|date_format:"%m月%d日 %H:%M"})',
'url':'./?m=pc&a=page_c_({if $topic.event_flag})event({else})topic({/if})_detail&target_c_commu_topic_id=({$topic.c_commu_topic_id})&page=({$topic.c_topic_link})',
'cmid':'({$topic.c_commu_id})',
'inid':'({$topic.c_commu_topic_id})',
'oneid':'({$topic.c_commu_topic_comment_id})'
}({if $smarty.foreach.topic.last})({else}),({/if})
({/foreach})
];
({/if})
