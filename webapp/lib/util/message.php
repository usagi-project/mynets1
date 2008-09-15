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
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @version    MyNETS,v 1.0.0
 * @since      File available since Release 1.0.0 Nighty
 * @chengelog  [2007/02/17] Ver1.1.0Nighty package
 * ======================================================================== 
 */

/**
 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 */

function create_message_friend_invite($u, $body, $target_c_member_id)
{
    $msg_subject = 'メンバー紹介メッセージ';

    $c_member = db_common_c_member4c_member_id_LIGHT($u);
    $p = array('target_c_member_id' => $target_c_member_id);
    $url = openpne_gen_url('pc', 'page_f_home', $p);
    $msg_body = <<<EOD
{$c_member['nickname']}さんからメンバー紹介メッセージが届いています。

メッセージ：
$body

このメンバーのURL：
$url
EOD;
    return array($msg_subject, $msg_body);
}

function create_message_commu_invite($u, $body, $c_commu_id)
{
    $msg_subject = 'コミュニティ紹介メッセージ';

    $c_member = db_common_c_member4c_member_id_LIGHT($u);
    $c_commu = _db_c_commu4c_commu_id($c_commu_id);
    $p = array('target_c_commu_id' => $c_commu_id);
    $url = openpne_gen_url('pc', 'page_c_home', $p);
    $msg_body = <<<EOD
{$c_member['nickname']}さんからコミュニティ紹介メッセージが届いています。

コミュニティ名：
{$c_commu['name']}

メッセージ：
$body

このコミュニティのURL
$url
EOD;
    return array($msg_subject, $msg_body);
}

function create_message_event_invite($u, $body, $c_commu_topic_id)
{
    $msg_subject = 'イベント紹介メッセージ';

    $c_member = db_common_c_member4c_member_id_LIGHT($u);
    $c_commu_topic = _do_c_bbs_c_commu_topic4c_commu_topic_id($c_commu_topic_id);
    $p = array('target_c_commu_topic_id' => $c_commu_topic_id);
    $url = openpne_gen_url('pc', 'page_c_event_detail', $p);
    $msg_body = <<<EOD
{$c_member['nickname']}さんからイベント紹介メッセージが届いています。

イベント名：
{$c_commu_topic['name']}

メッセージ：
$body

このイベントのURL
$url
EOD;
    return array($msg_subject, $msg_body);
}

function create_message_event_message($u, $body, $c_commu_topic_id)
{
    $msg_subject = 'イベントのお知らせ';

    $c_member = db_common_c_member4c_member_id_LIGHT($u);

    $p = array('target_c_commu_topic_id' => $c_commu_topic_id);
    $url = openpne_gen_url('pc', 'page_c_event_detail', $p);
    $msg_body = <<<EOD
イベントの企画者{$c_member['nickname']}さんからイベントに関してのお知らせが届いています。

メッセージ：
$body

このイベントのURL
$url
EOD;
    return array($msg_subject, $msg_body);
}

?>
