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
 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 */

function smarty_function_t_img_url_skin($params, &$smarty)
{
    if (OPENPNE_IMG_URL) {
        $url = OPENPNE_IMG_URL;
    } else {
        if (OPENPNE_USE_PARTIAL_SSL && is_ssl()) {
            $url = OPENPNE_SSL_URL;
        } else {
            $url = './';
        }
    }

    $filename = $params['filename'];
    if (strpos($filename, 'skin_') === 0) {
        $ext = 'jpg';
    } else {
        $ext = 'gif';
    }
    if(defined('SKIN_FOLDER')) {
        $work = sprintf('skin/%s/img/%s.%s', SKIN_FOLDER, $filename, $ext);
        if( is_readable($work) )
            $url .= $work;
        else
            $url .= sprintf('skin/default/img/%s.%s', $filename, $ext);
    } else
        $url .= sprintf('skin/default/img/%s.%s', $filename, $ext);
    return $url;
}

?>
