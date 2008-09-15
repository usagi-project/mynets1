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
 * @author     shinji hyodo
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @version    MyNETS,v 1.0.0
 * @since      File available since Release 1.0.0 Nighty
 * @chengelog  [2007/03/06] shinji hyodo added
 *             [2008/06/13] Kuniharu Tsujioka update
 * ========================================================================
 */
class emoji_entity
{
    //var $name;
    var $docomo;
    var $au;
    var $softbank;

    function emoji_entity($option)
    {
        //$this->name = $option[0];
        $this->docomo = $option[1];
        $this->au = $option[2];
        if (strlen($option[3]) == 2) {
            $this->softbank = pack('cc',0x1b,0x24) . $option[3] . pack('c',0x0f);
        } else {
            $this->softbank = $option[3];
        }
    }

    function get()
    {
        if ($GLOBALS['__Framework']['ktai_carrier']=='docomo' ){
            return $this->docomo;
        } elseif ($GLOBALS['__Framework']['ktai_carrier']== 'au'){
            return $this->au;
        } elseif ($GLOBALS['__Framework']['ktai_carrier']== 'softbank'){
            return $this->softbank;
        } elseif ($GLOBALS['__Framework']['ktai_carrier']== 'willcom'){
            return $this->docomo;                   //Willcom端末はドコモと同じフォーマット
        } elseif ($GLOBALS['__Framework']['ktai_carrier']== 'emobile'){
            return $this->docomo;                   //emobile端末はドコモと同じフォーマット
        }
        return "　";
    }
}

function emoji_entity_unescape($str, $amp_escaped = false)
{
    $amp = ($amp_escaped) ? '&amp;' : '&';
    $regexp = "/$amp" . "em_([^;]*);/";
    return preg_replace_callback($regexp, 'emoji_entity_unescape_callback', $str);
}

function emoji_entity_unescape_callback($matches)
{
    $emoji = array(
            'sun' => array('sun',pack('n',0xf89f),pack('n',0xf660),'Gj' ),
            'cloud' => array('cloud',pack('n',0xf8a0),pack('n',0xf665),'Gi' ),
            'rain' => array('rain',pack('n',0xf8a1),pack('n',0xf664),'Gk' ),
            'snowman' => array('snowman',pack('n',0xf8a2),pack('n',0xf65d),'Gh' ),
            'thunder' => array('thunder',pack('n',0xf8a3),pack('n',0xf65f),'E]' ),
            'typhoon' => array('typhoon',pack('n',0xf8a4),pack('n',0xf641),'Pc' ),
            'aries' => array('aries',pack('n',0xf8a7),pack('n',0xf667),'F_' ),
            'taurus' => array('taurus',pack('n',0xf8a8),pack('n',0xf668),'F`' ),
            'gemini' => array('gemini',pack('n',0xf8a9),pack('n',0xf669),'Fa' ),
            'cancer' => array('cancer',pack('n',0xf8aa),pack('n',0xf66a),'Fb' ),
            'leo' => array('leo',pack('n',0xf8ab),pack('n',0xf66b),'Fc' ),
            'virgo' => array('virgo',pack('n',0xf8ac),pack('n',0xf66c),'Fd' ),
            'libra' => array('libra',pack('n',0xf8ad),pack('n',0xf66d),'Fe' ),
            'scorpio' => array('scorpio',pack('n',0xf8ae),pack('n',0xf66e),'Ff' ),
            'sagittarius' => array('sagittarius',pack('n',0xf8af),pack('n',0xf66f),'Fg' ),
            'capricorn' => array('capricorn',pack('n',0xf8b0),pack('n',0xf670),'Fh' ),
            'aquarius' => array('aquarius',pack('n',0xf8b1),pack('n',0xf671),'Fi' ),
            'pisces' => array('pisces',pack('n',0xf8b2),pack('n',0xf672),'Fj' ),
            'parking' => array('parking',pack('n',0xf8cd),pack('n',0xf67e),pack('c*',0x1b,0x24,0x45,0x6f,0x0f) ),
            'house' => array('house',pack('n',0xf8c4),pack('n',0xf684),pack('c*',0x1b,0x24,0x47,0x56,0x0f) ),
            'camera' => array('camera',pack('n',0xf8e2),pack('n',0xf6ee),pack('c*',0x1b,0x24,0x47,0x28,0x0f) ),
            'book' => array('book',pack('n',0xf8e4),pack('n',0xf677),pack('c*',0x1b,0x24,0x45,0x68,0x0f) ),
            'telephone' => array('telephone',pack('n',0xf8e8),pack('n',0xf7b3),pack('c*',0x1b,0x24,0x47,0x29,0x0f) ),
            'present' => array('present',pack('n',0xf8e6),pack('n',0xf6a8),pack('c*',0x1b,0x24,0x45,0x32,0x0f) ),
            'foot' => array('foot',pack('n',0xf8f9),pack('n',0xf3eb),pack('c*',0x1b,0x24,0x51,0x56,0x0f) ),
            'mail' => array('mail',pack('n',0xf977),pack('n',0xf6fa),pack('c*',0x1b,0x24,0x45,0x23,0x0f) ),
            'key' => array('key',pack('n',0xf97d),pack('n',0xf6f2),pack('c*',0x1b,0x24,0x47,0x5f,0x0f) ),
            'search' => array('search',pack('n',0xf981),pack('n',0xf6f1),pack('c*',0x1b,0x24,0x45,0x34,0x0f) ),
            'new' => array('new',pack('n',0xf982),pack('n',0xf7e5),pack('c*',0x1b,0x24,0x46,0x32,0x0f) ),
            'pen' => array('pen',pack('n',0xf952),pack('n',0xf679),pack('c*',0x1b,0x24,0x4F,0x21,0x0f) ),
            '1square' => array('1square',pack('n',0xf987),pack('n',0xf6fb),pack('c*',0x1b,0x24,0x46,0x3c,0x0f) ),
            '2square' => array('2square',pack('n',0xf988),pack('n',0xf6fc),pack('c*',0x1b,0x24,0x46,0x3d,0x0f) ),
            '3square' => array('3square',pack('n',0xf989),pack('n',0xf740),pack('c*',0x1b,0x24,0x46,0x3e,0x0f) ),
            '4square' => array('4square',pack('n',0xf98A),pack('n',0xf741),pack('c*',0x1b,0x24,0x46,0x3f,0x0f) ),
            '5square' => array('5square',pack('n',0xf98B),pack('n',0xf742),pack('c*',0x1b,0x24,0x46,0x40,0x0f) ),
            '6square' => array('6square',pack('n',0xf98C),pack('n',0xf743),pack('c*',0x1b,0x24,0x46,0x41,0x0f) ),
            '7square' => array('7square',pack('n',0xf98D),pack('n',0xf744),pack('c*',0x1b,0x24,0x46,0x42,0x0f) ),
            '8square' => array('8square',pack('n',0xf98E),pack('n',0xf745),pack('c*',0x1b,0x24,0x46,0x43,0x0f) ),
            '9square' => array('9square',pack('n',0xf98F),pack('n',0xf746),pack('c*',0x1b,0x24,0x46,0x44,0x0f) ),
            '0square' => array('0square',pack('n',0xf990),pack('n',0xf7c9),pack('c*',0x1b,0x24,0x46,0x45,0x0f) ),
            'heart' => array('heart',pack('n',0xf991),pack('n',0xf7b2),pack('c*',0x1b,0x24,0x47,0x29,0x0f) ),
            'crown' => array('crown',pack('n',0xf9bf),pack('n',0xf7f9),pack('c*',0x1b,0x24,0x45,0x2e,0x0f) ),
            'wrench' => array('wrench',pack('n',0xf9bd),pack('n',0xf7a4),pack('c*',0x1b,0x24,0x45,0x36,0x0f) ),
            'ticket' => array('ticket',pack('n',0xf8df),pack('n',0xf676),pack('c*',0x1b,0x24,0x45,0x45,0x0f) ),
            'birthday' => array('birthday',pack('n',0xf8e7),pack('n',0xf7bd),pack('c*',0x1b,0x24,0x4f,0x6b,0x0f) ),
            'bulb' => array('bulb',pack('n',0xf9a0),pack('n',0xf64e),pack('c*',0x1b,0x24,0x45,0x2f,0x0f) ),
            'memo' => array('memo',pack('n',0xf8ea),pack('n',0xf365),pack('c*',0x1b,0x24,0x4f,0x21,0x0f) ),
            'face_goody' => array('face_goody',pack('n',0xf995),pack('n',0xf649),pack('c*',0x1b,0x24,0x47,0x76,0x0f) ),
            'face_wink' => array('face_wink',pack('n',0xf9ce),pack('n',0xf7f3),pack('c*',0x1b,0x24,0x50,0x25,0x0f) ),
            'tennis' => array('tennis',pack('n',0xf8b6),pack('n',0xf690),pack('c*',0x1b,0x24,0x47,0x35,0x0f) ),
            'thumbs_up' => array('thumbs_up',pack('n',0xf9cc),pack('n',0xf6d2),pack('c*',0x1b,0x24,0x47,0x2e,0x0f) ),
            'dollar' => array('dollar',pack('n',0xf9ba),pack('n',0xf796),pack('c*',0x1b,0x24,0x45,0x4f,0x0f) ),
            'ktai' => array('ktai',pack('n',0xf8e9),pack('n',0xf7a5),'G*'),
            'pc' => array('pc',pack('n',0xf9bb),pack('n',0xf7e8),'G,'),
    );

    $entity = new emoji_entity($emoji[$matches[1]]);

    if ( $entity != null ){
        return $entity->get();
    } else {
        return $matches[1];
    }
}

?>
