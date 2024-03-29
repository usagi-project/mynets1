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
 * @author     UsagiProject <info@usagi-project.org>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi-project.org/member.html>
 * @chengelog  [2008/03/11]
 * ========================================================================
 */

require_once OPENPNE_WEBAPP_DIR . "/components/count/count.class.php";

class Commu_Count
{
    var $datacount;

    var $column;

    function Commu_Count($column, $uid)
    {
        $this->datacount = new Data_Count($uid);
        $this->column    = $column;
    }

    //コミュニティの数を追加する
    function addCount($count = 1)
    {
        $this->datacount->addCount($this->column, $count);
    }

    //コミュニティのカウント数を取得する
    function getCount()
    {
        $this->datacount->getCount($this->column);
    }


}
?>