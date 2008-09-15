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
 *             [2007/09/12]
 * ========================================================================
 */

//<PCKTAI
if (!OPENPNE_ENABLE_KTAI) {
    // disable ktai module
    exit;
}
//>

require_once(OPENPNE_WEBAPP_DIR .'/lib/OpenPNE/KtaiUA.php');
require_once(OPENPNE_WEBAPP_DIR .'/modules/qrentry/lib/qrentry.class.php');

//デフォルトページ
$GLOBALS['__Framework']['default_page'] = 'qr_invite';

    $agent = new OpenPNE_KtaiUA();
    if($agent->is_docomo()){
        $carrier = 'docomo';
    }elseif($agent->is_au()){
        $carrier = 'au';
    }elseif($agent->is_vodafone()){
        $carrier = 'softbank';
    }elseif($agent->is_willcom()){
        $carrier = 'willcom';
    }elseif($agent->is_emobile()){
        $carrier = 'emobile';
    }elseif($agent->is_iphone()){
        $carrier = 'softbank-iphone';
    } else {
        $carrier = 'other';
    }
    $GLOBALS['__Framework']['ktai_carrier'] = $carrier;

//<PCKTAI
if (!OPENPNE_ENABLE_KTAI) {
    // disable ktai module
    exit;
}
//>

// User-Agent判別
if (CHECK_KTAI_UA && !isKtaiUserAgent()) {
    openpne_redirect('pc');
}

// 文字コード変換
function ktai_convert_encoding($arr)
{
    return is_array($arr) ?
        array_map('ktai_convert_encoding', $arr) :
        mb_convert_encoding($arr, 'UTF-8', 'SJIS-win');
}

// 絵文字変換
function ktai_convert_emoji($arr)
{
    return is_array($arr) ?
        array_map('ktai_convert_emoji', $arr) :
        emoji_escape($arr);
}

function ktai_convert($arr)
{
    $arr = ktai_convert_emoji($arr);
    $arr = ktai_convert_encoding($arr);
    return $arr;
}

$_GET     = ktai_convert($_GET);
$_POST    = ktai_convert($_POST);
$_REQUEST = ktai_convert($_REQUEST);

ini_set('session.use_cookies', '0');

function init_qrentry_page(&$smarty)
{
    //---- inc_ テンプレート用 変数 ----//
    $smarty->assign('inc_ktai_header', fetch_inc_ktai_header());
    $smarty->assign('inc_ktai_footer', fetch_inc_ktai_footer());

    //全ページ共通変数のアサイン
    if(isset($_REQUEST['msg']))
      $smarty->assign('msg', k_p_common_msg4msg_id($_REQUEST['msg']));
    $smarty->assign('WORD_FRIEND', WORD_FRIEND);
    $smarty->assign('WORD_MY_FRIEND', WORD_MY_FRIEND);
    $smarty->assign('WORD_FRIEND_HALF', WORD_FRIEND_HALF);
    $smarty->assign('WORD_MY_FRIEND_HALF', WORD_MY_FRIEND_HALF);

    $is_secure = $GLOBALS['__Framework']['is_secure'];
    if ($is_secure) {
        $smarty->assign('u', $GLOBALS['KTAI_C_MEMBER_ID']);
        $smarty->assign('tail', $GLOBALS['KTAI_URL_TAIL']);
        @session_start();
        $smarty->assign('PHPSESSID', session_id());
    }

    // set SJIS
    $smarty->setOutputCharset('SJIS');
}

?>
