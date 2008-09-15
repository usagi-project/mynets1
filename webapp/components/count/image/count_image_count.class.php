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

class Image_Count
{
    var $datacount;

    var $column;

    function Image_Count($column, $uid)
    {
        $this->datacount = new Data_Count($uid);
        $this->column = $column;
    }

    //画像の数を保存する
    function addCount($count = 1)
    {
        $this->datacount->addCount($this->column, $count);
    }

    //画像のファイルサイズを保存する
    function addFileSize($size, $sizecolumn = 'image_size')
    {
        $this->datacount->addCount($sizecolumn, $size);
    }

    //画像の数を取得する
    function getCount()
    {
        $this->datacount->getCount($this->column);
    }

    //画像のファイルサイズを取得する
    function getFileSize($sizecolumn = 'image_size')
    {
        $this->datacount->getCount($sizecolumn);
    }
}
?>