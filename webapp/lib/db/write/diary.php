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

//--- diary

/**
 * 日記を追加
 */
if (! function_exists('db_diary_insert_c_diary'))
{
    function db_diary_insert_c_diary($c_member_id, $subject, $body, $public_flag)
    {
        $data = array(
            'c_member_id' => intval($c_member_id),
            'subject' => $subject,
            'body' => $body,
            'public_flag' => $public_flag,
            'r_datetime' => db_now(),
            'r_date' => db_now(),
            'is_checked' => 1,
            'e_datetime' => db_now(),
        );
        return db_insert(MYNETS_PREFIX_NAME . 'c_diary', $data);
    }
}

/**
 * 日記を編集
 */
if (! function_exists('db_diary_update_c_diary'))
{
    function db_diary_update_c_diary($c_diary_id, $subject, $body, $public_flag,
        $image_filename_1 = '', $image_filename_2 = '', $image_filename_3 = '')
    {
        $data = array(
            'subject' => $subject,
            'body' => $body,
            'public_flag' => $public_flag,
        );
        if ($image_filename_1) $data['image_filename_1'] = $image_filename_1;
        if ($image_filename_2) $data['image_filename_2'] = $image_filename_2;
        if ($image_filename_3) $data['image_filename_3'] = $image_filename_3;

        $where = array(
            'c_diary_id' => intval($c_diary_id),
        );
        return db_update(MYNETS_PREFIX_NAME . 'c_diary', $data, $where);
    }
}

/**
 * 日記削除
 * コメント、画像も削除
 *
 * @param int $c_diary_id
 */
if (! function_exists('db_diary_delete_c_diary'))
{
    function db_diary_delete_c_diary($c_diary_id)
    {
        // 画像
        $c_diary = db_diary_get_c_diary4id($c_diary_id);
        image_data_delete($c_diary['image_filename_1']);
        image_data_delete($c_diary['image_filename_2']);
        image_data_delete($c_diary['image_filename_3']);

        // コメント
        $sql = 'SELECT image_filename_1, image_filename_2, image_filename_3 FROM '
                     . MYNETS_PREFIX_NAME . 'c_diary_comment WHERE c_diary_id =?';
        $params = array(intval($c_diary_id));
        $comment_images = db_get_all($sql, $params);

        foreach ($comment_images as $value) {
            image_data_delete($value['image_filename_1']);
            image_data_delete($value['image_filename_2']);
            image_data_delete($value['image_filename_3']);
        }

        $sql = 'DELETE FROM ' . MYNETS_PREFIX_NAME . 'c_diary_comment WHERE c_diary_id = ?';
        db_query($sql, $params);

        // 日記
        $sql = 'DELETE FROM ' . MYNETS_PREFIX_NAME . 'c_diary WHERE c_diary_id = ?';
        db_query($sql, $params);
    }
}

/**
 * 指定した番号の日記画像を削除
 */
if (! function_exists('db_diary_delete_c_diary_image'))
{
    function db_diary_delete_c_diary_image($c_diary_id, $image_num)
    {
        $data = array(
            'image_filename_'.intval($image_num) => '',
        );
        $where = 'c_diary_id = '.intval($c_diary_id);
        return db_update(MYNETS_PREFIX_NAME . 'c_diary', $data, $where);
    }
}

/**
 * 日記に画像を追加する
 */
if (! function_exists('db_diary_update_c_diary_image_filename'))
{
    function db_diary_update_c_diary_image_filename($c_diary_id, $image_filename, $image_num)
    {
        $data = array(
            'image_filename_'.intval($image_num) => $image_filename,
        );
        $where = 'c_diary_id = '.intval($c_diary_id);
        return db_update(MYNETS_PREFIX_NAME . 'c_diary', $data, $where);
    }
}

/**
 * 日記コメントに画像を追加する2006/11/02 KT メールでのコメント受信処理
 */
if (! function_exists('mail_diary_comment_update_c_diary_comment_image_filename'))
{
    function mail_diary_comment_update_c_diary_comment_image_filename($c_diary_comment_id, $image_filename, $image_num)
    {
        $data = array(
            'image_filename_'.intval($image_num) => $image_filename,
        );
        $where = 'c_diary_comment_id = '.intval($c_diary_comment_id);
        return db_update(MYNETS_PREFIX_NAME . 'c_diary_comment', $data, $where);
    }
}

/**
 * 日記の未読/既読を変更
 * c_diary.is_checkedを更新
 */
if (! function_exists('db_diary_update_c_diary_is_checked'))
{
    function db_diary_update_c_diary_is_checked($c_diary_id, $value)
    {
        $data = array(
            'is_checked' => (bool)$value,
        );
        $where = 'c_diary_id = '.intval($c_diary_id);
        return db_update(MYNETS_PREFIX_NAME . 'c_diary', $data, $where);
    }
}

//--- diary_comment

/**
 * 日記コメント追加
 *
 * @param  int    $c_member_id
 * @param  int    $c_diary_id
 * @param  string $body
 * @return int    insert_id
 * 日記のコメント番号追加処理を追加2007/05/06 KT
 */
if (! function_exists('db_diary_insert_c_diary_comment'))
{
    function db_diary_insert_c_diary_comment($c_member_id, $c_diary_id, $body)
    {
        //同じID、同じ時間で投稿があるかをチェック（５秒以内）
        if (_chkCommentTime(intval($c_member_id), intval($c_diary_id)) !== false) {
            return false;
        }

        $number = getDiaryCommentMaxNumber($c_diary_id);

        $data = array(
            'c_member_id' => intval($c_member_id),
            'c_diary_id' => intval($c_diary_id),
            'body' => $body,
            'r_datetime' => db_now(),
            'comment_number' => intval($number),
        );
        //同様に、コメント数をc_diaryに保存
        $sql = 'update ' . MYNETS_PREFIX_NAME . 'c_diary set comment_count = comment_count + 1 where c_diary_id = ?';
        $params = array(intval($c_diary_id));
        db_query($sql, $params);
        //日記の更新日付をアップデート
        db_diary_update_c_diary_e_datetime($c_diary_id);
        //日記をつけた人のc_member_idを取り出す。
        $c_member_id_chk = k_p_fh_diary_c_member4c_diary_id($c_diary_id);
        //日記にコメントを追加すると、2ポイント追加する 2006/10/19 KT
        $point = 2;
        $memo  = "insert_diary_comment";
        if ($c_member_id_chk != $c_member_id) {
        //db_point_insert_log($c_member_id, $point, $memo);
        //将来利用する
        }
        //ここで日記のフラグを見て送信するか？
        send_diary_comment_info_mail($c_diary_id, $c_member_id,$body);

        return db_insert(MYNETS_PREFIX_NAME . 'c_diary_comment', $data);
    }
}

if (! function_exists('_chkCommentTime'))
{
    function _chkCommentTime($c_member_id, $c_diary_id)
    {
        if ( ! defined('CHECK_COUNT_TIME'))
        {
            define('CHECK_COUNT_TIME',10);          //秒数を設定正式版では移動する
        }

        $sql = "select c_diary_comment_id from ".MYNETS_PREFIX_NAME."c_diary_comment where ";
        $sql .= " c_member_id = ".$c_member_id." and c_diary_id = ".$c_diary_id ;
        //カウント
        $timedata = time()-intval(CHECK_COUNT_TIME);
        $sql .= " and UNIX_TIMESTAMP(r_datetime) > ?";
        $check = db_get_one($sql,array($timedata)) ;
        if (!$check) {
            return false;
        } else {
            return true;
        }
    }
}
/**
 * 日記のコメントが追加されたら、元の日記の更新日付を更新する
 * c_diary.e_datetimeを更新     2006/11/09追加
 */
if (! function_exists('db_diary_update_c_diary_e_datetime'))
{
    function db_diary_update_c_diary_e_datetime($c_diary_id)
    {
        $data = array(
            'e_datetime' => db_now(),
        );
        $where = 'c_diary_id = '.intval($c_diary_id);
        return db_update(MYNETS_PREFIX_NAME . 'c_diary', $data, $where);
    }
}

/**
 * 日記コメント用画像追加
 */
if (! function_exists('db_diary_insert_c_diary_comment_images'))
{
    function db_diary_insert_c_diary_comment_images($c_diary_comment_id,
                                                    $image_filename_1 = '',
                                                    $image_filename_2 = '',
                                                    $image_filename_3 = '')
    {
        $data = array();
        if ($image_filename_1) $data['image_filename_1'] = $image_filename_1;
        if ($image_filename_2) $data['image_filename_2'] = $image_filename_2;
        if ($image_filename_3) $data['image_filename_3'] = $image_filename_3;

        $where = array(
            'c_diary_comment_id' => intval($c_diary_comment_id),
        );
        return db_update(MYNETS_PREFIX_NAME . 'c_diary_comment', $data, $where);
    }
}

/**
 * 日記コメント削除
 *
 * @param   int $c_diary_comment_id
 * @param   int $u  : 削除しようとしている人の c_member_id
 */
if (! function_exists('db_diary_delete_c_diary_comment'))
{
    function db_diary_delete_c_diary_comment($c_diary_comment_id, $u)
    {
        $dc = _do_c_diary_comment4c_diary_comment_id($c_diary_comment_id);
        if ($dc['c_member_id'] != $u && $dc['c_member_id_author'] != $u) {
            return false;
        }

        image_data_delete($dc['image_filename_1']);
        image_data_delete($dc['image_filename_2']);
        image_data_delete($dc['image_filename_3']);
        //コメント数をc_diaryからマイナスしておく
        $sql = 'update ' . MYNETS_PREFIX_NAME . 'c_diary set comment_count=comment_count-1 where c_diary_id=?';
        $params = array(intval($dc['c_diary_id']));
        db_query($sql, $params);

        $sql = 'DELETE FROM ' . MYNETS_PREFIX_NAME . 'c_diary_comment WHERE c_diary_comment_id = ?';
        $params = array(intval($c_diary_comment_id));

        return db_query($sql, $params);
    }
}

?>
