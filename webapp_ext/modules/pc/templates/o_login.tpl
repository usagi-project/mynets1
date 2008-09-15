({ext_include file="login/o_login_header.tpl"})
    <div id="left">
        <!--this block left 01 -->
        <div class="login">
        ({ext_include file="login/o_login_left_login.tpl"})
        </div>
        <!--this block left 01 -->

        <!--this block left 02 -->
        <div>
        ({ext_include file="login/o_login_left_menu.tpl"})
        </div>
        <!--this block left 02 -->

        <!--this block left 03 -->
        <div>
        ({ext_include file="login/o_login_left_tabpanel.tpl"})
        </div>
        <!--this block left 03 -->

        <!--this block left 04 -->
        <div>
        ({**ext_include file="login/o_login_left_tabpanel.tpl"**})
        </div>
        <!--this block left 04 -->

    </div>

    <div id="right">

        <div id="right_box">
        <!-- this block right 01 -->
        ({ext_include file="login/o_login_right_banner.tpl"})

        <!-- this block right 02 -->
        ({ext_include file="login/o_login_right_diary_list.tpl"})

        <!-- this block right 03 -->
        ({ext_include file="login/o_login_right_etc_list.tpl"})

        <!-- this block right 04 -->
        ({ext_include file="login/o_login_right_etc_table.tpl"})

        <!-- this block right 05 -->
        ({ext_include file="login/o_login_right_news_list.tpl"})

        </div>

    </div>

    <div id="main">
        <div><!-- TOP IMAGE BLOCK -->
        ({ext_include file="login/o_login_main_top_img.tpl"})
        </div>
        <br />
        <!-- INFORMATION -->
        ({ext_include file="login/o_login_main_information.tpl"})

        <!-- OpenDiary -->
        ({ext_include file="login/o_login_main_opendiary.tpl"})
        <!--新着日記のループここまで-->

        <!-- OpenCommu -->
        ({ext_include file="login/o_login_main_opencommu.tpl"})

    <!-- メインここまで -->
    </div>

    <!-- フッター -->
    ({ext_include file="login/o_login_page_footer.tpl"})
    <!-- フッターここまで -->
({ext_include file="login/o_login_footer.tpl"})
