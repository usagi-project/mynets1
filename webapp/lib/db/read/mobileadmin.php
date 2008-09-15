<?php

/* ========================================================================
 *
 * @license This source file is subject to version 3.01 of the PHP license,
 *
 * @project    OpenPNE UsagiProject 2006-2007
 * @package    MyNETS
 * @author     Kunitsuji UsagiProject <info@usagi.mynets.jp>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @version    MyNETS,v 1.1.0
 * @chengelog  [2007/06/19] Ver1.1.0Nighty package
 * ========================================================================
 */


//携帯での管理システムへの接続用関数群

/**
 * 管理ユーザーかどうかを判定
 *
 * @param c_member_id
 * @return true or false
 */
if (! function_exists('checkAuthMobileAdmin'))
{
    function checkAuthMobileAdmin($c_member_id)
    {
        //c_member_idから携帯のアドレスを取得する
        $member_secure = db_common_c_member_secure4c_member_id($c_member_id);
        $mobile_address = $member_secure['ktai_address'];
        if (!$mobile_address) {
            return false;
        }
        //この携帯アドレスが、管理ユーザーとして登録されているかどうかを判定
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_admin_user ' .
                ' where username = ? ';
        $params = array($mobile_address);
        $result = db_get_row($sql, $params);
        if (!$result) {
            return false;
        } else {
            return true;
        }
    }
}

/**
 * パスワードのチェック
 * @param c_member_id,password
 *
 * @return true or false
 */
if (! function_exists('checkAuthMobileAdminLogin'))
{
    function checkAuthMobileAdminLogin($username, $pass)
    {
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_admin_user ' .
                ' where username = ? and password = ?';
        $params = array(intval($username), md5($pass));
        $result = db_get_row($sql,$params);
        if (!$result) {
            return false;
        } else {
            return true;
        }
    }
}

/*
 *登録者数の計算
 *本日の人数、昨日の人数、累計を表示
 *$wherecondがなければ累計あとは、呼び出し側でSQLで条件をしていする
 */
if (! function_exists('getMobileAdminRegistData'))
{
    function getMobileAdminRegistData($wherecond = "")
    {

        $sql = "select count(*) from ". MYNETS_PREFIX_NAME ."c_member ";
        if ($wherecond !== "") {
            $sql = $sql.$wherecond;
        }
        $result = db_get_one($sql);
        return $result ;
    }
}
/*
 *退会者数の計算
 *本日の人数、昨日の人数、累計を表示
 *$wherecondがなければ累計あとは、呼び出し側でSQLで条件をしていする
 */
if (! function_exists('getMobileAdminDeleteData'))
{
    function getMobileAdminDeleteData($wherecond = "")
    {

        $sql = "select count(*) from ". MYNETS_PREFIX_NAME ."c_delete_member_data ";
        if ($wherecond !== "") {
            $sql = $sql.$wherecond;
        }
        $result = db_get_one($sql);
        return $result ;
    }
}
/*
 *日記投稿の計算
 *本日の投稿数、昨日の投稿数、累計を表示
 *$wherecondがなければ累計あとは、呼び出し側でSQLで条件をしていする
 */
if (! function_exists('getMobileAdminDiaryData'))
{
    function getMobileAdminDiaryData($wherecond = "")
    {

        $sql = "select count(*) from ". MYNETS_PREFIX_NAME ."c_diary ";
        if ($wherecond !== "") {
            $sql = $sql.$wherecond;
        }
        $result = db_get_one($sql);
        return $result ;
    }
}
/*
 *日記コメント投稿の計算
 *本日の投稿数、昨日の投稿数、累計を表示
 *$wherecondがなければ累計あとは、呼び出し側でSQLで条件をしていする
 */
if (! function_exists('getMobileAdminDiaryCommentData'))
{
    function getMobileAdminDiaryCommentData($wherecond = "")
    {

        $sql = "select count(*) from ". MYNETS_PREFIX_NAME ."c_diary_comment ";
        if ($wherecond !== "") {
            $sql = $sql.$wherecond;
        }
        $result = db_get_one($sql);
        return $result ;
    }
}
/*
 *トピック投稿の計算
 *本日の投稿数、昨日の投稿数、累計を表示
 *$wherecondがなければ累計あとは、呼び出し側でSQLで条件をしていする
 */
if (! function_exists('getMobileAdminTopicData'))
{
    function getMobileAdminTopicData($wherecond = "")
    {

        $sql = "select count(*) from ". MYNETS_PREFIX_NAME ."c_commu_topic ";
        if ($wherecond !== "") {
            $sql = $sql.$wherecond." and event_flag = 0";
        } else {
            $sql = $sql." where event_flag = 0";
        }
        $result = db_get_one($sql);
        return $result ;
    }
}

if (! function_exists('getMobileAdminEventData'))
{
    function getMobileAdminEventData($wherecond = "")
    {

        $sql = "select count(*) from ". MYNETS_PREFIX_NAME ."c_commu_topic ";
        if ($wherecond !== "") {
            $sql = $sql.$wherecond." and event_flag = 1";
        } else {
            $sql = $sql." where event_flag = 1";
        }
        $result = db_get_one($sql);
        return $result ;
    }
}
/*
 *アクセスの計算
 *本日の数、昨日の数、累計を表示
 *$wherecondがなければ累計あとは、呼び出し側でSQLで条件をしていする
 */
if (! function_exists('getMobileAdminAccessData'))
{
    function getMobileAdminAccessData($wherecond = "")
    {

        $sql = "select * from ". MYNETS_PREFIX_NAME ."c_access_log ";
        $sql = $sql.$wherecond." group by c_member_id ";
        $result = db_get_all($sql);
        $num = count($result);
        return $num ;
    }
}
?>
