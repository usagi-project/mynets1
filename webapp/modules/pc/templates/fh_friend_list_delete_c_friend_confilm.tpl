({$inc_html_header|smarty:nodefaults})
<body>
({ext_include file="inc_extension_pagelayout_top.tpl"})
<table class="mainframe" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="container inc_page_header">
({$inc_page_header|smarty:nodefaults})
</td>
</tr>
<tr>
<td class="container inc_navi">
({$inc_navi|smarty:nodefaults})
</td>
</tr>
<tr>
<td class="container main_content">
<table class="container" border="0" cellspacing="0" cellpadding="0">({*BEGIN:container*})
<tr>
<td class="full_content" align="center">
({***************************})
({**ここから：メインコンテンツ**})
({***************************})

<img src="./skin/dummy.gif" class="v_spacer_l">

<!-- ************************************ -->
<!-- ******ここから：マイフレンド削除確認****** -->
<div class="border_07" style="width:650px;margin:0px auto;">

<table border="0" cellspacing="0" cellpadding="0" style="width:650px;">
    <tr>
        <td style="width:7px;" class="bg_00">
        <img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
        <td style="width:646px;" class="bg_00">
        <img src="./skin/dummy.gif" style="width:566px;height:7px;" class="dummy"></td>
        <td style="width:7px;" class="bg_00">
        <img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
    </tr>
    <tr>
        <td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
        <td class="bg_01" align="left">
<!-- *ここから：マイフレンド削除確認＞内容* -->
({*ここから：header*})
<!-- ここから：小タイトル -->
        <div class="border_01">
        <table border="0" cellspacing="0" cellpadding="0" style="width:644px;">
            <tr>
                <td style="width:36px;" class="bg_06">
                <img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
                <td style="width:468px;padding:2px 0px;" class="bg_06"><span class="b_b c_00">本当に({$WORD_MY_FRIEND})から外しますか？</span></td>
                <td style="width:140px;" align="right" class="bg_06">&nbsp;</td>
            </tr>
        </table>
        </div>
<!-- ここまで：小タイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->
        <table border="0" cellspacing="0" cellpadding="0" style="width:644px;">
({*********})
            <tr>
                <td style="width:644px;height:1px;" class="bg_01" colspan="3">
                <img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
            </tr>
({*********})
            <tr>
                <td style="width:1px;" class="bg_01" align="center">
                <img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                <td style="width:642px;" class="bg_03" align="left" valign="middle">

                <div align="center" style="text-align:center;" class="padding_w_s">
                ({if $error})
                <table border="0" cellspacing="0" cellpadding="0" style="width:100%;height:2em;">
                    <tr>
                        <td align="center">
                        <span style="color:red">
                        ({foreach from=$error item=item})
                        ({$item})<br>
                        ({/foreach})
                        </span>
                        </td>
                    </tr>
                </table>
                ({else})
                <table border="0" cellspacing="0" cellpadding="0" style="width:100%;height:2em;">
                    <tr>
                        <td style="width:50%;text-align:right;">
                        ({t_form m=pc a=do_fh_friend_list_delete_c_friend})
                        <input type="hidden" name="sessid" value="({$PHPSESSID})">
                        <input type="hidden" name="target_c_member_id" value="({$target_c_member_id})">
                        <input type="submit" class="submit" value="　外 す　">&nbsp;
                        </form>
                        </td>
                        <td>

                        ({t_form _method=get m=pc a=page_h_manage_friend})
                        &nbsp;<input type="submit"  class="submit" value="キャンセル">
                        </form>

                        </td>
                    </tr>
                </table>
                ({/if})
                </div>
                </td>
                <td style="width:1px;" class="bg_01" align="center">
                <img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
            </tr>
({*********})
            <tr>
                <td style="width:644px;height:1px;" class="bg_01" colspan="3">
                <img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
            </tr>
({*********})
        </table>
<!-- ここまで：主内容 -->
({*ここまで：body*})
({*ここから：footer*})
<!-- 無し -->
({*ここまで：footer*})
<!-- *ここまで：マイフレンド削除確認＞＞内容* -->
        </td>
        <td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
    </tr>
    <tr>
        <td style="width:7px;" class="bg_00">
        <img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
        <td style="width:566px;" class="bg_00">
        <img src="./skin/dummy.gif" style="width:566px;height:7px;" class="dummy"></td>
        <td style="width:7px;" class="bg_00">
        <img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
    </tr>
</table>

</div>
<!-- ******ここまで：マイフレンド削除確認****** -->
<!-- ************************************ -->

<img src="./skin/dummy.gif" class="v_spacer_l">


({***************************})
({**ここまで：メインコンテンツ**})
({***************************})
</td>
</tr>
</table>({*END:container*})
</td>
</tr>
<tr>
<td class="container inc_page_footer">
({$inc_page_footer|smarty:nodefaults})
</td>
</tr>
</table>
({ext_include file="inc_extension_pagelayout_bottom.tpl"})
</body>
</html>
