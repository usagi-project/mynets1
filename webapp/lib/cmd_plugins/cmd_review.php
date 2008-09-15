<?php
/* ========================================================================
 *
 * @license This source file is subject to version 3.01 of the PHP license,
 *              that is available at http://www.php.net/license/3_01.txt
 *              If you did not receive a copy of the PHP license and are unable
 *              to obtain it through the world-wide-web, please send a note to
 *              license@php.net so we can mail you a copy immediately.
 *
 * @project    UsagiProject 2006-2007
 * @author     Naoya Shimada <info@usagi.mynets.jp>
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  Naoya Shimada <author member ad http://usagi.mynets.jp/member.html>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @chengelog  [2007/12/15] Ver1.1.1Nighty package
 * ========================================================================
 */

function cmd_review_main($param) {
    if(isset($param['c_review_id'])) {

        // Smartyインスタンス
        $smarty = new OpenPNE_Smarty($GLOBALS['SMARTY']);

        // PCと携帯で動作を変える
        if (!isKtaiUserAgent()) {
            // PCの場合のテンプレート
            $place = '';
            $path = 'templates/cmd/pc/cmd_review.tpl';
            $name = 'pc';
        } else {
            // 携帯の場合のテンプレート
            $place = '';
            $path = 'templates/cmd/ktai/cmd_review.tpl';
            $name = 'ktai';
        }

        // テンプレート存在チェック
        if (!$tpl = _cmd_ext_search($path, $place)) {
            return false;
        }
        $tpl = 'file:' . $tpl;
        $cache_id = $compile_id = 'cmd_'. $place . '_' . $name . '_';

        // Smarty変数のセット
        $smarty->assign('OPENPNE_URL', OPENPNE_URL);
        $smarty->assign('SNS_NAME', SNS_NAME);
        $smarty->assign('ADMIN_EMAIL', ADMIN_EMAIL);
        $smarty->assign('CATCH_COPY', CATCH_COPY);
        $smarty->assign('OPERATION_COMPANY', OPERATION_COMPANY);
        $smarty->assign('COPYRIGHT', COPYRIGHT);
        $smarty->assign('WORD_FRIEND', WORD_FRIEND);
        $smarty->assign('WORD_MY_FRIEND', WORD_MY_FRIEND);
        $smarty->assign('WORD_FRIEND_HALF', WORD_FRIEND_HALF);
        $smarty->assign('WORD_MY_FRIEND_HALF', WORD_MY_FRIEND_HALF);
        $smarty->assign('inc_signature', fetch_inc_signature($smarty));
        $smarty->assign('AMAZON_AFFID', AMAZON_AFFID);

        // レビュー情報
        $c_review = p_h_review_list_product_c_review4c_review_id($param['c_review_id']);

        // 満足度取得
        $satisfaction = _cmd_review_list_product_satisfaction_level4c_review_id($param['c_review_id']);

        // レビュー情報のセット
        $smarty->assign('c_review', $c_review);
        $smarty->assign('satisfaction', $satisfaction);

        // 簡易URLジェネレート
        $url = 'http_://amazon.jp/' . AMAZON_AFFID . '/dp/' . $c_review['asin'];
        $smarty->assign('amazon_url', $url);

        // フェッチ
        return $smarty->fetch($tpl, $cache_id, $compile_id, false);
    } else {
        return false;
    }
}

/*
 * 満足度を集計して返す
 * @param $c_review_id レビューID
 * @return array 満足度平均,満足度平均の小数点以下切り捨て,レビューコメント数
 */
function _cmd_review_list_product_satisfaction_level4c_review_id($c_review_id)
{
    $sql = "SELECT truncate(avg(satisfaction_level),2) as average" .
                  ", truncate(avg(satisfaction_level),0) as level" .
                  ", count(satisfaction_level) as review_count" .
           " FROM " . MYNETS_PREFIX_NAME . "c_review_comment" .
           " WHERE c_review_id = ?";
    $params = array(intval($c_review_id));
    return db_get_row($sql, $params);
}

/*
 * レビュー小窓のテンプレート探し
 * @param $path テンプレートの相対パス
 * @param &$place テンプレートの接頭語(?)
 * @return string テンプレートの絶対パス
 */
function _cmd_ext_search($path, &$place)
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
?>
