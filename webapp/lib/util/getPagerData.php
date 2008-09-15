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
 * @author     Kenichi Ando [Neo Corp.]
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @copyright  Kenichi Ando [Neo Corp.]
 * @version    MyNETS,v 1.1.0
 * @since      File available since Release 1.0.0 Nighty
 * @chengelog  [2007/02/17] Ver1.1.0Nighty package
 *             [2007/03/07]
 * ======================================================================== 
 */

function getPagerData($page, $page_size, $total_num)
{
    $pager = array(
        'page' => $page,
        'page_size' => $page_size,
        'total_num' => $total_num,
        'start_num' => ($page - 1) * $page_size + 1,
        'end_num' => $page * $page_size,
        'total_page' => ceil($total_num / $page_size),
        'prev_page' => 0,
        'next_page' => 0,
    );

    // 表示している最後の番号
    if ($pager['end_num'] > $pager['total_num'])
        $pager['end_num'] = $pager['total_num'];

    // 前ページ
    if ($pager['page'] > 1)
        $pager['prev_page'] = $page - 1;

    // 次ページ
    if ($pager['end_num'] < $pager['total_num'])
        $pager['next_page'] = $page + 1;

    $disp_first = max(($page - 10), 1);
    $disp_last = min(($page + 9), $pager['total_page']);
    for (; $disp_first <= $disp_last; $disp_first++) {
        $pager['disp_pages'][] = $disp_first;
    }

    return $pager;
}
?>
