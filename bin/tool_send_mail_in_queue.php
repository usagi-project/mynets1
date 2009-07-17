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

require_once './config.inc.php';
require_once OPENPNE_WEBAPP_DIR . '/init.inc';

require_once 'Mail/Queue.php';

$db_opt = array(
    "type"=>"db",
    "dsn"=>$GLOBALS['_OPENPNE_DSN_LIST']['main']['dsn'],
    "mail_table"=>MYNETS_PREFIX_NAME."mail_queue",
);
$mail_opt = array(
    "driver"=>"mail",
);
$mail_queue  = new Mail_Queue($db_opt, $mail_opt);
$mail_queue->sendMailsInQueue(SEND_MAIL_QUEUE_NUM);

?>
