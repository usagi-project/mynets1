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
 * ========================================================================
 */

/**
 * Smarty t_body modifier plugin
 * @copyright 2007,Usagi Project, All Right Reserved.
 *
 * @param  string $string, Text
 * @param  string $type,  Called type
 * @return string
 */
function smarty_modifier_t_body($string,$type="")
{
    $cdir = dirname(__FILE__);
    $search = array('&quot;', '&#039;');
    $replace = array('"', "'");
    $string = str_replace($search, $replace, $string);

    switch($type) {
        case 'community':
        case 'event':
        case 'diary':
        case 'message':
        case 'profile':
            require_once $cdir . '/modifier.t_image.php'; $string = smarty_modifier_t_image($string);
            require_once $cdir . '/modifier.t_url2pne.php'; $string = smarty_modifier_t_url2pne($string);
            require_once $cdir . '/modifier.t_moji.php'; $string = smarty_modifier_t_moji($string);
            require_once $cdir . '/modifier.t_cmd2.php'; $string = smarty_modifier_t_cmd2($string);
            $string = nl2br($string);
            require_once $cdir . '/modifier.t_url2cmd.php'; $string = smarty_modifier_t_url2cmd($string);
            require_once $cdir . '/modifier.t_cmd.php'; $string = smarty_modifier_t_cmd($string);
            require_once $cdir . '/modifier.t_x2url.php'; $string = smarty_modifier_t_x2url($string);
            require_once $cdir . '/modifier.t_cmntlink.php'; $string = smarty_modifier_t_cmntlink($string);
            break;

        case 'introduce':
            require_once $cdir . '/modifier.t_image.php'; $string = smarty_modifier_t_image($string);
        case 'schedule':
        case 'info':
        case 'dengon':
        case 'review':
            require_once $cdir . '/modifier.t_url2pne.php'; $string = smarty_modifier_t_url2pne($string);
            require_once $cdir . '/modifier.t_moji.php'; $string = smarty_modifier_t_moji($string);
            require_once $cdir . '/modifier.t_url2a.php'; $string = smarty_modifier_t_url2a($string);
            $string = nl2br($string);
            require_once $cdir . '/modifier.t_x2url.php'; $string = smarty_modifier_t_x2url($string);
            break;
        case 'kmessage':
        case 'kdengon':
        case 'kevent':
        case 'kbbs':
        case 'kdiary':
        case 'kadmin':
            require_once $cdir . '/modifier.t_url2pne.php'; $string = smarty_modifier_t_url2pne($string);
            require_once $cdir . '/modifier.t_moji.php'; $string = smarty_modifier_t_moji($string);
            require_once $cdir . '/modifier.t_mapurl.php'; $string = smarty_modifier_t_mapurl($string);
            require_once $cdir . '/modifier.t_url2aa.php'; $string = smarty_modifier_t_url2aa($string);
            $string = nl2br($string);
            require_once $cdir . '/modifier.t_x2url.php'; $string = smarty_modifier_t_x2url($string);
            require_once $cdir . '/modifier.t_cmntlink_delete.php'; $string = smarty_modifier_t_cmntlink_delete($string);
            break;
        case 'name':
        case 'title':
            $string = nl2br($string);
            require_once $cdir . '/modifier.t_url2pne.php'; $string = smarty_modifier_t_url2pne($string);
            require_once $cdir . '/modifier.t_moji.php'; $string = smarty_modifier_t_moji($string);
            break;
        case 'admin_info':
            require_once $cdir . '/modifier.t_image.php'; $string = smarty_modifier_t_image($string);
            require_once $cdir . '/modifier.t_url2pne.php'; $string = smarty_modifier_t_url2pne($string);
            require_once $cdir . '/modifier.t_moji.php'; $string = smarty_modifier_t_moji($string);
            require_once $cdir . '/modifier.t_url2a.php'; $string = smarty_modifier_t_url2a($string);
            $string = nl2br($string);
            require_once $cdir . '/modifier.t_infomap.php'; $string = smarty_modifier_t_infomap($string);
            require_once $cdir . '/modifier.t_x2url.php'; $string = smarty_modifier_t_x2url($string);
            break;
    }
    return $string;
}

?>
