<table border="0" cellspacing="0" cellpadding="0" style="width:524px;" class="border_01">
    <tr>
        <td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
        <td style="width:486px;padding:2px 0px;" class="bg_06"><span class="b_b c_00">日記を書く</span></td>
    </tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" style="width:524px;" class="border_01">
    <tr>
        <td style="width:522px;height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
    <tr>
        <td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td style="width:80px;" class="bg_05" align="center" valign="middle">
        <div style="padding:4px 3px;">
        タイトル
        </div>
        </td>
        <td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td style="width:439px;" class="bg_02" align="left" valign="middle">
        <div style="padding:4px 3px;">
        <input size="40" type="text" name="subject" class="text" value="({$form_val.subject})">
        </div>
        </td>
        <td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
    <tr>
        <td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
    <tr>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td class="bg_05" align="center" valign="middle">
        <div style="padding:4px 3px;">
        本　　文
        </div>
        </td>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td class="bg_02" align="left" valign="middle">
        <div style="padding:4px 3px;">
        ({* FeslyBBCode *})
        ({ext_include file="inc_bbcode_fesly_editor.tpl"})
        <textarea name="body" rows="15" cols="50" style="width:415px">({$form_val.body})</textarea>
        ({* BBCode *})
        ({ext_include file="inc_bbcode.tpl"})
        ({*********絵文字*********})
        ({ext_include file="new_templates/emojipat_docomo.tpl"})
        ({*********絵文字*********})
        </div>
        </td>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
    <tr>
        <td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
    <tr>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td class="bg_05" align="center" valign="middle">
        <div style="padding:4px 3px;">
        写　真 1
        </div>
        </td>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td class="bg_02" align="left" valign="middle">
        <div style="padding:4px 3px;">
        <input type="file" name="upfile_1">
        </div>
        </td>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
    <tr>
        <td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
    <tr>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td class="bg_05" align="center" valign="middle">
        <div style="padding:4px 3px;">
        写　真 2
        </div>
        </td>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td class="bg_02" align="left" valign="middle">
        <div style="padding:4px 3px;">
        <input type="file" name="upfile_2">
        </div>
        </td>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
    <tr>
        <td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
    <tr>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td class="bg_05" align="center" valign="middle">
        <div style="padding:4px 3px;">
        写　真 3
        </div>
        </td>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td class="bg_02" align="left" valign="middle">
        <div style="padding:4px 3px;">
        <input type="file" name="upfile_3">
        </div>
        </td>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
<!--
    <tr>
        <td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
    <tr>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td class="bg_05" align="center" valign="middle">
        <div style="padding:4px 3px;">
        ファイル
        </div>
        </td>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td class="bg_02" align="left" valign="middle">
        <div style="padding:4px 3px;">
        <input type="file" name="upfile_4">
        </div>
        </td>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
-->
    <tr>
        <td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
    <tr>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td class="bg_05" align="center" valign="middle">
        <div style="padding:4px 3px;">
        タ　グ
        </div>
        </td>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td class="bg_02" align="left" valign="middle">
        <div style="padding:4px 3px;">
        <input type="text" class="text" name="tagsname" id="tagsname" size="40" value="({$form_val.tagsname})">
        <select onChange="if(selectedIndex){tagsname.value += options[selectedIndex].value + ' '}">
        <option>タグを選択してください</option>
        ({foreach from=$tag_list item=item})
            <option value="({$item.c_tags_name})">({$item.c_tags_name})</option>
        ({/foreach})
        </select>
        <br>
        ※ひとつのタグは半角36文字以内で入力してください。<br>
        ※タグは5つまで登録できます。<br>
        ※複数タグを利用する場合はスペース一つで区切ってください。
        複数スペースを入れた場合は正常に認識しませんのでご注意ください。
        </div>
        </td>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
    <tr>
        <td class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
    <tr>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td class="bg_05" align="center" valign="middle">
        <div style="padding:4px 3px;">
        公開範囲
        </div>
        </td>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td class="bg_02" align="left" valign="middle">
        <div style="padding:4px 3px;">
        ({if $smarty.const.MYNETS_OPEN_DIARY})
            <input type="radio" name="public_flag" value="open"({if $form_val.public_flag == "open"}) checked="checked"({/if}) class="no_bg" id="public_flag_open"><label for="public_flag_open">外部公開</label><br>
        ({/if})
        <input type="radio" name="public_flag" value="public"({if $form_val.public_flag == "public"}) checked="checked"({/if}) class="no_bg" id="public_flag_public"><label for="public_flag_public">サイト内全体公開</label><br>
        <input type="radio" name="public_flag" value="friend"({if $form_val.public_flag == "friend"}) checked="checked"({/if}) class="no_bg" id="public_flag_friend"><label for="public_flag_friend">({$WORD_MY_FRIEND})まで公開</label><br>
        <input type="radio" name="public_flag" value="private"({if $form_val.public_flag == "private"}) checked="checked"({/if}) class="no_bg" id="public_flag_private"><label for="public_flag_private">公開しない</label><br>
        </div>
        </td>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
    <tr>
        <td class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
    <tr>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td class="bg_02" align="center" colspan="3">
        <div style="padding:4px 3px;">
        <input type="submit" class="submit" value="　確認画面　">
        </div>
        </td>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
    <tr>
        <td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
</table>
