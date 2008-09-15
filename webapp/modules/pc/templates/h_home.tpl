({$inc_html_header|smarty:nodefaults})
<body>
<script type="text/javascript" src="./js/javascripts/scriptaculous.js?load=effects,dragdrop,controls"></script>
<script type="text/javascript">
    var sid = "({$PHPSESSID})";
</script>
<script type="text/javascript" src="./js/javascripts/oneword.js"></script>
<script type="text/javascript" src="./js/javascripts/info.js"></script>
<script type="text/javascript" src="./js/javascripts/pane.js"></script>
<script type="text/javascript" src="./js/javascripts/tabs.js"></script>
({ext_include file="inc_extension_pagelayout_top.tpl"})
<table class="mainframe" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td class="container inc_page_header">
        ({$inc_page_header|smarty:nodefaults})
        </td>
    </tr>
    ({if $inc_entry_point[1]})
    <tr>
        <td class="container">
        ({$inc_entry_point[1]|smarty:nodefaults})
        </td>
    </tr>
    ({/if})
    <tr>
        <td class="container inc_navi">
        ({$inc_navi|smarty:nodefaults})
        </td>
    </tr>
    ({if $inc_entry_point[2]})
    <tr>
        <td class="container">
        ({$inc_entry_point[2]|smarty:nodefaults})
        </td>
    </tr>
    ({/if})
    ({if $smarty.const.DISPLAY_SEARCH_HOME})
    <tr>
        <td class="container inc_search_box">
        ({ext_include file="inc_search_box.tpl"})
        </td>
    </tr>
    ({/if})
    ({if $birthday_flag})
    <tr>
        <td class="container" align="center">
        <div class="padding_s">
        <img src="({t_img_url_skin filename=birthday_h})">
        </div>
        </td>
    </tr>
    ({/if})
    <tr>
        <td class="container inc_info">
        ({ext_include file="inc_info.tpl"})
        </td>
    </tr>
    ({if $inc_entry_point[3]})
    <tr>
        <td class="container">
        ({$inc_entry_point[3]|smarty:nodefaults})
        </td>
    </tr>
    ({/if})
    <tr>
        <td class="container main_content">
        <table class="container" border="0" cellspacing="0" cellpadding="0">({*BEGIN:container*})
            <tr>
                <td style="width:5px;"><img src="./skin/dummy.gif" style="width:5px;" class="dummy"></td>({*<--spacer*})
                <td class="left_content" valign="top">
({********************************})
({**ここから：メインコンテンツ（左）**})
({********************************})

                ({if $inc_entry_point[4]})
                    ({$inc_entry_point[4]|smarty:nodefaults})
                ({/if})

                ({*自分のプロフィール写真などを取得、表示*})
                ({ext_include file="new_templates/my_prof_img.tpl"})
                ({*自分のプロフィール写真などを取得、表示  ここまで*})
                <img src="./skin/dummy.gif" class="v_spacer_m">

                ({if $inc_entry_point[5]})
                ({$inc_entry_point[5]|smarty:nodefaults})
                ({/if})

                ({ext_include file="new_templates/my_friend_list.tpl"})

                ({if $inc_entry_point[6]})
                ({$inc_entry_point[6]|smarty:nodefaults})
                ({/if})

                ({ext_include file="new_templates/my_commu_entry_list.tpl"})

                ({ext_include file="new_templates/bookmark_member_list.tpl"})

                <img src="./skin/dummy.gif" class="v_spacer_m">
                ({if $inc_entry_point[7]})
                    ({$inc_entry_point[7]|smarty:nodefaults})
                ({/if})

({********************************})
({**ここまで：メインコンテンツ（左）**})
({********************************})
                </td>
                <td style="width:5px;"><img src="./skin/dummy.gif" style="width:5px;" class="dummy"></td>
                <td class="right_content" valign="top">
({********************************})
({**ここから：メインコンテンツ（右）**})
({********************************})

                ({if $inc_entry_point[8]})
                    ({$inc_entry_point[8]|smarty:nodefaults})
                ({/if})

                ({if $inc_entry_point[9]})
                    ({$inc_entry_point[9]|smarty:nodefaults})
                ({/if})

                <div id="rightpane" style="width:440px;">
                    ({**カレンダー**})
                    <div id="dv1" style="display:none;">({if $calendar})({ext_include file="new_templates/myschedule.tpl"})({/if})</div>
                    ({**クイックコミュニケーション**})
                    <div id="dv2" style="display:none;">({ext_include file="new_templates/dengon_list.tpl"})</div>
                    ({**フレンド最新日記**})
                    <div id="dv3" style="display:none;">({if $c_diary_friend_list})({ext_include file="new_templates/friend_diary_list.tpl"})({/if})</div>
                    ({**フレンド最新ブログ**})
                    <div id="dv4" style="display:none;">({if $c_rss_cache_list})({ext_include file="new_templates/friend_blog_list.tpl"})({/if})</div>
                    ({**日記コメント履歴**})
                    <div id="dv5" style="display:none;">({if $c_diary_my_comment_list})({ext_include file="new_templates/diary_comment_list.tpl"})({/if})</div>
                    ({**参加コミュニティ最新書き込み**})
                    <div id="dv6" style="display:none;">({if $c_commu_topic_comment_list})({ext_include file="new_templates/my_commu_new_list.tpl"})({/if})</div>
                    ({**フレンド最新レビュー**})
                    <div id="dv7" style="display:none;">({if $c_friend_review_list})({ext_include file="new_templates/friend_new_review_list.tpl"})({/if})</div>
                    ({**お気に入り最新日記**})
                    <div id="dv8" style="display:none;">({if $bookmark_diary_list})({ext_include file="new_templates/bookmark_diary_list.tpl"})({/if})</div>
                    ({**お気に入り最新ブログ**})
                    <div id="dv9" style="display:none;">({if $bookmark_blog_list})({ext_include file="new_templates/bookmark_blog_list.tpl"})({/if})</div>
                    ({**自己情報一覧**})
                    <div id="dv10" style="display:none;">({if $c_diary_list || $c_blog_list || $c_review_list})({ext_include file="new_templates/my_diary_etc_list.tpl"})({/if})</div>
                    ({**紹介文**})
                    <div id="dv11" style="display:none;">({if $c_friend_intro_list})({ext_include file="new_templates/myintro.tpl"})({/if})</div>
                </div>
                ({if $inc_entry_point[10]})
                    ({$inc_entry_point[10]|smarty:nodefaults})
                ({/if})

                ({if $inc_entry_point[11]})
                    ({$inc_entry_point[11]|smarty:nodefaults})
                ({/if})

                ({if $inc_entry_point[12]})
                    ({$inc_entry_point[12]|smarty:nodefaults})
                ({/if})

                <!-- 今日のひとことふきだしアンカー -->
                <span id="wedge"></span>

                <script type="text/javascript">
                    /*インフォメーション初期化*/
                    geticon();
                    /*ブロック初期化*/
                    makepane();
                    /*今日のひとこと初期化*/
                    makeoneword();
                    makeballoon();
                </script>

({********************************})
({**ここまで：メインコンテンツ（右）**})
({********************************})
                </td>
            </tr>
        </table>({*END:container*})
    </td>
</tr>
<!--<tr>
    <td class="inc_page_footer">
        ({$inc_page_footer|smarty:nodefaults})
    </td>
</tr>-->
</table>
<table class="mainframe" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="inc_page_footer">
({$inc_page_footer|smarty:nodefaults})
</td></tr></table>
({ext_include file="inc_extension_pagelayout_bottom.tpl"})
</body>
</html>
