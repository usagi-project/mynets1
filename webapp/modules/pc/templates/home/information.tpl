<div id="information">
<table border="0" cellspacing="0" cellpadding="0"><tr>
<td align="center" width="105" class="border_07 bg_11"><img src="({t_img_url_skin filename=icon_information})" alt="お知らせ">
</td><td width="610" class="border_07 bg_02 info_right">({$site_info|smarty:nodefaults})<br>
({if $num_f_confirm_list})
★<span class="caution">承認待ちのメンバーが({$num_f_confirm_list})名います！&nbsp;<a href="({t_url m=pc a=page_h_confirm_list})">承認・拒否</a></span><br>
({/if})
({if $num_message_not_is_read})
★<span class="caution">新着メッセージが({$num_message_not_is_read})件あります！&nbsp;<a href="({t_url m=pc a=page_h_message_box})">メッセージを読む</a></span><br>
({/if})
({if $num_diary_not_is_read})
★<span class="caution">({$num_diary_not_is_read})件の日記に対して新着コメントがあります！&nbsp;<a href="({t_url m=pc a=page_h_diary})&amp;target_c_diary_id=({$first_diary_read})">日記を見る</a></span><br>
({/if})
({if $num_h_confirm_list})
★<span class="caution">コミュニティ参加承認待ちのメンバーが({$num_h_confirm_list})名います！&nbsp;<a href="({t_url m=pc a=page_h_confirm_list})">承認・拒否</a></span><br>
({/if})
({if $anatani_c_commu_admin_confirm_list})
★<span class="caution">コミュニティ管理人交代依頼が({$num_anatani_c_commu_admin_confirm_list})件きています。&nbsp;<a href="({t_url m=pc a=page_h_confirm_list})">承認・拒否</a></span><br>
({/if})
</td></tr></table>
</div>
