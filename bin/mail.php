<?php
/* ========================================================================
 *
 * @license This source file is subject to version 3.0 of the PHP license,
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

/*
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 */

chdir(dirname(__FILE__));
require_once './config.inc.php';
require_once OPENPNE_WEBAPP_DIR . '/init.inc';

// エラー出力を抑制
ini_set('display_errors', false);
@ob_start();

/**
 * ライブラリ読み込み
 */
require_once 'Log.php';
require_once 'OpenPNE/KtaiMail.php';
require_once 'mail/sns.php';

// 標準入力からメールデータの読み込み
$stdin = fopen('php://stdin', 'rb');
$raw_mail = '';
do {
    $data = fread($stdin, 8192);
    if (strlen($data) == 0) {
        break;
    }
    $raw_mail .= $data;
} while(true);
fclose($stdin);

// メールの処理
m_process_mail($raw_mail);

// デバッグ用ログ保存
m_debug_log(ob_get_contents(), PEAR_LOG_DEBUG);

while (@ob_end_clean());


/**
 * メール処理
 */
function m_process_mail($raw_mail)
{
    $options['from_encoding']    = MAIL_FROM_ENCODING;
    $options['to_encoding']      = 'UTF-8';
    $options['img_tmp_dir']      = OPENPNE_VAR_DIR . '/tmp';
    $options['img_max_filesize'] = IMAGE_MAX_FILESIZE * 1024;
    $options['trim_doublebyte_space'] = OPENPNE_TRIM_DOUBLEBYTE_SPACE;

    $decoder =& new OpenPNE_KtaiMail($options);
    $decoder->decode($raw_mail);

    $from = $decoder->get_from();
    $to   = $decoder->get_to();

    if (!db_common_is_mailaddress($from) || !db_common_is_mailaddress($to)) {
        m_debug_log('mail.php::m_process_mail() ERROR missin from_address to_address');
        return false;
    }

    list($to_user, $to_host) = explode("@", $to, 2);

    // check prefix
    if (MAIL_ADDRESS_PREFIX) {
        if (strpos($to_user, MAIL_ADDRESS_PREFIX) !== 0) {
            m_debug_log('mail.php::m_process_mail() missing prefix '.$to_user);
            return false;
        }
        $to_user = substr($to_user, strlen(MAIL_ADDRESS_PREFIX));
        m_debug_log('mail.php::m_process_mail() ok prefix '.$to_user);
    }

    if ($to_host === MAIL_SERVER_DOMAIN) {
        $mail_sns =& new mail_sns($decoder);
        if (!$mail_sns->main()) {
            m_debug_log('mail.php::m_process_mail() ERROR code 1');
            return false;
        }
    } else {
        m_debug_log('mail.php::m_process_mail() ERROR '.$to_host.' missing MAIL_SEVER_DOMAIN');
        return false;
    }

    return true;
}

/**
 * デバッグ用ログ保存
 */
if (! function_exists('m_debug_log'))
{
    function m_debug_log($msg, $priority =  PEAR_LOG_WARNING)
    {
        if (!MAIL_DEBUG_LOG) return;

        $log_path = OPENPNE_VAR_DIR . '/log/mail.log';
        $file =& Log::singleton('file', $log_path, 'MAIL');

        mb_convert_encoding($msg, 'JIS', 'auto');
        $file->log($msg, $priority);
    }
}

?>
