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
 * @package    MyNETS
 * @author     KuniharuTsujioka UsagiProject <info@usagi.mynets.jp>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @version    MyNETS,v 1.1.0
 * @chengelog  [2007/06/26] Ver1.1.0Nighty package
 * ========================================================================
 */


/**
 * 通報を登録
 *@param $data_id               データのID番号
 *@param $data_flag             データの判定フラグ０なし、２メッセージ、１日記、３プロフィールなど
 *@param $category_flag         １問い合わせ、２通報
 *@param $body                  内容
 */
if (! function_exists('setInquiryData'))
{
    function setInquiryData($data_id, $data_flag, $category_flag, $body, $u)
    {

        $data = array(
            'data_id' => intval($data_id),
            'data_flag' => intval($data_flag),
            'category_flag' => intval($category_flag),
            'body' => $body,
            'c_member_id' => intval($u),
            'r_datetime' => db_now(),
        );
        return db_insert(MYNETS_PREFIX_NAME . 'c_inquiry', $data);
    }
}

?>
