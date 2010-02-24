<?php

/* ========================================================================
 *
 * @license This source file is subject to version 3.01 of the PHP license,
 *              that is available at http://www.php.net/license/3_01.txt
 *              If you did not receive a copy of the PHP license and are unable
 *              to obtain it through the world-wide-web, please send a note to
 *              license@php.net so we can mail you a copy immediately.
 *
 * @category   Application of MyNETS
 * @project    OpenPNE UsagiProject 2006-2007
 * @package    MyNETS
 * @author     UsagiProject <info@usagi-project.org>
 * @author     Hyodo 2007/04/03 help support
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi-project.org/member.html>
 * @version    MyNETS,v 1.0.0
 * @since      File available since Release 1.0.0 Nighty
 * @chengelog  [2007/02/17] Ver1.1.0Nighty package
 *             [2007/04/03] help
 * ========================================================================
 */

/**
 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 */

/**
 * メッセージコードからメッセージを得る
 */
function k_p_common_msg4msg_id($msg_id)
{
    if (is_null($msg_id)) return '';

    $msg =
    array(
        0   => "ログインに失敗しました",
        1   => "本文を入力してください",
        2   => "タイトルを入力してください",
        3   => "承認が完了しました",
        4   => "承認依頼を削除しました",
        5   => "このフレンドは、現在リンク承認待ちです",
        6   => "このフレンドは、すでにリンク済みです",
        7   => "教える".WORD_MY_FRIEND_HALF."を選択してださい",
        8   => "メッセージを入力してください",
        9   => "このメンバーは既に登録済みです",
        10  => "管理者なので退会できません",
        11  => "このコミュニティのメンバではありません",
        12  => "メールアドレスを入力してください",
        13  => "携帯アドレスには送信できません",
        14  => "かんたんﾛｸﾞｲﾝに失敗しました。通常ﾛｸﾞｲﾝ後、設定してください",
        15  => "ログインしてください",
        16  => "携帯アドレス以外は指定できません",
        17  => "このアドレスはすでに登録されています",
        18  => "パスワードが違います",
        19  => "携帯メールアドレスを登録しました",
        20  => "パスワードは6～12文字の半角英数で入力してください",
        21  => "パスワードを変更しました",
        22  => "質問を選択してください",
        23  => "答えを入力してください",
        24  => "秘密の質問・答えを変更しました",
        25  => "パスワード再発行できませんでした",
        26  => "新しいパスワードをメールで送信しました",
        27  => "携帯の個体識別番号を取得できませんでした",
        28  => "かんたんログイン設定を完了しました",
        29  => "かんたんログイン設定を解除しました",
        30  => "招待メールを送信しました",
        31  => "メールアドレスを正しく入力してください",
        32  => "メール受信設定を変更しました",
        33  => "紹介文を入力してください",
        34  => "あしあとお知らせメール設定を変更しました",
        35  => "日記の公開設定を変更しました",
        36  => "アクセスブロック設定を変更しました",
        101  => "ﾒｯｾｰｼﾞ内容受信設定を変更しました。",
        102 => "メールでヘルプを送信しました。",
        103 => "メールアドレスが設定されていないのでヘルプを送信できませんでした。",
        104 => "招待状のアドレスが無効です。招待状メールが全文受信できていない可能性があります。全文受信できている場合は招待状を再発行してください。"
        );

    return $msg[$msg_id];
}

/**
 * 携帯電話からのアクセスかどうかを User-Agent の値から判別する
 *
 * @return bool
 */
function isKtaiUserAgent()
{
    include_once 'OpenPNE/KtaiUA.php';
    $ktaiUA = new OpenPNE_KtaiUA();
    if (! defined('IPHONE_IS_MOBILE'))
    {
        define('IPHONE_IS_MOBILE', FALSE);
    }
    if (! $ktaiUA->is_iphone)
    {
        return $ktaiUA->is_ktai();
    }
    else
    {
        //IPHONEを携帯として接続させるかどうかを返す
        return IPHONE_IS_MOBILE;
    }
}

/**
 * fhページのタイプを取得
 */
function k_p_fh_common_get_type($target_c_member_id, $u)
{
    // ナビゲーションタイプ : "h" | "f"
    if ($target_c_member_id && $target_c_member_id != $u) {
        return 'f';
    } else {
        return 'h';
    }
}

/** 関数
 * k_p_c_bbs_c_member_admin4c_commu_topic_id($c_commu_topic_id)
 *
 *
 */
function k_p_h_message_ktai_url4url($str, $tail)
{
    $matches = array();
    $friend_url = null;
    $com_url = null;

    // 旧形式のURL
    $pat = '|https?://.+page.php\?p=(c_home.+target_c_commu_id=\d+)$|';
    if (preg_match($pat, $str, $matches)) {
        if (!empty($matches[1])) {
            $com_url = OPENPNE_URL."?m=ktai&a=page_".$matches[1]."&$tail";
        }
        $str = preg_replace($pat, "", $str);
    }
    $pat = '|https?://.+page.php\?p=(f_home.+target_c_member_id=\d+)$|';
    if (preg_match($pat, $str, $matches)) {
        if (!empty($matches[1])) {
            $friend_url = OPENPNE_URL."?m=ktai&a=page_".$matches[1]."&$tail";
        }
        $str = preg_replace($pat, "", $str);
    }

    // 新形式のURL
    $pat = '|https?://.+\?m=pc(&a=page_c_home.+target_c_commu_id=\d+)$|';
    if (preg_match($pat, $str, $matches)) {
        if (!empty($matches[1])) {
            $com_url = OPENPNE_URL."?m=ktai".$matches[1]."&$tail";
        }
        $str = preg_replace($pat, "", $str);
    }
    $pat = '|https?://.+\?m=pc(&a=page_f_home.+target_c_member_id=\d+)$|';
    if (preg_match($pat, $str, $matches)) {
        if (!empty($matches[1])) {
            $friend_url = OPENPNE_URL."?m=ktai".$matches[1]."&$tail";
        }
        $str = preg_replace($pat, "", $str);
    }

    return array($str, $com_url, $friend_url);
}

function fetch_inc_ktai_header()
{
    $inc_smarty = new OpenPNE_Smarty($GLOBALS['SMARTY']);
    $inc_smarty->templates_dir = 'ktai/templates';

    if (SNS_TITLE) {
        $inc_smarty->assign('title', SNS_TITLE);
    } else {
        $inc_smarty->assign('title', SNS_NAME);
    }
    $inc_smarty->assign('inc_ktai_html_head', p_common_c_siteadmin4target_pagename('inc_ktai_html_head'));
    $inc_smarty->assign('inc_ktai_header', p_common_c_siteadmin4target_pagename('inc_ktai_header'));

    return $inc_smarty->ext_fetch('inc_ktai_header.tpl');
}

function fetch_inc_ktai_footer()
{
    $inc_smarty = new OpenPNE_Smarty($GLOBALS['SMARTY']);
    $inc_smarty->templates_dir = 'ktai/templates';

    $inc_smarty->assign('inc_ktai_footer', p_common_c_siteadmin4target_pagename('inc_ktai_footer'));
    if(@isset($GLOBALS['KTAI_URL_TAIL']))
      $inc_smarty->assign('tail', $GLOBALS['KTAI_URL_TAIL']);

    //ヘルプファイル
    if ($GLOBALS['__Framework']['current_type'] == 'page') {
        $action = $GLOBALS['__Framework']['current_action'];
        if ($help = openpne_ext_search("ktai/help/{$action}.tpl")) {
            $inc_smarty->assign('help', $action);
        }
    }

    return $inc_smarty->ext_fetch('inc_ktai_footer.tpl');
}

function t_get_user_hash($c_member_id, $length = 12)
{
    $hashed_password = k_common_hashed_password4c_member_id($c_member_id);
    $seed = strval($c_member_id) . $hashed_password;

    return substr(md5($seed), 0, $length);
}

function ktai_display_error($errors)
{
    $smarty = new OpenPNE_Smarty($GLOBALS['SMARTY']);
    $smarty->setOutputCharset('SJIS');
    $smarty->templates_dir = 'ktai/templates';
    $smarty->assign('inc_ktai_header', fetch_inc_ktai_header());
    $smarty->assign('inc_ktai_footer', fetch_inc_ktai_footer());
    $smarty->assign('errors', (array)$errors);
    $smarty->ext_display('error.tpl');
    exit;
}
function fetch_inc_ktai_help($page)
{
    $inc_smarty = new OpenPNE_Smarty($GLOBALS['SMARTY']);
    $inc_smarty->templates_dir = 'ktai/help';
    return $inc_smarty->ext_fetch("{$page}.tpl");
}
?>
