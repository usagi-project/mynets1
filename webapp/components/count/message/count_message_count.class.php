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
 * @author     Kunitsuji <kunitsuji@gmail.com>
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @chengelog  [2008/03/11]
 * ========================================================================
 */

require_once OPENPNE_WEBAPP_DIR . "/components/count/count.class.php";

class Message_Count
{
    var $datacount;

    var $send_column    = 'message_send_count';
    var $resieve_column = 'message_resieve_count';

    function Message_Count($uid, $resieveuid)
    {
        //$this->datacount = new Data_Count($uid);
        //$this->column    = $column;
        $this->uid        = $uid;
        $this->resieveuid = $resieveuid;
    }

    //送信メッセージの数を保存する
    function _addSendCount($count)
    {
        $this->datacount = new Data_Count($this->uid);
        $this->datacount->addCount($this->send_column, $count);
    }
    //受信メッセージの数を保存する
    function _addResieveCount($count)
    {
        $this->datacount = new Data_Count($this->resieveuid);
        $this->datacount->addCount($this->resieve_column, $count);
    }

    function addCount($count = 1)
    {
        $this->_addSendCount($count);
        $this->_addResieveCount($count);
    }
    //送信メッセージの数を取得する
    function getCount()
    {
        $this->datacount->getCount($this->column);
    }
}
?>