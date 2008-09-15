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

if (! function_exists('db_image_insert_c_image'))
{
    function db_image_insert_c_image($filename, $bin, $c_member_id, $type = '')
    {
        $db =& db_get_instance('image');

        $data = array(
            'filename'   => $filename,
            'bin'        => base64_encode($bin),
            'type'       => $type,
            'r_datetime' => db_now(),
            'c_member_id' => intval($c_member_id),
        );
        return $db->insert(MYNETS_PREFIX_NAME . 'c_image', $data, 'c_image_id');
    }
}

if (! function_exists('db_image_delete_c_image'))
{
    function db_image_delete_c_image($filename)
    {
        $db =& db_get_instance('image');

        $sql = 'DELETE FROM ' . MYNETS_PREFIX_NAME . 'c_image WHERE filename = ?';
        $params = array($filename);
        return $db->query($sql, $params);
    }
}

//---

if (! function_exists('_do_insert_c_image'))
{
    function _do_insert_c_image($filename, $filepath, $c_member_id)
    {
        if (!is_readable($filepath)) return false;

        $fp = fopen($filepath, 'rb');
        $image_data = fread($fp, filesize($filepath));
        fclose($fp);

        // 画像かどうかのチェック
        if (!@imagecreatefromstring($image_data)) return false;

        //TODO:typeフィールドを使う
        return db_image_insert_c_image($filename, $image_data, $c_member_id);
    }
}

if (! function_exists('image_data_delete'))
{
    function image_data_delete($image_filename)
    {
        if (!$image_filename) return false;

        db_image_delete_c_image($image_filename);

        // cacheの削除
        image_cache_delete($image_filename);
    }
}

//---

if (! function_exists('image_insert_c_image4tmp'))
{
    function image_insert_c_image4tmp($prefix, $tmpfile, $c_member_id)
    {
        if (!$tmpfile || preg_match('/[^\.\w]/', $tmpfile)) return false;

        $path_parts = pathinfo($tmpfile);
        $ext = $path_parts['extension'];
        $ext = strtolower($ext);

        $allowed_ext = array('jpg', 'jpeg', 'gif', 'png');
        if (!in_array($ext, $allowed_ext)) {
            return false;
        }

        $filename = sprintf('%s_%s.%s', $prefix, time(), $ext);

        if (!OPENPNE_TMP_IMAGE_DB) {
            $img_tmp_dir_path = OPENPNE_VAR_DIR . '/tmp/';
            $filepath = $img_tmp_dir_path . basename($tmpfile);

            if (_do_insert_c_image($filename, $filepath, $c_member_id)) {
                return $filename;
            }
        } else {
            $c_tmp_image = c_tmp_image4filename($tmpfile);

            $params = array(
                'filename' => $filename,
                'bin' => $c_tmp_image['bin'],
                'r_datetime' => db_now(),
                'c_member_id' => intval($c_member_id),
            );
            if (db_insert(MYNETS_PREFIX_NAME . "c_image", $params)) {
                return $filename;
            }
        }
        return false;
    }
}

if (! function_exists('image_insert_c_image'))
{
    function image_insert_c_image($upfile_obj, $filename, $c_member_id)
    {
        if (!$upfile_obj) return false;

        $filepath = $upfile_obj['tmp_name'];

        $path_parts = pathinfo($upfile_obj['name']);
        $ext = $path_parts['extension'];
        $ext = strtolower($ext);
        $filename = $filename . '_' . time() . '.' . $ext;

        if (!_do_insert_c_image($filename, $filepath, $c_member_id)) {
            return false;
        }
        return $filename;
    }
}

if (! function_exists('image_insert_c_tmp_image'))
{
    function image_insert_c_tmp_image($upfile_obj, $filename)
    {
        if (!$upfile_obj) {
            return false;
        }

        $filepath = $upfile_obj['tmp_name'];

        $result = _do_insert_c_tmp_image($filename, $filepath);
        if (!$result) {
            return false;
        }
        return $filename;
    }
}

if (! function_exists('_do_insert_c_tmp_image'))
{
    function _do_insert_c_tmp_image($filename, $filepath)
    {
        if (!is_readable($filepath)) {
            return false;
        }

        $fp = fopen($filepath, 'rb');
        $image_data = fread($fp, filesize($filepath));
        fclose($fp);

        // 画像かどうかのチェック
        if (!@imagecreatefromstring($image_data)) {
            return false;
        }

        $sql = 'DELETE FROM ' . MYNETS_PREFIX_NAME . 'c_tmp_image WHERE filename = ?';
        $params = array($filename);
        db_query($sql, $params);

        $image_data = base64_encode($image_data);
        $params = array(
            'filename' => $filename,
            'bin' => $image_data,
            'r_datetime' => db_now(),
        );

        return db_insert(MYNETS_PREFIX_NAME . 'c_tmp_image', $params);
    }
}

if (! function_exists('t_image_clear_tmp_db'))
{
    function t_image_clear_tmp_db($uid)
    {
        $sql = 'DELETE FROM ' . MYNETS_PREFIX_NAME . 'c_tmp_image WHERE filename LIKE ?';
        $params = array('%_' . $uid . '.%');
        db_query($sql, $params);
    }
}

?>
