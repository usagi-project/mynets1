({$inc_ktai_header|smarty:nodefaults})

<div align="center"><font color="orange">({$c_member.nickname|t_body:'name'})さんのﾎｰﾑ</font></div>
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
<div align="center">
<a href="({t_url m=ktai a=page_h_message_box})&amp;({$tail})">&em_mail;</a>|
<a href="({t_url m=ktai a=page_h_ashiato})&amp;({$tail})">&em_foot;</a>|
<a href="({t_url m=ktai a=page_h_diary_edit})&amp;({$tail})">&em_pen;</a>|
<a href="({t_url m=ktai a=page_h_calendar_day})&amp;({$tail})" accesskey="8">&em_book;</a>|
<a href="({t_url m=ktai a=page_fh_diary_list})&amp;({$tail})">&em_pc;</a>|
<a href="({t_url m=ktai a=page_fh_dengon})&amp;target_c_member_id_to=({$c_member.c_member_id})&amp;({$tail})" accesskey="6">&em_memo;</a>

</div>

<div>&em_1square;({if $c_diary_friend_list})<a href="({t_url m=ktai a=page_h_diary_list_friend})&amp;({$tail})" accesskey="1"><font color="blue">ﾌﾚﾝﾄﾞ最新日記</font></a><blink>&em_new;</blink>({else})ﾌﾚﾝﾄﾞ最新日記({/if})</div>

<div>&em_2square;({if $c_diary_my_comment_list})<a href="({t_url m=ktai a=page_h_diary_comment_list})&amp;({$tail})" accesskey="2"><font color="blue">日記ｺﾒﾝﾄ更新履歴</font></a><blink>&em_new;</blink>({else})日記ｺﾒﾝﾄ更新履歴({/if})</div>

<div>&em_3square;({if $c_commu_topic_list})<a href="({t_url m=ktai a=page_h_com_comment_list})&amp;({$tail})" accesskey="3"><font color="blue">ﾄﾋﾟｯｸ更新</font></a><blink>&em_new;</blink>({else})ﾄﾋﾟｯｸ更新({/if})</div>

<div>&em_4square;({if $c_commu_list})<a href="({t_url m=ktai a=page_fh_com_list})&amp;({$tail})" accesskey="4"><font color="blue">Myｺﾐｭﾆﾃｨﾘｽﾄ</font></a>({else})Myｺﾐｭﾆﾃｨﾘｽﾄ({/if})</div>


<div>&em_5square;<a href="#mfriend" accesskey="5"><font color="blue">Myﾌﾚﾝﾄﾞ</font></a></div>

<div align="center"><font color="green">♪画面替えOK♪</font></div>
<div>&em_7square;<a href="({t_url m=ktai a=page_h_config})&amp;({$tail})" accesskey="7"><font color="blue">設定変更</font></a></div>
<hr>

&em_book;<a href="({t_url m=ktai a=page_h_diary_list_all})&amp;({$tail})">みんなの日記</a><br>

<div align="center">
<a href="({t_url m=ktai a=page_h_bookmark_list})&amp;({$tail})">Bookmark</a>/<a href="({t_url m=ktai a=page_h_ranking})&amp;({$tail})">Dayﾗﾝｷﾝｸﾞ</a></div>

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

<hr>
({if $c_friend_list})
<a name="mfriend"></a><font color="green">[({$WORD_MY_FRIEND_HALF})]</font><br>

<div align="right"><a href="({t_url m=ktai a=page_fh_friend_list})&amp;({$tail})">→({$WORD_MY_FRIEND_HALF})ﾘｽﾄ</a></div>
<div align="right"><a href="({t_url m=ktai a=page_h_manage_friend})&amp;({$tail})">→({$WORD_MY_FRIEND_HALF})管理</a><br>
<a href="#top" accesskey="*">▲</a></div>
({/if})

<hr>

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
({**@author Hirohisa Seta UsagiProject**})
