<?php

/* ========================================================================
 *
 * @license This source file is subject to version 3.01 of the PHP license,
 *              that is available at http://www.php.net/license/3_01.txt
 *              If you did not receive a copy of the PHP license and are unable
 *              to obtain it through the world-wide-web, please send a note to
 *              license@php.net so we can mail you a copy immediately.
 *
 * @project    OpenPNE UsagiProject 2006-2007
 * @author     Tetsuji,Katsuki <info@usagi.mynets.jp>
 * @author     Kuniharu Tsujioka <kunitsuji@gmail.com>
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @chengelog  [2007/09/10] Ver1.1.1Nighty package
 * ========================================================================
 */

require_once OPENPNE_WEBAPP_EXT_DIR .'/modules/pc/page/h_home_right_side.php';
require_once(OPENPNE_WEBAPP_DIR .'/lib/OpenPNE/KtaiUA.php');

//デフォルトページ
$GLOBALS['__Framework']['default_page'] = 'h_home';

//<PCKTAI
if (!OPENPNE_ENABLE_PC) {
    // disable pc module
    exit;
}
//>

function init_pc_page(&$smarty)
{
    //20080714 iphone 対応設定
    $agent = new OpenPNE_KtaiUA();
    $iphone = false;
    if ($agent->is_iphone())
    {
        $iphone = true;
    }
    $smarty->assign('is_iphone', $iphone);
    //　ここまで

    //文言系
    $smarty->assign('WORD_FRIEND', WORD_FRIEND);
    $smarty->assign('WORD_MY_FRIEND', WORD_MY_FRIEND);
    $smarty->assign('WORD_FRIEND_HALF', WORD_FRIEND_HALF);
    $smarty->assign('WORD_MY_FRIEND_HALF', WORD_MY_FRIEND_HALF);

    $is_secure = $GLOBALS['__Framework']['is_secure'];

    //---- inc_ テンプレート用 変数 ----//
    $smarty->assign('inc_html_header', fetch_inc_html_header());
    $smarty->assign('inc_page_footer', fetch_inc_page_footer($is_secure));
//    $smarty->assign('inc_extension_pagelayout_top', p_common_c_siteadmin4target_pagename('inc_page_top'));
    $smarty->assign('inc_extension_pagelayout_bottom', p_common_c_siteadmin4target_pagename('inc_page_bottom'));
    $smarty->assign('inc_extension_pagelayout_top2', p_common_c_siteadmin4target_pagename('inc_page_top2'));
    $smarty->assign('inc_extension_pagelayout_bottom2', p_common_c_siteadmin4target_pagename('inc_page_bottom2'));
    $smarty->assign('inc_side_banner', db_banner_get_side_banner($is_secure));
    $smarty->assign('side_banner_html_before', p_common_c_siteadmin4target_pagename('side_banner_html_before'));
    $smarty->assign('side_banner_html_after', p_common_c_siteadmin4target_pagename('side_banner_html_after'));

    if ($is_secure) {
        $smarty->assign('inc_page_header', fetch_inc_page_header());
        @session_start();
        $smarty->assign('PHPSESSID', md5(session_id()));
        $smarty->assign('before_after', 'after');
        if (OPENPNE_USE_API) {
            $smarty->assign('api_params', api_get_params($GLOBALS['AUTH']->uid()));
        }
    } else {
        $smarty->assign('before_after', 'before');
    }
    // sideblock
    // 表示内容を入れ替える場合は、h_home_right_side.tplの表示順番を入れ替えてください。
    // 各項目を表示をするしないは、config.phpの最後にtrue,falseとして表示されていますので、
    // そちらを変更してください。
    if (defined('DISPLAY_SIDE_BLOCK') && DISPLAY_SIDE_BLOCK) {
        if ($is_secure) {
            // 認証後のページで表示する場合
            //日記新着順
            if ($GLOBALS['MYNETS_DISABLE_SIDE_VIEW_MODULES']['newdiary']) {
                $smarty->assign('side_new_diary_list', getSiteDiary(10));
            }
            //トピック新着順
            if ($GLOBALS['MYNETS_DISABLE_SIDE_VIEW_MODULES']['newtopic']) {
                $smarty->assign('side_new_topic_list', getNewUpdateTopic(5,topic));
            }
            //イベント新着順
            if ($GLOBALS['MYNETS_DISABLE_SIDE_VIEW_MODULES']['newevent']) {
                $smarty->assign('side_new_event_list', getNewUpdateTopic(5,event));
            }
            //レビュー新着順
            if ($GLOBALS['MYNETS_DISABLE_SIDE_VIEW_MODULES']['newreview']) {
                $smarty->assign('side_new_review_list', getSiteNewReview(5));
            }
            // コミュニティ新着順
            if ($GLOBALS['MYNETS_DISABLE_SIDE_VIEW_MODULES']['newcommunity']) {
                $smarty->assign('side_new_community_list', getSiteNewCommunity(5,90));
            }
            //新規登録メンバー順
            if ($GLOBALS['MYNETS_DISABLE_SIDE_VIEW_MODULES']['newmember']) {
                $smarty->assign('side_new_user_list', getSiteNewMember(7,90));
            }
            //オンラインメンバー順
            if ($GLOBALS['MYNETS_DISABLE_SIDE_VIEW_MODULES']['onlinemember']) {
                $smarty->assign('side_online_user_list', getSiteOnlineMember(7,5));
            }
        } else if (defined('DISPLAY_SIDE_BLOCK_WITHOUT_LOGIN') && DISPLAY_SIDE_BLOCK_WITHOUT_LOGIN) {
            // 認証前、ログインページなどで表示する場合
            if ($GLOBALS['MYNETS_DISABLE_SIDE_VIEW_MODULES']['newdiary']) {
                $smarty->assign('side_new_diary_list', getSiteDiary(10, 'open'));
            }
            /*
            if ($GLOBALS['MYNETS_DISABLE_SIDE_VIEW_MODULES']['newtopic']) {
                $smarty->assign('side_new_topic_list', getNewUpdateTopic(5,topic));
            }
            */
            /*
            if ($GLOBALS['MYNETS_DISABLE_SIDE_VIEW_MODULES']['newevent']) {
                $smarty->assign('side_new_event_list', getNewUpdateTopic(5,event));
            }
            */
            /*
            if ($GLOBALS['MYNETS_DISABLE_SIDE_VIEW_MODULES']['newreview']) {
                $smarty->assign('side_new_review_list', getSiteNewReview(5));
            }
            */
            /*
            if ($GLOBALS['MYNETS_DISABLE_SIDE_VIEW_MODULES']['newcommunity']) {
                $smarty->assign('side_new_community_list', getSiteNewCommunity(5,90));
            }
            */
            /*
            if ($GLOBALS['MYNETS_DISABLE_SIDE_VIEW_MODULES']['newmember']) {
                $smarty->assign('side_new_user_list', getSiteNewMember(7,90));
            }
            */
            // ログインページにオンラインメンバーを表示するのは問題があるかも
            // しれないため、必要に応じてコメントアウトを外してください
            //if ($GLOBALS['MYNETS_DISABLE_SIDE_VIEW_MODULES']['onlinemember']) {
            //    $smarty->assign('side_online_user_list', getSiteOnlineMember(7,5));
            //}
        }
    }

}

function init_pc_do()
{
    $is_secure = $GLOBALS['__Framework']['is_secure'];

    if ($is_secure) {
        if ($_REQUEST['sessid'] !== md5(session_id())) {
            openpne_display_error('前の画面を再読み込みして、操作をやり直してください');
        }
    }
}

//2008-08-05 KAZUKI POP3MAIL対応
if (defined('USE_POP_MAIL') && USE_POP_MAIL)
{
    $mail = new pop3mail();
    $mail->getPopMail();
}

?>
