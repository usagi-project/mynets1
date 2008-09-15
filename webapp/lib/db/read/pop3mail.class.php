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
 * @author     Kazuki <info@usagi.mynets.jp>
 * @author     KUNIHARU Tsujioka <kunitsuji@gmail.com>
 * @author     Fesly Project <http://sourceforge.jp/projects/fesly>
 * @author     Usagi Project <info@usagi.mynets.jp>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @chengelog  [2008/08/02] Ver1.2.0Nighty package
 * ========================================================================
 */

/**
 * キャッチオールで受信したメールを
 * POPで受信し、スクリプトへ渡すクラス
 *
 */
require_once OPENPNE_WEBAPP_DIR . '/lib/OpenPNE/KtaiMail.php';
require_once OPENPNE_WEBAPP_DIR . '/lib/mail/sns.php';

define('POP_SERVER_PORT', 110);

class pop3mail
{

    var $sock = NULL;

    function getPopMail()
    {
        if (! POP_SERVER_DOMAIN || ! POP_SERVER_USER || ! POP_SERVER_PASS)
        {
            return FALSE;
        }

        $this->sock = fsockopen(POP_SERVER_DOMAIN, POP_SERVER_PORT, $err, $errno, 10);
        if (! $this->sock) {
            return FALSE;
        }

        $buf = fgets($this->sock, 512);
        if(substr($buf, 0, 3) != '+OK') {
            return FALSE;
        }
        $buf  = $this->sendCommand("USER " . POP_SERVER_USER);
        $buf  = $this->sendCommand("PASS " . POP_SERVER_PASS);
        $data = $this->sendCommand("STAT"); //件数とサイズ取得
        sscanf($data, '+OK %d %d', $num, $size);
        if ($num == "0") {
            //新着無し
            $buf = $this->sendCommand("QUIT");
            fclose($this->sock);
            return TRUE;
        }

        for($i=1; $i<=$num; $i++) {
            $line     = $this->sendCommand("RETR $i"); //メッセージ取得
            $raw_mail = '';
            while (!ereg("^\.\r\n", $line))
            {
                $line      = fgets($this->sock, 512);
                $raw_mail .= $line;
            }
            $data = $this->sendCommand("DELE $i"); //メッセージ削除
            $this->m_process_mail($raw_mail);
        }

        $buf = $this->sendCommand("QUIT"); //受信完了
        fclose($this->sock);
        //var_dump($buf);
        return TRUE;
    }

    function sendCommand($cmd) {
        fputs($this->sock, $cmd . "\r\n");
        $buf = fgets($this->sock, 512);
        if(substr($buf, 0, 3) == '+OK')
        {
            return $buf;
        }
        return FALSE;
    }

    /**
     * メール処理
     */
    function m_process_mail($raw_mail)
    {
        $options['from_encoding']         = MAIL_FROM_ENCODING;
        $options['to_encoding']           = 'UTF-8';
        $options['img_tmp_dir']           = OPENPNE_VAR_DIR . '/tmp';
        $options['img_max_filesize']      = IMAGE_MAX_FILESIZE * 1024;
        $options['trim_doublebyte_space'] = OPENPNE_TRIM_DOUBLEBYTE_SPACE;

        $decoder =& new OpenPNE_KtaiMail($options);
        $decoder->decode($raw_mail);

        $from = $decoder->get_from();
        $to   = $decoder->get_to();

        if (! db_common_is_mailaddress($from) || ! db_common_is_mailaddress($to))
        {
            m_debug_log('mail.php::m_process_mail() ERROR missin from_address to_address');
            return FALSE;
        }

        list($to_user, $to_host) = explode('@', $to, 2);

        // check prefix
        if (MAIL_ADDRESS_PREFIX) {
            if (strpos($to_user, MAIL_ADDRESS_PREFIX) !== 0) {
                m_debug_log('mail.php::m_process_mail() missing prefix '.$to_user);
                return FALSE;
            }
            $to_user = substr($to_user, strlen(MAIL_ADDRESS_PREFIX));
        }

        if ($to_host === MAIL_SERVER_DOMAIN) {
            $mail_sns =& new mail_sns($decoder);
            if (! $mail_sns->main()) {
                m_debug_log('mail.php::m_process_mail() ERROR code 1');
                return FALSE;
            }
        } else {
            m_debug_log('mail.php::m_process_mail() ERROR '.$to_host.' missing MAIL_SEVER_DOMAIN');
            return FALSE;
        }

        return TRUE;
    }
}
    /**
    * デバッグ用ログ保存
    */
if (!function_exists('m_debug_log'))
{
    function m_debug_log($msg, $priority =  PEAR_LOG_WARNING) {
        if (!MAIL_DEBUG_LOG) return;

        $log_path = OPENPNE_VAR_DIR . '/log/mail.log';
        $file =& Log::singleton('file', $log_path, 'MAIL');

        mb_convert_encoding($msg, 'JIS', 'auto');
        $file->log($msg, $priority);
    }
}
?>
