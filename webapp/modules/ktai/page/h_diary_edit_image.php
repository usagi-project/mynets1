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

class ktai_page_h_diary_edit_image extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $target_c_diary_id = $requests['target_c_diary_id'];

        //日記
        $c_diary = db_diary_get_c_diary4id($target_c_diary_id);

        //権限チェック
        if ($c_diary['c_member_id'] != $u) {
            handle_kengen_error();
        }

        //写真リスト
        $image_list = array();
        for ($i=1; $i<4; $i++) {
            $image_list[$i]['number'] = $i;
            if (MAIL_ADDRESS_HASHED) {
                $mail_address = "dpic{$target_c_diary_id}-$i-".t_get_user_hash($u)."@".MAIL_SERVER_DOMAIN;
            } else {
                $mail_address = "dpic{$target_c_diary_id}-$i"."@".MAIL_SERVER_DOMAIN;
            }
            $mail_address = urlencode(MAIL_ADDRESS_PREFIX) . $mail_address;
            $image_list[$i]['mail_address'] = $mail_address;
            $image_list[$i]['image_filename'] = $c_diary['image_filename_' . $i];
        }

        //Smarty変数をセット
        $this->set('image_list', $image_list);
        $this->set('target_c_diary_id', $target_c_diary_id);

        return 'success';
    }
}

?>
