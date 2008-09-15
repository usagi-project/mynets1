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

function smarty_function_t_img_url($params, &$smarty)
{
    $p = _smarty_function_t_img_url($params);
    $html = true;
    if (isset($params['_html'])) {
        $html = (bool)$params['_html'];
        unset($params['_html']);
    }
    $urlencode = false;
    if (isset($params['_urlencode'])) {
        $urlencode = (bool)$params['_urlencode'];
        unset($params['_urlencode']);
    }

    if (OPENPNE_IMG_URL) {
        $url = OPENPNE_IMG_URL;
    } else {
        if (OPENPNE_USE_PARTIAL_SSL && is_ssl()) {
            $url = OPENPNE_SSL_URL;
        } else {
            if (isset($params['_absolute'])) {
                $url = OPENPNE_URL;
            } else {
                $url = './';
            }
        }
    }

    if(defined('SKIN_FOLDER') && isset($p['skin'])) {
        $work = sprintf('skin/%s/img/%s%sx%s.gif', SKIN_FOLDER, $p['filename'],$p['w'],$p['h']);
        if( is_readable($work) )
            return $url . $work;
        $work2 = sprintf('skin/%s/img/%s.gif', SKIN_FOLDER, $p['filename']);
        if( !is_readable($work2) )
            $work2 = sprintf('skin/default/img/%s.gif', $p['filename']);
        if( is_readable($work2) )
            t_img_url_gen($work2,$work,$p['w'],$p['h']);
        return $url . $work;
    }

    if (!OPENPNE_IMG_CACHE_PUBLIC) {
        $url .= 'img.php';

        include_once 'PHP/Compat/Function/http_build_query.php';
        if ($q = http_build_query($p)) {
            if ($html) {
                $url .= '?' . htmlspecialchars($q);
            } else {
                $url .= '?' . $q;
            }
        }
    } else {
        include_once 'OpenPNE/Img.php';
        if (!$p['f']) {
            $parts = explode('.', $p['filename']);
            $f = array_pop($parts);
            switch ($f) {
            case 'jpg':
            case 'gif':
            case 'png':
                $p['f'] = $f;
                break;
            default:
                $p['f'] = 'jpg';
                break;
            }
        }
        $path = OpenPNE_Img::get_cache_path($p['filename'], $p['w'], $p['h'], $p['f']);
        $url .= 'img/' . $path;
    }

    if ($urlencode) {
        $url = urlencode($url);
    }

    return $url;
}

function t_img_url_gen($src,$dest,$w,$h)
{
   $iim = @imagecreatefromgif( $src );
   if( !$iim ) return;

   $s_width  = imagesx($iim);
   $s_height = imagesy($iim);

   $oim = imagecreatetruecolor($w, $h);
   if (function_exists("imagecopyresampled")) {
        imagecopyresampled($oim, $iim,
                0, 0, 0, 0, $w, $h, $s_width, $s_height);
   } else {
        imagecopyresized($oim, $iim,
                0, 0, 0, 0, $w, $h, $s_width, $s_height);
   }
   
   //GDのバージョンによってImageGIF画像が使えない場合があるので対処
    if (function_exists("imagegif")) {
        return imagegif($oim,$dest);
    } else {
        return imagejpeg($oim,$dest);
    }
    exit;
}

/**
 * validate params
 * @param  array $params
 * @return array
 */
function _smarty_function_t_img_url($params)
{
    $result = array();

    if (!empty($params['filename']) && preg_match('/^\w+(?:\.((?:jpe?g)|(?:gif)|(?:png)))?$/', $params['filename'])) {
        $filename = $params['filename'];
    } else {
        if(defined('SKIN_FOLDER')) {
            if ( !empty($params['noimg']) ) {
                $filename = (substr($params['noimg'],0,8)=='no_image')?'no_image':'no_logo';
                return array('skin'=> '1','filename'=>$filename, 'w' => $params['w'], 'h' => $params['h']);
            } else {
                return array('skin'=> '1','filename'=>'no_image', 'w' => '180', 'h' => '180');
            }
        } else if (!empty($params['noimg'])) {
            $filename = db_get_c_skin_filename4skinname($params['noimg']);
        } else {
            $filename = db_get_c_skin_filename4skinname('no_image');
        }

    }
    $result['filename'] = $filename;

    if (!empty($params['w']) && (intval($params['w']) > 0)) {
        $result['w'] = intval($params['w']);
    }
    if (!empty($params['h']) && (intval($params['h']) > 0)) {
        $result['h'] = intval($params['h']);
    }

    if (!empty($params['f'])) {
        switch ($params['f']) {
        case 'jpg':
        case 'gif':
        case 'png':
            $result['f'] = $params['f'];
            break;
        }
    }

    return $result;
}

?>
