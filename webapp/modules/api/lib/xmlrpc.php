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

function xmlrpc_get_response($params)
{
    return new XML_RPC_Response(XML_RPC_encode($params));
}

function xmlrpc_get_fault_response($code, $string = '')
{
    return new XML_RPC_Response(0, $code, $string);
}

/// utility functions

/**
 * 日時を YYYYMMDDHHMMSS形式 に変換する
 * 
 * @param string $date_string
 * @return string YYYYMMDDHHSS
 */
function xmlrpc_get_date($date_string)
{
    return date('YmdHis', strtotime($date_string));
}

/**
 * 画像のURLを取得する
 * 
 * @param string $image_filename
 * @param string $no_image image_filenameが空の場合にno_image.gifに置換するかどうか
 * @return string 画像のURL
 */
function xmlrpc_get_image_url($image_filename = '', $no_image = true)
{
    if (!$image_filename) {
        if (!$no_image) {
            return '';
        }
        $image_filename = 'no_image.gif';
    }

    if (OPENPNE_IMG_URL) {
        $path = OPENPNE_IMG_URL;
    } else {
        $path = OPENPNE_URL . 'img.php';
    }

    return $path . '?filename=' . $image_filename;
}

?>
