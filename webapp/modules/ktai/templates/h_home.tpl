({if $MyDisplayTemplate})
        ({ext_include file="$MyDisplayTemplate/h_home.tpl"})
({else})
({$inc_ktai_header|smarty:nodefaults})

<div align="center"><font color="orange">({$c_member.nickname|t_body:'name'})さんのﾎｰﾑ</font></div>
({if $mobileadmin})<div align="center"><a href="({t_url m=ktai a=page_h_admin_login})&amp;({$tail})">&em_mobile;携帯管理画面へ</a></div>
({/if})
<hr>
({if $birthday_flag})
☆Happy Birthday☆<br>
お誕生日おめでとうございます
<hr>
({/if})

({if $c_siteadmin})
({$c_siteadmin|t_body:'kadmin'})
<hr>
({/if})

({if $num_f_confirm_list})
<a href="({t_url m=ktai a=page_h_confirm_list})&amp;({$tail})"><font color="red">★承認待ちのﾒﾝﾊﾞｰ({$num_f_confirm_list})名</font></a><br>
({/if})

({if $num_message_not_is_read})
<a href="({t_url m=ktai a=page_h_message_box})&amp;({$tail})"><font color="red">★新着ﾒｯｾｰｼﾞ({$num_message_not_is_read})件</font></a></font><br>
({/if})

({if $num_diary_not_is_read})
<a href="({t_url m=ktai a=page_fh_diary})&amp;target_c_diary_id=({$first_diary_read})&amp;({$tail})"><font color="red">★({$num_diary_not_is_read})件日記に新着ｺﾒﾝﾄ</font></a><br>
({/if})

({if $num_h_confirm_list })
<a href="({t_url m=ktai a=page_h_confirm_list})&amp;({$tail})"><font color="red">★ｺﾐｭﾆﾃｨ参加承認待ち({$num_h_confirm_list})名</font></a><br>
({/if})

({if $anatani_c_commu_admin_confirm_list})
<a href="({t_url m=ktai a=page_h_confirm_list})&amp;({$tail})"><font color="red">★ｺﾐｭﾆﾃｨ管理人交代依頼({$num_anatani_c_commu_admin_confirm_list})件</font></a><br>
({/if})

({if $anatani_c_commu_admin_confirm_list||$num_f_confirm_list||$num_message_not_is_read||$num_diary_not_is_read||$num_h_confirm_list||$anatani_c_commu_admin_confirm_list})
<hr>
({/if})
<marquee loop="infinity">({$oneword})</marquee>
&em_pen;<a href="({t_url m=ktai a=page_h_one_word_write})&amp;({$tail})">({$smarty.const.QUICK_SERVICE_NAME}) -投稿する-</a>
<div align="center">
<a href="({t_url m=ktai a=page_h_message_box})&amp;({$tail})">&em_mail;ﾒｯｾｰｼﾞ箱</a>|
<a href="({t_url m=ktai a=page_h_ashiato})&amp;({$tail})">あしあと&em_foot;</a>
</div>
<div>&em_1square;({if $c_diary_friend_list})<a href="#fdiary" accesskey="1"><font color="blue">ﾌﾚﾝﾄﾞ最新日記</font></a><blink>&em_new;</blink>({else})ﾌﾚﾝﾄﾞ最新日記({/if})</div>
<div>&em_2square;({if $c_diary_my_comment_list})<a href="#rdiary" accesskey="2"><font color="blue">日記ｺﾒﾝﾄ更新履歴</font></a><blink>&em_new;</blink>({else})日記ｺﾒﾝﾄ更新履歴({/if})</div>
<div>&em_3square;({if $c_commu_topic_list})<a href="#rcommu" accesskey="3"><font color="blue">ﾄﾋﾟｯｸ更新</font></a><blink>&em_new;</blink>({else})ﾄﾋﾟｯｸ更新({/if})</div>
<div>&em_4square;({if $c_commu_list})<a href="#mcommu" accesskey="4"><font color="blue">Myｺﾐｭﾆﾃｨﾘｽﾄ</font></a>({else})Myｺﾐｭﾆﾃｨﾘｽﾄ({/if})</div>
<div>&em_5square;<a href="#mfriend" accesskey="5"><font color="blue">Myﾌﾚﾝﾄﾞ</font></a></div>
<div>&em_6square;<a href="({t_url m=ktai a=page_fh_dengon})&amp;target_c_member_id_to=({$c_member.c_member_id})&amp;({$tail})" accesskey="6"><font color="blue">My伝言板</font></a></div>
<div align="center"><font color="green">♪画面替えOK♪</font></div>
<div>&em_7square;<a href="({t_url m=ktai a=page_h_config})&amp;({$tail})" accesskey="7"><font color="blue">設定変更</font></a></div>
<hr>
&em_book;<font color="green">ﾀﾞｲｱﾘｰ</font><br>
∟<a href="({t_url m=ktai a=page_h_diary_list_all})&amp;({$tail})">全体 日記</a>/<a href="({t_url m=ktai a=page_fh_diary_list})&amp;({$tail})">My日記</a><br>
∟<a href="({t_url m=ktai a=page_h_diary_edit})&amp;({$tail})">日記を書く</a>&em_pen;<br>
<div align="center">
<a href="({t_url m=ktai a=page_h_bookmark_list})&amp;({$tail})">Bookmark</a>/<a href="({t_url m=ktai a=page_h_ranking})&amp;({$tail})">Dayﾗﾝｷﾝｸﾞ</a></div>
&em_8square;<a href="({t_url m=ktai a=page_h_calendar_day})&amp;({$tail})" accesskey="8">ｽｹｼﾞｭｰﾙ</a>
<br>
<font color="green">♪交流しましょう&em_search;</font><br>
<div><a href="({t_url m=ktai a=page_h_com_find_all})&amp;({$tail})">ｺﾐｭﾆﾃｨ検索</a>|<a href="({t_url m=ktai a=page_h_friend_find_all})&amp;({$tail})">ﾒﾝﾊﾞｰ検索</a></div>
<div align="right">
&em_thumbs_up;<a href="({t_url m=ktai a=page_fh_intro})&amp;({$tail})">({$WORD_FRIEND_HALF})紹介文</a></div>
<div align="right">
&em_face_wink;<a href="({t_url m=ktai a=page_h_confirm_list})&amp;({$tail})">承認待ちﾘｽﾄ</a>
</div>
<hr>
<div align="right"><a href="#top" accesskey="*"><font color="blue">▲(*ｷｰ)</font></a>|<a href="#bottom" accesskey="#"><font color="blue">▼(#ｷｰ)</font></a>
</div>
({if $c_diary_friend_list})
<hr>
<a name="fdiary"></a><font color="green">&em_1square;[({$WORD_FRIEND_HALF})最新日記]</font><br>
({foreach from=$c_diary_friend_list item=item})
({$item.r_datetime|t_date})(({$item.nickname|t_truncate:36:""|t_body:'name'}))
({if $item.view_flag})
<blink>&em_new;</blink>
({/if})
<br>
<a href="({t_url m=ktai a=page_fh_diary})&amp;target_c_diary_id=({$item.c_diary_id})&amp;({$tail})">({$item.subject|t_truncate:36:".."|t_body:'title'})</a>
<div align="right"><font size="1" color="blue">(ｺﾒﾝﾄ:({$item.comment_count})|閲覧:({$item.etsuran_count}))</font>({if $item.image_filename_1 || $item.image_filename_2 || $item.image_filename_3})&em_camera;({/if})</div>
({/foreach})
<div align="right"><a href="({t_url m=ktai a=page_h_diary_list_friend})&amp;({$tail})">→もっと見る</a><br>
<a href="#top" accesskey="*">▲</a></div>
({/if})
({if $c_diary_my_comment_list})
<hr>
<a name="rdiary"></a><font color="green">&em_2square;[日記ｺﾒﾝﾄ記入履歴]</font><br>
({foreach from=$c_diary_my_comment_list item=item})
({$item.r_datetime|t_date})(({$item.nickname|t_truncate:36:""|t_body:'name'}))
({if $item.view_flag})
<blink>&em_new;</blink>
({/if})
({if $item.edit_flag})
&em_memo;
({/if})<br>
<a href="({t_url m=ktai a=page_fh_diary})&amp;target_c_diary_id=({$item.c_diary_id})&amp;({$tail})">({$item.subject|t_truncate:36:".."|t_body:'title'})</a><div align="right"><font size="1" color="blue">(ｺﾒﾝﾄ:({$item.comment_count})|閲覧:({$item.etsuran_count}))</font>({if $item.image_filename_1 || $item.image_filename_2 || $item.image_filename_3})&em_camera;({/if})</div>
({/foreach})
<div align="right"><a href="({t_url m=ktai a=page_h_diary_comment_list})&amp;({$tail})">→もっと見る</a><br>
<a href="#top" accesskey="*">▲</a></div>
({/if})
({if $c_commu_topic_list})
<hr>
<a name="rcommu"></a><font color="green">&em_3square;[ｺﾐｭﾆﾃｨ最新書き込み]</font><br>
({foreach from=$c_commu_topic_list item=item})
({$item.e_datetime|t_date})(({$item.c_commu_name|t_truncate:36:""|t_body:'name'}))<br>
<a href="({t_url m=ktai a=page_c_bbs})&amp;target_c_commu_topic_id=({$item.c_commu_topic_id})&amp;({$tail})">({$item.c_commu_topic_name|t_truncate:36:".."|t_body:'name'})</a>(({$item.number}))({if $item.image_filename_1 || $item.image_filename_2 || $item.image_filename_3})&em_camera;({/if})<br>
({/foreach})
<div align="right"><a href="({t_url m=ktai a=page_h_com_comment_list})&amp;({$tail})">→もっと見る</a><br>
<a href="#top" accesskey="*">▲</a></div>
({/if})
<hr>
<a name="mcommu"></a><font color="green">&em_4square;[参加ｺﾐｭﾆﾃｨ({if $count_commu})(({$count_commu}))({/if})]</font><br>
({if $c_commu_list})
({foreach from=$c_commu_list item=commu})
<a href="({t_url m=ktai a=page_c_home})&amp;target_c_commu_id=({$commu.c_commu_id})&amp;({$tail})">({$commu.name|t_body:'name'})</a>(({$commu.count_members}))<br>
({/foreach})
<div align="right"><a href="({t_url m=ktai a=page_fh_com_list})&amp;({$tail})">→もっと見る</a></div>
({else})
参加していません<br>
({/if})
<div align="right"><a href="({t_url m=ktai a=page_h_com_find_all})&amp;({$tail})">→ｺﾐｭﾆﾃｨ検索</a><br>
<a href="#top" accesskey="*">▲</a></div>
<hr>
({if $c_friend_list})
<a name="mfriend"></a><font color="green">[({$WORD_MY_FRIEND_HALF})]</font><br>
<!--({foreach from=$c_friend_list item=friend})
<a href="({t_url m=ktai a=page_f_home})&amp;target_c_member_id=({$friend.c_member_id_to})&amp;({$tail})">({$friend.nickname|t_body:'name'})</a>（({$friend.count_friend})）<br>
({/foreach})-->
<div align="right"><a href="({t_url m=ktai a=page_fh_friend_list})&amp;({$tail})">→({$WORD_MY_FRIEND_HALF})ﾘｽﾄ</a></div>
<div align="right"><a href="({t_url m=ktai a=page_h_manage_friend})&amp;({$tail})">→({$WORD_MY_FRIEND_HALF})管理</a><br>
<a href="#top" accesskey="*">▲</a></div>
({/if})
<hr>
<!--<a href="({t_url m=ktai a=page_h_friend_find_all})&amp;({$tail})">ﾒﾝﾊﾞｰ検索</a><br>-->
({if $smarty.const.IS_USER_INVITE && ($smarty.const.OPENPNE_REGIST_FROM != $smarty.const.OPENPNE_REGIST_FROM_NONE)})
<a href="({t_url m=ktai a=page_h_invite})&amp;({$tail})">友人を招待</a><br>
<br>
({/if})
<a href="({t_url m=ktai a=page_h_config_prof})&amp;({$tail})">ﾌﾟﾛﾌｨｰﾙ変更</a><br>
<a href="({t_url m=ktai a=page_h_config_image})&amp;({$tail})">ﾌﾟﾛﾌｨｰﾙ写真変更</a><br>
<a href="({t_url m=ktai a=page_h_config})&amp;({$tail})">設定変更</a><br>
<br>

<a href="({t_url m=ktai a=page_o_sns_kiyaku})">利用規約</a><br>
<a href="({t_url m=ktai a=page_o_sns_privacy})">ﾌﾟﾗｲﾊﾞｼｰﾎﾟﾘｼｰ</a><br>

({$inc_ktai_footer|smarty:nodefaults})
({/if})
