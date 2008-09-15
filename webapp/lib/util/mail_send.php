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
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @author     Katsunori Matsuda UsagiProject
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @version    MyNETS,v 1.0.0
 * @since      File available since Release 1.0.0 Nighty
 * @chengelog  [2007/02/17] Ver1.1.0Nighty package
 *             [2007-10-09] Ver1.1.1Nighty
 * ========================================================================
 */

/**
 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 */

//----- 共通関数

/**
 * メール送信
 */
function t_send_email($address, $subject, $body, $is_receive_mail=true, $from=ADMIN_EMAIL)
{
    if (!$is_receive_mail || !db_common_is_mailaddress($address)) {
        return false;
    }

    // 改行コード
    $cr = "\x0D";
    $lf = "\x0A";
    $crlf = "\x0D\x0A";

    // 設定値によりMTAに渡すヘッダの区切り記号を分ける
    if (MAIL_HEADER_SEP === 'CRLF') {
        $sep = $crlf;
    } else {
        $sep = $lf;
    }

    // header
    $headers = "MIME-Version: 1.0" . $sep;
    $headers .= "Content-Type: text/plain; charset=iso-2022-jp" . $sep;
    $headers .= "From: $from";

    // 半角カナを全角カナに変換
    if (MAIL_HAN2ZEN) {
        $subject = mb_convert_kana($subject, "KV");
        $body = mb_convert_kana($body, "KV");
    }

    // subject (改行コードを含んではならない)
    $subject = mb_convert_encoding($subject, "JIS");
    $subject = str_replace(array($cr, $lf), "", $subject);
    $subject = '=?ISO-2022-JP?B?'.base64_encode($subject).'?=';

    // body (LF)
    if (MAIL_WRAP_WIDTH) {
        $body = t_wordwrap($body, MAIL_WRAP_WIDTH);
    }
    $body = mb_convert_encoding($body, "JIS");
    $body = str_replace($cr, $lf, str_replace($crlf, $lf, $body));

    if (!ini_get('safe_mode')) {
        if (MAIL_ENVFROM) {
            $f = MAIL_ENVFROM;
        } else {
            $f = ADMIN_EMAIL;
        }
        $params = '-f' . escapeshellcmd($f);
        return mail($address, $subject, $body, $headers, $params);
    } else {
        return mail($address, $subject, $body, $headers);
    }
}

/**
 * mailテンプレート内容をfetch
 *
 * @param string $tpl_name テンプレート名(/templates/mail 直下のファイル)
 * @param array $params Smartyでassignされる連想配列
 * @return string Smartyが出力したHTMLの文字列
 */
function fetch_mail_m_tpl($tpl_name, $params)
{
    $params["OPENPNE_URL"] = OPENPNE_URL;
    $params["SNS_NAME"] = SNS_NAME;
    $params["ADMIN_EMAIL"] = ADMIN_EMAIL;
    $params["CATCH_COPY"] = CATCH_COPY;
    $params["OPERATION_COMPANY"] = OPERATION_COMPANY;
    $params["COPYRIGHT"] = COPYRIGHT;

    // メールの場合はHTMLエスケープしない
    $local_configs = $GLOBALS['SMARTY'];
    $local_configs['default_modifiers'] = array();
    $local_configs['autoload_filters'] = array();

    $smarty = new OpenPNE_Smarty($local_configs);
    $smarty->assign($params);
    $smarty->assign('inc_signature', fetch_inc_signature($smarty));
    $smarty->assign('WORD_FRIEND', WORD_FRIEND);
    $smarty->assign('WORD_MY_FRIEND', WORD_MY_FRIEND);
    $smarty->assign('WORD_FRIEND_HALF', WORD_FRIEND_HALF);
    $smarty->assign('WORD_MY_FRIEND_HALF', WORD_MY_FRIEND_HALF);

    $tpl_name = str_replace('.tpl', '', $tpl_name);
    if (util_is_unused_mail($tpl_name)) {
        return false;
    }

    if ($smarty->template_exists('db:' . $tpl_name)) {
        $tpl = 'db:' . $tpl_name;
        $cache_id = $compile_id = 'mail';
    } else {
        $place = '';
        $path = sprintf('templates/mail/%s.tpl', $tpl_name);
        $tpl = 'file:' . mail_ext_search($path, $place);
        $cache_id = $compile_id = 'mail_'. $place;
    }

    $subject_and_body = $smarty->fetch($tpl, $cache_id, $compile_id);
    return explode("\n", $subject_and_body, 2);
}

function fetch_inc_signature($smarty)
{
    $tpl_db = 'db:inc_signature';
    if ($smarty->template_exists($tpl_db)) {
        $tpl = $tpl_db;
        $cache_id = $compile_id = 'mail';
    } else {
        $place = '';
        $path = 'templates/mail/inc_signature.tpl';
        $tpl = 'file:' . mail_ext_search($path, $place);
        $cache_id = $compile_id = 'mail_'. $place;
    }
    return $smarty->fetch($tpl, $cache_id, $compile_id);
}

function mail_ext_search($path, &$place)
{
    $dft = OPENPNE_WEBAPP_DIR . '/' . $path;
    $ext = OPENPNE_WEBAPP_EXT_DIR . '/' . $path;

    if (USE_EXT_DIR && is_readable($ext)) {
        $place = 'ext';
        return $ext;
    } elseif (is_readable($dft)) {
        $place = 'dft';
        return $dft;
    }

    return false;
}

function get_c_template_mail_source($tpl_name)
{
    $source = '';
    if (!($source = db_get_c_template_source($tpl_name))) {
        include_once 'PHP/Compat/Function/file_get_contents.php';

        $place = '';
        $tpl_file = $tpl_name . '.tpl';
        $path = 'templates/mail/' . $tpl_file;
        if ($tpl = mail_ext_search($path, $place)) {
            $source = file_get_contents($tpl);
        }
    }
    return $source;
}

function fetch_send_mail($address, $tpl_name, $params = array(), $force = true, $from = '')
{
    $tpl_name .= '.tpl';
    if ($tpl = fetch_mail_m_tpl($tpl_name, $params)) {
        list($subject, $body) = $tpl;
        if ($from) {
            t_send_email($address, $subject, $body, $force, $from);
        } else {
            t_send_email($address, $subject, $body, $force);
        }
        return true;
    } else {
        return false;
    }
}

//-----

//本登録完了メール 登録者へ
//2007-10-09 Katsunori Matsudaさんのカスタマイズをマージ Kunitsuji
//author Katsunori Matsuda
function do_regist_prof_do_regist2_mail_send($c_member_id)
{
    $c_member = db_common_c_member4c_member_id($c_member_id, true);
    $pc_address = $c_member['secure']['pc_address'];
    $params = array(
        "c_member" => $c_member,
    );

    if (ADMIN_INVITE_MAIL === false) {
        return fetch_send_mail($pc_address, 'm_pc_invite_end', $params);
    } else {
        fetch_send_mail($pc_address, 'm_pc_invite_end', $params);
        //**********ここから追記***********//
        // 管理者に新規登録者を通知
        $params = array(
                    "c_member"       => $c_member,
                    "c_member_email" => $pc_address,
                    "entry_date"     => db_now(),
                  );
        return fetch_send_mail(ADMIN_EMAIL, 'm_admin_invite_end', $params);
    }
}

//招待メール
function do_h_invite_insert_c_invite_mail_send($c_member_id_invite, $session, $message, $pc_address)
{
    $params = array(
        "c_member" => db_common_c_member4c_member_id($c_member_id_invite),
        "sid" => $session,
        "invite_message"=> $message,
    );
    return fetch_send_mail($pc_address, 'm_pc_syoutai_mail', $params);
}

//パスワード再発行メール
function do_password_query_mail_send($c_member_id, $pc_address, $new_password)
{
    $params = array(
        "c_member"   => db_common_c_member4c_member_id($c_member_id),
        "pc_address" => $pc_address,
        "password"   => $new_password,
    );
    return fetch_send_mail($pc_address, 'm_pc_password_query', $params);
}

//パスワード再発行メール(携帯)
function db_mail_send_m_ktai_password_query($c_member_id, $new_password)
{
    $c_member = db_common_c_member4c_member_id($c_member_id, true);
    $ktai_address = $c_member['secure']['ktai_address'];

    $p = array('kad' => t_encrypt($c_member['secure']['ktai_address']));
    $login_url = openpne_gen_url('ktai', 'page_o_login', $p);
    $params = array(
        'c_member'  => $c_member,
        'password'  => $new_password,
        'login_url' => $login_url,
    );
    return fetch_send_mail($ktai_address, 'm_ktai_password_query', $params);
}

//掲示板が更新されたときのお知らせメール送信(携帯メールアドレスへ)
function send_bbs_info_mail($c_commu_topic_comment_id, $c_member_id)
{
    $comment = _db_common_c_commu_topic_comment4c_commu_topic_comment_id($c_commu_topic_comment_id);
    $c_member = db_common_c_member4c_member_id_LIGHT($c_member_id);

    $c_commu_id       = $comment['c_commu_id'];
    $c_commu_topic_id = $comment['c_commu_topic_id'];
    $topic_name       = $comment['topic_name'];
    $commu_name       = $comment['commu_name'];
    $body             = $comment['body'];
    $image_filename1  = $comment['image_filename1'];
    $image_filename2  = $comment['image_filename2'];
    $image_filename3  = $comment['image_filename3'];
    $nickname = $c_member['nickname'];
    $p = array('target_c_commu_topic_id' => $c_commu_topic_id);
    $url              = openpne_gen_url('ktai', 'page_c_bbs', $p);
    $params = array(
        "topic_name"      => $topic_name,
        "commu_name"      => $commu_name,
        "nickname"        => $nickname,
        "url"        => $url,
        "body"            => $body,
        "image_filename1" => $image_filename1,
        "image_filename2" => $image_filename2,
        "image_filename3" => $image_filename3,
    );

    $tpl = fetch_mail_m_tpl("m_ktai_bbs_info", $params);
    if (!$tpl) {
        return false;
    }
    list($subject, $body) = $tpl;

    $lst  = db_common_receive_ktai_address_list4c_commu_id($c_commu_id);
    foreach ($lst as $target_c_member_id => $ktai_address) {
        if (MAIL_ADDRESS_HASHED) {
            $from = "t{$c_commu_topic_id}-".t_get_user_hash($target_c_member_id).'@'.MAIL_SERVER_DOMAIN;
        } else {
            $from = "t{$c_commu_topic_id}".'@'.MAIL_SERVER_DOMAIN;
        }
        //$from = urlencode(MAIL_ADDRESS_PREFIX . $from);
        $from = MAIL_ADDRESS_PREFIX . $from;
        t_send_email($ktai_address, $subject, $body, true, $from);
    }
}


//掲示板が更新されたときのお知らせメール送信(PCメールアドレスへ)
function send_bbs_info_mail_pc($c_commu_topic_comment_id, $c_member_id)
{
    $comment = _db_common_c_commu_topic_comment4c_commu_topic_comment_id($c_commu_topic_comment_id);
    $c_member = db_common_c_member4c_member_id_LIGHT($c_member_id);

    $c_commu_id       = $comment['c_commu_id'];
    $c_commu_topic_id = $comment['c_commu_topic_id'];
    $topic_name       = $comment['topic_name'];
    $commu_name       = $comment['commu_name'];
    $body             = $comment['body'];
    $nickname         = $c_member['nickname'];
    $p = array('target_c_commu_topic_id' => $c_commu_topic_id);
    $url              = openpne_gen_url('pc', 'page_c_topic_detail', $p);

    $image_filename1       = $comment['image_filename1'];
    $image_filename2       = $comment['image_filename2'];
    $image_filename3       = $comment['image_filename3'];

    $image = $image_filename1 || $image_filename2 || $image_filename3;
    $params = array(
        "topic_name" => $topic_name,
        "commu_name" => $commu_name,
        "nickname"   => $nickname,
        "url"        => $url,
        "body"       => $body,
        "image_filename1" => $image_filename1,
        "image_filename2" => $image_filename2,
        "image_filename3" => $image_filename3,
    );

    $tpl = fetch_mail_m_tpl("m_pc_bbs_info", $params);
    if (!$tpl) {
        return false;
    }
    list($subject, $body) = $tpl;

    $lst  = db_common_receive_pc_address_list4c_commu_id($c_commu_id);
    foreach ($lst as $pc_address) {
        t_send_email($pc_address, $subject, $body, true);
    }
}

//デイリーニュース
function do_common_send_daily_news()
{
    $list = do_common_c_member_list4daily_news();
    $send_2_flag = 0;
    $day_arr = array('日','月','火','水','木','金','土');
    $day = date('w');
    if (strstr(DAILY_NEWS_DAY, $day_arr[$day])) $send_2_flag = 1;

    foreach ($list as $key => $value) {
        if ($value['is_receive_daily_news'] == 1 ||
            ($value['is_receive_daily_news'] == 2 && $send_2_flag)) {

            $date = date("Y. n. j");
            $c_member_id = $value['c_member_id'];
            print "c_member_id=".$c_member_id."<br>\n";

            $c_member_secure = db_common_c_member_secure4c_member_id($c_member_id);
            $pc_address = $c_member_secure['pc_address'];

            $params = array(
                'c_member' => db_common_c_member4c_member_id($c_member_id),
                'date'     => $date,
                'ashiato_num' => p_h_ashiato_c_ashiato_num4c_member_id($c_member_id),
                'diary_friend_list' => p_h_home_c_diary_friend_list4c_member_id($c_member_id, 5),
                'c_commu_topic_comment_list'
                                    => p_h_home_c_commu_topic_comment_list4c_member_id($c_member_id, 5),
                'daily_news_head' => p_common_c_siteadmin4target_pagename('daily_news_head'),
                'daily_news_foot' => p_common_c_siteadmin4target_pagename('daily_news_foot'),
            );
            fetch_send_mail($pc_address, 'm_pc_daily_news', $params);
        }
    }
}

//誕生日メール
function do_common_send_birthday_mail()
{
    $birth_list = do_common_c_member_list4birthday_mail();

    foreach ($birth_list as $birth_member) {
        $friend_list = do_common_c_friend_list4c_member_id($birth_member['c_member_id']);

        foreach ($friend_list as $friend) {
            if ($friend['is_receive_mail']) {

                $c_member_secure = db_common_c_member_secure4c_member_id($friend['c_member_id']);
                $pc_address = $c_member_secure['pc_address'];

                $params = array(
                    "birth_member" => $birth_member,
                    "friend" => $friend,
                );
                fetch_send_mail($pc_address, 'm_pc_birthday_mail', $params);
            }
        }
    }
}

//スケジュールメール
function do_common_send_schedule_mail()
{
    $c_schedule_list = db_schedule_c_member_list4mail();

    $send_list = array();
    foreach ($c_schedule_list as $value) {
        $c_member_id = $value['c_member_id'];
        $send_list[$c_member_id][] = $value;
    }

    foreach ($send_list as $key => $value) {
        $c_member_secure = db_common_c_member_secure4c_member_id($key);
        $pc_address = $c_member_secure['pc_address'];

        $params = array(
            "c_member" => db_common_c_member4c_member_id_LIGHT($key),
            "c_schedule_list" => $value,
        );
        fetch_send_mail($pc_address, 'm_pc_schedule_mail', $params);
    }
}

//◆紹介文が編集されました！メール
function do_f_intro_edit_update_c_friend_send_mail($c_member_id, $target_c_member_id)
{
    $c_member_to = db_common_c_member4c_member_id($target_c_member_id, true);
    $pc_address = $c_member_to['secure']['pc_address'];
    $is_receive_mail = $c_member_to['is_receive_mail'];

    $params = array(
        "c_member_to"   => db_common_c_member4c_member_id_LIGHT($target_c_member_id),
        "c_member_from" => db_common_c_member4c_member_id_LIGHT($c_member_id),
    );
    return fetch_send_mail($pc_address, 'm_pc_friend_intro', $params, $is_receive_mail);
}

//コミュニティに参加したときのメール
function do_inc_join_c_commu_send_mail($c_commu_id, $c_member_id_join)
{
    $c_commu = _db_c_commu4c_commu_id($c_commu_id);
    $c_member_admin = db_common_c_member4c_member_id($c_commu['c_member_id_admin'], true);

    $pc_address = $c_member_admin['secure']['pc_address'];
    $is_receive_mail = ($c_member_admin['is_receive_mail'] && $c_commu['is_send_join_mail']);

    $params = array(
        'c_commu' => $c_commu,
        'c_member_admin' => db_common_c_member4c_member_id_LIGHT($c_commu['c_member_id_admin']),
        'c_member_join'  => db_common_c_member4c_member_id_LIGHT($c_member_id_join),
    );
    return fetch_send_mail($pc_address, 'm_pc_join_commu', $params, $is_receive_mail);
}

//◆友達リンク承認完了メール
function do_h_confirm_list_insert_c_friend_mail_send($c_member_id_from, $u)
{
    $c_member_from = db_common_c_member4c_member_id($c_member_id_from, true);
    $pc_address = $c_member_from['secure']['pc_address'];
    $is_receive_mail = $c_member_from['is_receive_mail'];

    $params = array(
        "c_member_to"   => db_common_c_member4c_member_id($c_member_id_from),
        "c_member_from" => db_common_c_member4c_member_id($u),
    );
    return fetch_send_mail($pc_address, 'm_pc_syounin_friend', $params, $is_receive_mail);
}

//メールアドレス変更メール
function do_h_config_1_mail_send($target_c_member_id, $session, $pc_address)
{
    $params = array(
        "c_member" => db_common_c_member4c_member_id($target_c_member_id),
        "sid"      => $session,
    );
    return fetch_send_mail($pc_address, 'm_pc_change_mail', $params);
}

//あしあとお知らせメール
function do_common_send_ashiato_mail($c_member_to, $c_member_from)
{
    $c_member_to = db_common_c_member4c_member_id($c_member_to, true);
    $c_member_from = db_common_c_member4c_member_id($c_member_from);

    $pc_address = $c_member_to['secure']['pc_address'];
    $ktai_address = $c_member_to['secure']['ktai_address'];

    $params = array(
        'c_member_to'   => $c_member_to,
        'c_member_from' => $c_member_from,
    );

    //pc
    fetch_send_mail($pc_address, 'm_pc_ashiato', $params);

    //ktai
    $p = array('kad' => t_encrypt($c_member_to['secure']['ktai_address']));
    $params['login_url'] = openpne_gen_url('ktai', 'page_o_login', $p);
    fetch_send_mail($ktai_address, 'm_ktai_ashiato', $params);
}

//日記にコメントが追加されたときのお知らせメール送信(携帯メールアドレスへ)
//@param 日記のID
//@param コメント登録者のID
//@param コメントの内容
function send_diary_comment_info_mail($c_diary_id, $c_member_id,$body)
{

    //コメント更新者の情報を取得
    $c_member = db_common_c_member4c_member_id_LIGHT($c_member_id);
    //日記コメントの日記IDからもとの日記の情報を取得
    $diary = db_diary_get_c_diary4id($c_diary_id);
    //日記の持主のIDから持主の情報を取得する

    $target_member = db_common_c_member4c_member_id($diary['c_member_id']);
    //$ktai_address = db_common_c_member_secure4c_member_id($target_member['c_member_id']);
    //コメント登録者が日記の持主かどうかを判定
    if ($c_member_id == $target_member['c_member_id']) {

        return false;
    }
    if ($target_member['is_diary_comment_mail'] == 0) {

        return false;
    }

    //コメント登録者と日記の持主が違う場合
    //日記の情報

    $target_c_member_id = $target_member['c_member_id'];    //メールを送る人のID,つまり日記の本人
    $diary_subject       = $diary['subject'];           //本の日記の題名
    $nickname = $c_member['nickname'];              //コメント登録者のニックネーム
    $sec = db_common_c_member_secure4c_member_id($target_c_member_id);
    //echo($sec['ktai_address']);
    //exit();
    $ktai_address = $sec['ktai_address'];
    if (!$ktai_address) {
        return false;
    }

    //2008-08-07 KUNIHARU Tsujioka
    //c_diary_idから日記用のURLを生成しパラメータにセット
    $url    = OPENPNE_URL . '?m=ktai&a=page_fh_diary&target_c_diary_id='.$c_diary_id;
    $params = array(
        "diary_subject" => $diary_subject.'へのコメント',
        "nickname"   => $nickname,
        "body"       => $body,
        "url_param"  => $url,
    );

    //日記コメント用テンプレートファイルをフェッチ
    //m_ktai_diary_comment_infoを新たに作成する


    //ここからメールを送信します。
    //送信者は一人だけなので、foreachは外す
    //$lst  = db_common_receive_ktai_address_list4c_commu_id($c_commu_id);
    //foreach($lst as $target_c_member_id => $ktai_address) {
        if (MAIL_ADDRESS_HASHED) {
            $from = "c{$c_diary_id}-".t_get_user_hash($target_c_member_id)."@".MAIL_SERVER_DOMAIN;
        } else {
            $from = "c{$c_diary_id}-".'@'.MAIL_SERVER_DOMAIN;
        }
        //$from = urlencode(MAIL_ADDRESS_PREFIX . $from);
        $from = MAIL_ADDRESS_PREFIX . $from;
    if (strpos($ktai_address,'docomo.ne.jp') !== false ){
        $tpl = fetch_mail_m_tpl("m_ktai_diary_comment_info", $params);
        if (!$tpl) {
            return false;
        }
        list($subject, $body) = $tpl;
        //echo($body);
        //exit();
    }
    elseif (strpos($ktai_address,'ezweb.ne.jp') !== false) {
        $tpl = fetch_mail_m_tpl("m_ktai_diary_comment_info", $params);
        if (!$tpl) {
            return false;
        }
        list($subject, $body) = $tpl;
    }
    elseif (strpos($ktai_address,'vodafone.ne.jp') !== false) {
        $tpl = fetch_mail_m_tpl("m_ktai_diary_comment_info", $params);
        if (!$tpl) {
            return false;
        }
        list($subject, $body) = $tpl;
    }
    elseif (strpos($ktai_address,'softbank.ne.jp') !== false) {
        $tpl = fetch_mail_m_tpl("m_ktai_diary_comment_info", $params);
        if (!$tpl) {
            return false;
        }
        list($subject, $body) = $tpl;
    }
    //2008-08-07 ソフトバンクのiPhoneの場合を追加
    elseif (strpos($ktai_address,'i.softbank.ne.jp') !== false) {
        $tpl = fetch_mail_m_tpl("m_ktai_diary_comment_info", $params);
        if (!$tpl) {
            return false;
        }
        list($subject, $body) = $tpl;
    }
    elseif (strpos($ktai_address,'disney.ne.jp') !== false) {
        $tpl = fetch_mail_m_tpl("m_ktai_diary_comment_info", $params);
        if (!$tpl) {
            return false;
        }
        list($subject, $body) = $tpl;
    }
    elseif (strpos($ktai_address,'emobile.ne.jp') !== false) {
        $tpl = fetch_mail_m_tpl("m_ktai_diary_comment_info", $params);
        if (!$tpl) {
            return false;
        }
        list($subject, $body) = $tpl;
    }

    t_send_email($ktai_address, $subject, $body, true, $from);
    //}
}

//◆メッセージ受信メール
function do_common_send_message_mail_send($c_member_id_to, $c_member_id_from)
{
    $c_member_to = db_common_c_member4c_member_id($c_member_id_to, true);
    $pc_address = $c_member_to['secure']['pc_address'];
    $is_receive_mail = $c_member_to['is_receive_mail'];

    $params = array(
        "c_member_to"   => db_common_c_member4c_member_id($c_member_id_to),
        "c_member_from" => db_common_c_member4c_member_id($c_member_id_from),
    );
    return fetch_send_mail($pc_address, 'm_pc_message_zyushin', $params, $is_receive_mail);
}

//◆承認依頼メッセージ受信メール
function do_common_send_message_syoudaku_mail_send($c_member_id_to, $c_member_id_from)
{
    $c_member_to = db_common_c_member4c_member_id($c_member_id_to, true);
    $pc_address = $c_member_to['secure']['pc_address'];
    $is_receive_mail = $c_member_to['is_receive_mail'];

    $params = array(
        "c_member_to"   => db_common_c_member4c_member_id($c_member_id_to),
        "c_member_from" => db_common_c_member4c_member_id($c_member_id_from),
    );
    return fetch_send_mail($pc_address, 'm_pc_message_syounin', $params, $is_receive_mail);
}

// ログインアドレス通知メール
//2007-10-09 Katsunori Matsuda さんのカスタマイズをマージ Kunitsuji
//author Katsunori Matsuda
function do_insert_c_member_mail_send($c_member_id, $password, $ktai_address)
{
    $c_member_secure = db_common_c_member_secure4c_member_id($c_member_id);
    $p = array('kad' => t_encrypt($c_member_secure['ktai_address']));
    $params['url'] = openpne_gen_url('ktai', 'page_o_login', $p);
    if (ADMIN_INVITE_MAIL === false) {
        return fetch_send_mail($ktai_address, 'm_ktai_login_regist_end', $params);
    } else {
        fetch_send_mail($ktai_address, 'm_ktai_login_regist_end', $params);
        //**********ここから追記***********//
        // 管理者に新規登録者を通知
        $c_member = db_common_c_member4c_member_id($c_member_id, true, true);
        $params = array(
                    "c_member"       => $c_member,
                    "c_member_email" => $c_member['secure']['ktai_address'],
                    "entry_date"     => db_now(),
                    );
        return fetch_send_mail(ADMIN_EMAIL, 'm_admin_invite_end', $params);
    }
}

//招待されたときのメール(ktai)
function h_invite_insert_c_invite_mail_send($session, $c_member_id_invite, $mail, $message)
{
    $params['SNS_NAME'] = SNS_NAME;
    $p = array('ses' => $session);
    $params['url'] = openpne_gen_url('ktai', 'page_o_regist_pre', $p);
    $params['c_member'] = db_common_c_member4c_member_id($c_member_id_invite);
    $params['message'] = $message;
    return fetch_send_mail($mail, 'm_ktai_regist_invite', $params);
}

//メールアドレスの変更および
//PCで今まで使っていたメンバーが新たに携帯アドレスを登録したときに送られるメール
function do_mail_sns_change_ktai_mail_send($c_member_id, $session, $ktai_address)
{
    $params['SNS_NAME'] = SNS_NAME;
    $p = array('id' => $c_member_id, 'ses' => $session);
    $params['url'] = openpne_gen_url('ktai', 'page_o_login2', $p);
    return fetch_send_mail($ktai_address, 'm_ktai_change_ktai', $params);
}

//ログインアドレス通知メール
function do_mail_sns_login_get_mail_send($c_member_id, $sender)
{
    $c_member_secure = db_common_c_member_secure4c_member_id($c_member_id);
    $p = array('kad' => t_encrypt($c_member_secure['ktai_address']));
    $params['url'] = openpne_gen_url('ktai', 'page_o_login', $p);
    return fetch_send_mail($sender, 'm_ktai_login_get', $params);
}

// コミュニティ紹介
function do_common_send_message_syoukai_commu_mail_send($c_member_id_to, $c_member_id_from)
{
    //メール
    $c_member_to = db_common_c_member4c_member_id($c_member_id_to, true);
    $pc_address = $c_member_to['secure']['pc_address'];
    $is_receive_mail = $c_member_to['is_receive_mail'];

    $params = array(
        "c_member_to"   =>db_common_c_member4c_member_id($c_member_id_to),
        "c_member_from" =>db_common_c_member4c_member_id($c_member_id_from),
    );
    return fetch_send_mail($pc_address, 'm_pc_message_syoukai_commu', $params, $is_receive_mail);
}

// コミュニティ参加者へのメッセージ
function do_common_send_message_sankasya_commu_mail_send($c_member_id_to, $c_member_id_from)
{
    //メール
    $c_member_to = db_common_c_member4c_member_id($c_member_id_to, true);
    $pc_address = $c_member_to['secure']['pc_address'];
    $is_receive_mail = $c_member_to['is_receive_mail'];

    $params = array(
        "c_member_to"   =>db_common_c_member4c_member_id($c_member_id_to),
        "c_member_from" =>db_common_c_member4c_member_id($c_member_id_from),
    );
    return fetch_send_mail($pc_address, 'm_pc_message_sankasya_commu', $params, $is_receive_mail);
}

// メンバ紹介
function do_common_send_message_syoukai_member_mail_send($c_member_id_to, $c_member_id_from)
{
    //メール
    $c_member_to = db_common_c_member4c_member_id($c_member_id_to, true);
    $pc_address = $c_member_to['secure']['pc_address'];
    $is_receive_mail = $c_member_to['is_receive_mail'];

    $params = array(
        "c_member_to"   => db_common_c_member4c_member_id($c_member_id_to),
        "c_member_from" => db_common_c_member4c_member_id($c_member_id_from),
    );
    return fetch_send_mail($pc_address, 'm_pc_message_syoukai_member', $params, $is_receive_mail);
}

// イベント紹介
function do_common_send_message_event_invite_mail_send($c_member_id_to, $c_member_id_from)
{
    //メール
    $c_member_to = db_common_c_member4c_member_id($c_member_id_to, true);
    $pc_address = $c_member_to['secure']['pc_address'];
    $is_receive_mail = $c_member_to['is_receive_mail'];

    $params = array(
        "c_member_to"   => db_common_c_member4c_member_id($c_member_id_to),
        "c_member_from" => db_common_c_member4c_member_id($c_member_id_from),
    );
    return fetch_send_mail($pc_address, 'm_pc_message_event_invite', $params, $is_receive_mail);
}

//イベントメッセージ
function do_common_send_message_event_message_mail_send($c_member_id_to, $c_member_id_from)
{
    //メール
    $c_member_to = db_common_c_member4c_member_id($c_member_id_to, true);
    $pc_address = $c_member_to['secure']['pc_address'];
    $is_receive_mail = $c_member_to['is_receive_mail'];

    $params = array(
        "c_member_to"   => db_common_c_member4c_member_id($c_member_id_to),
        "c_member_from" => db_common_c_member4c_member_id($c_member_id_from),
    );
    return fetch_send_mail($pc_address, 'm_pc_message_event_message', $params, $is_receive_mail);
}

function do_common_send_mail_regist_get($session, $sender)
{
    // メール送信
    $p = array('ses' => $session);
    $params['url'] = openpne_gen_url('ktai', 'page_o_regist_pre', $p);
    return fetch_send_mail($sender, 'm_ktai_regist_get', $params);
}

/**
 * モバイルアドレス登録用の自動返信を送信
 *
 */
function do_common_send_mail_mobile_entry($sender)
{
    //FROMメールアドレスをハッシュ化してURLに埋め込む
    $kad = t_encrypt($sender);
    $param = array('kad'=>$kad);
    // メール送信
    $params['url'] = openpne_gen_url('ktai', 'page_o_regist_mobileaddress', $param);
    return fetch_send_mail($sender, 'm_ktai_address', $params);
}

//退会完了メール(PC)
function do_common_send_mail_taikai_end_pc($c_member_id)
{
    $c_member = db_common_c_member4c_member_id($c_member_id, true);
    $pc_address = $c_member['secure']['pc_address'];
    $params = array(
        "c_member" => $c_member,
    );
    return fetch_send_mail($pc_address, 'm_pc_taikai_end', $params);
}

//退会完了メール(携帯)
function do_common_send_mail_taikai_end_ktai($c_member_id)
{
    $c_member = db_common_c_member4c_member_id($c_member_id, true);
    $ktai_address = $c_member['secure']['ktai_address'];
    $params = array(
        "c_member" => $c_member,
    );
    return fetch_send_mail($ktai_address, 'm_ktai_taikai_end', $params);
}

//◆メッセージ受信メール(携帯)
function do_common_send_message_mail_send_ktai($c_member_id_to, $c_member_id_from, $subject = null, $body = null, $is_image_exist = false)
{
    $c_member_to = db_common_c_member4c_member_id($c_member_id_to, true);
    $ktai_address = $c_member_to['secure']['ktai_address'];
    $is_receive_ktai_mail = $c_member_to['is_receive_ktai_mail'];
    $p = array('kad' => t_encrypt($c_member_to['secure']['ktai_address']));
    $login_url = openpne_gen_url('ktai', 'page_o_login', $p);
    //$contents_receive_flag = MEMBER_getMemberConfig($c_member_id_to, 'message_contents_receive_flag');
    if (! defined('MESSAGE_BODY_RECIVE'))
    {
        define('MESSAGE_BODY_RECIVE', FALSE);
    }
    $contents_receive_flag = MESSAGE_BODY_RECIVE;

    $params = array(
        'c_member_to'   => db_common_c_member4c_member_id($c_member_id_to),
        'c_member_from' => db_common_c_member4c_member_id($c_member_id_from),
        'login_url' => $login_url,
        'contents_receive_flag' => $contents_receive_flag,
        'subject' => $subject,
        'body' => $body,
        'is_image_exist' => $is_image_exist
        );
    return fetch_send_mail($ktai_address, 'm_ktai_message_zyushin', $params, $is_receive_ktai_mail);
}

//◆承認依頼メッセージ受信メール(携帯)
function do_common_send_message_syoudaku_mail_send_ktai($c_member_id_to, $c_member_id_from)
{
    $c_member_to = db_common_c_member4c_member_id($c_member_id_to, true);
    $ktai_address = $c_member_to['secure']['ktai_address'];
    $is_receive_ktai_mail = $c_member_to['is_receive_ktai_mail'];
    $p = array('kad' => t_encrypt($c_member_to['secure']['ktai_address']));
    $login_url = openpne_gen_url('ktai', 'page_o_login', $p);

    $params = array(
        'c_member_to'   => db_common_c_member4c_member_id($c_member_id_to),
        'c_member_from' => db_common_c_member4c_member_id($c_member_id_from),
        'login_url' => $login_url,
    );
    return fetch_send_mail($ktai_address, 'm_ktai_message_zyushin', $params, $is_receive_ktai_mail);
}

// コミュニティ紹介(携帯)
function do_common_send_message_syoukai_commu_mail_send_ktai($c_member_id_to, $c_member_id_from)
{
    $c_member_to = db_common_c_member4c_member_id($c_member_id_to, true);
    $ktai_address = $c_member_to['secure']['ktai_address'];
    $is_receive_ktai_mail = $c_member_to['is_receive_ktai_mail'];
    $p = array('kad' => t_encrypt($c_member_to['secure']['ktai_address']));
    $login_url = openpne_gen_url('ktai', 'page_o_login', $p);

    $params = array(
        'c_member_to'   => db_common_c_member4c_member_id($c_member_id_to),
        'c_member_from' => db_common_c_member4c_member_id($c_member_id_from),
        'login_url' => $login_url,
    );
    return fetch_send_mail($ktai_address, 'm_ktai_message_zyushin', $params, $is_receive_ktai_mail);
}

//コミュニティ参加者へのメッセージ(携帯)
function do_common_send_message_sankasya_commu_mail_send_ktai($c_member_id_to, $c_member_id_from)
{
    $c_member_to = db_common_c_member4c_member_id($c_member_id_to, true);
    $ktai_address = $c_member_to['secure']['ktai_address'];
    $is_receive_ktai_mail = $c_member_to['is_receive_ktai_mail'];
    $p = array('kad' => t_encrypt($c_member_to['secure']['ktai_address']));
    $login_url = openpne_gen_url('ktai', 'page_o_login', $p);

    $params = array(
        'c_member_to'   => db_common_c_member4c_member_id($c_member_id_to),
        'c_member_from' => db_common_c_member4c_member_id($c_member_id_from),
        'login_url' => $login_url,
    );
    return fetch_send_mail($ktai_address, 'm_ktai_message_zyushin', $params, $is_receive_ktai_mail);
}

// メンバ紹介(携帯)
function do_common_send_message_syoukai_member_mail_send_ktai($c_member_id_to, $c_member_id_from)
{
    $c_member_to = db_common_c_member4c_member_id($c_member_id_to, true);
    $ktai_address = $c_member_to['secure']['ktai_address'];
    $is_receive_ktai_mail = $c_member_to['is_receive_ktai_mail'];
    $p = array('kad' => t_encrypt($c_member_to['secure']['ktai_address']));
    $login_url = openpne_gen_url('ktai', 'page_o_login', $p);

    $params = array(
        'c_member_to'   => db_common_c_member4c_member_id($c_member_id_to),
        'c_member_from' => db_common_c_member4c_member_id($c_member_id_from),
        'login_url' => $login_url,
    );
    return fetch_send_mail($ktai_address, 'm_ktai_message_zyushin', $params, $is_receive_ktai_mail);
}
// イベント紹介(携帯)
function do_common_send_message_event_invite_mail_send_ktai($c_member_id_to, $c_member_id_from)
{
    $c_member_to = db_common_c_member4c_member_id($c_member_id_to, true);
    $ktai_address = $c_member_to['secure']['ktai_address'];
    $is_receive_ktai_mail = $c_member_to['is_receive_ktai_mail'];
    $p = array('kad' => t_encrypt($c_member_to['secure']['ktai_address']));
    $login_url = openpne_gen_url('ktai', 'page_o_login', $p);

    $params = array(
        'c_member_to'   => db_common_c_member4c_member_id($c_member_id_to),
        'c_member_from' => db_common_c_member4c_member_id($c_member_id_from),
        'login_url' => $login_url,
    );
    return fetch_send_mail($ktai_address, 'm_ktai_message_zyushin', $params, $is_receive_ktai_mail);
}

//イベントメッセージ(携帯)
function do_common_send_message_event_message_mail_send_ktai($c_member_id_to, $c_member_id_from)
{
    $c_member_to = db_common_c_member4c_member_id($c_member_id_to, true);
    $ktai_address = $c_member_to['secure']['ktai_address'];
    $is_receive_ktai_mail = $c_member_to['is_receive_ktai_mail'];
    $p = array('kad' => t_encrypt($c_member_to['secure']['ktai_address']));
    $login_url = openpne_gen_url('ktai', 'page_o_login', $p);

    $params = array(
        'c_member_to'   => db_common_c_member4c_member_id($c_member_id_to),
        'c_member_from' => db_common_c_member4c_member_id($c_member_id_from),
        'login_url' => $login_url,
    );
    return fetch_send_mail($ktai_address, 'm_ktai_message_zyushin', $params, $is_receive_ktai_mail);
}

function put_mail_queue($address, $subject, $body, $is_receive_mail=true, $from=ADMIN_EMAIL)
{
    if (!$is_receive_mail || !db_common_is_mailaddress($address)) {
        return false;
    }

    // 改行コード
    $cr = "\x0D";
    $lf = "\x0A";
    $crlf = "\x0D\x0A";

    // header
    $headers['MIME-Version'] = "1.0";
    $headers['Content-Type'] = "text/plain; charset=iso-2022-jp";
    $headers['From'] = $from;
    $headers['To'] = $address;

    // 半角カナを全角カナに変換
    if (MAIL_HAN2ZEN) {
        $subject = mb_convert_kana($subject, "KV");
        $body = mb_convert_kana($body, "KV");
    }

    // subject (改行コードを含んではならない)
    $subject = str_replace(array($cr, $lf), "", $subject);
    $subject = mb_convert_encoding($subject, "JIS");
    $headers['Subject'] = '=?ISO-2022-JP?B?'.base64_encode($subject).'?=';

    // body (LF)
    if (MAIL_WRAP_WIDTH) {
        $body = t_wordwrap($body, MAIL_WRAP_WIDTH);
    }

    $body = mb_convert_encoding($body, "JIS");
    $body = str_replace($cr, $lf, str_replace($crlf, $lf, $body));

    include_once 'Mail/Queue.php';

    $db_opt = array(
        "type" => "db",
        "dsn" => $GLOBALS['_OPENPNE_DSN_LIST']['main']['dsn'],
        "mail_table" => "mail_queue",
    );
    $mail_opt = array(
        "driver"=>"mail",
    );
    $mail_mime = new Mail_mime();
    $mail_mime->setTXTBody($body);
    $body = $mail_mime->get(array("text_charset"=>"ISO-2022-JP"));
    $body = addslashes($body);
    $headers = $mail_mime->headers($headers);

    if (!ini_get('safe_mode')) {
        if (MAIL_ENVFROM) {
            $f = MAIL_ENVFROM;
        } else {
            $f = ADMIN_EMAIL;
        }
        $params = '-f' . escapeshellcmd($f);
        $mail_opt['param']= $params;
        $mail_queue  = new Mail_Queue($db_opt, $mail_opt);
        return $mail_queue->put($from, $address, $headers, $body);
    } else {
        $mail_queue  = new Mail_Queue($db_opt, $mail_opt);
        return $mail_queue->put($from, $address, $headers, $body);
    }
}

//ヘルプメール
function do_common_send_ktai_help_mail($c_member,$page)
{
    $c_member = db_common_c_member4c_member_id($c_member, true);

    $ktai_address = $c_member['secure']['ktai_address'];

    $kad = t_encrypt($c_member['secure']['ktai_address']);
    if( !$kad ) {
        return false;
    }
    $p = array('kad' => $kad);
    $login_url = openpne_gen_url('ktai', 'page_o_login', $p);
    $inc_ktai_help = strip_tags(fetch_inc_ktai_help($page));
    $params = array(
        'login_url'   => $login_url,
        'inc_ktai_help' => $inc_ktai_help
    );

    fetch_send_mail($ktai_address, 'm_ktai_help', $params);
    return true;
}

?>
