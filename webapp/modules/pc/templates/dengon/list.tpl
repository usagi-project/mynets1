({window2 id="dengon2" class="border_07" title="titlestyle2 bg_06" name="伝言板の表示"})
<div class="whatsnew">

<table>
 ({foreach from=$c_dengon_comment item=c_dengon})
   <tr bgcolor="({cycle values="#eeeeee,#d0d0d0"})">
   <td width="120" valign="top"><a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$c_dengon.c_member_id_from})">({$c_dengon.nickname|t_body:'name'|default:"&nbsp;"})</a><br>({$c_dengon.r_datetime|date_format:"%m/%d %H:%M"})</td>
   <td width="300">({$c_dengon.body|t_body:'dengon'|default:"&nbsp;"})
   ({if $c_dengon.c_member_id_from == $u || $target_c_member_id == $u})
     [<a href="({t_url m=pc a=page_fh_dengon_delete_c_dengon_comment_confirm})&amp;target_c_dengon_comment_id=({$c_dengon.c_dengon_comment_id})&amp;target_c_member_id_to=({$target_c_member_id})">削除</a>]
   ({/if})
   </td>
   </tr>
 ({/foreach})
</table>

<span class="iconArrow4"><a href="({t_url m=pc a=page_fh_dengon})&amp;target_c_member_id=({$target_c_member_id})">もっと読む</a></span>

</div>
({/window2})
