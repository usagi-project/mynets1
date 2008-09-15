({$inc_ktai_header|smarty:nodefaults})

<center><font color="orange">日記画像編集</font></center>
<hr>

({foreach from=$image_list item=item})
画像({$item.number})
({if $item.image_filename})
[<a href="({t_img_url filename=$item.image_filename w=120 h=120 f=jpg})">小</a>/<a href="({t_img_url filename=$item.image_filename w=360 h=360 f=jpg})">大</a>]<br>
({/if})
({if $item.image_filename})
[<a href="({t_url m=ktai a=page_h_diary_edit_delete_image_confirm})&amp;target_c_diary_id=({$target_c_diary_id})&amp;del_img=({$item.number})&amp;({$tail})">画像({$item.number})削除</a>]<br>
[<a href="mailto:({$item.mail_address})">画像({$item.number})更新</a>]<br>
({else})
[<a href="mailto:({$item.mail_address})">画像({$item.number})掲載</a>]<br>
({/if})
<br>
({/foreach})
<br>
[<a href="({t_url m=ktai a=page_fh_diary})&amp;target_c_diary_id=({$target_c_diary_id})&amp;({$tail})">日記へ戻る</a>]<br>
<hr>
※ﾘﾝｸをｸﾘｯｸすると&em_mail;送信画面になります。あて先を変えずに写真を添付して&em_mail;を送信してください。<br>
※&em_mail;を送信した後、この画面を再読込みすると掲載の確認ができます。<br>
({$inc_ktai_footer|smarty:nodefaults})