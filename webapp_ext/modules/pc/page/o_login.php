<?php
/* ========================================================================
 *
 * @license This source file is subject to version 3.01 of the PHP license,
 *              that is available at http://www.php.net/license/3_01.txt
 *              If you did not receive a copy of the PHP license and are unable
 *              to obtain it through the world-wide-web, please send a note to
 *              license@php.net so we can mail you a copy immediately.
 *
 * @category   MyNETS
 * @project    UsagiProject 2006-2008
 * @package    Login
 * @author     kuniharu tsujioka <author@example.com>
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  kuniharu tsujioka
 * @copyright  2006-2008 UsagiProject <author member ad  http://usagi.mynets.jp/member.html>
 * @version    1.2.0Nighty
 * @chengelog
 * ========================================================================
 */

require_once OPENPNE_WEBAPP_DIR ."/components/login.class.php";
require_once OPENPNE_WEBAPP_DIR . '/components/one_word.class.php';
require_once OPENPNE_WEBAPP_DIR . '/components/information/information.class.php';

class pc_page_o_login extends OpenPNE_Action
{
    /**
     * 認証を行わない
     */
    function isSecure()
    {
        return false;
    }
    /**
     * [[機能説明]]
     *
     * @access  public
     */
    function execute($requests)
    {
        //=======================================
        //request parameters get
        //=======================================
        //ここでリクエストパラメータを取得する

        $login_params = $requests['login_params'];
        //=======================================
        //logic block
        //=======================================
        //ここでビジネスロジックを記述する
        if (! CUSTUM_LOGIN_URL)
        {
            if (LOGIN_URL_PC && !DISPLAY_LOGIN)
            {
                client_redirect_absolute(LOGIN_URL_PC);
            }

            //---- inc_ テンプレート用 変数 ----//
            $this->set('inc_page_header', fetch_inc_page_header('public'));
            $this->set('INC_PAGE_HEADER', db_banner_get_top_banner(false));
            $this->set('IS_CLOSED_SNS', IS_CLOSED_SNS);
            $this->set('top_banner_html_before', p_common_c_siteadmin4target_pagename('top_banner_html_before'));
            $this->set('top_banner_html_after', p_common_c_siteadmin4target_pagename('top_banner_html_after'));

            $this->set('inc_page_footer',
                p_common_c_siteadmin4target_pagename('inc_page_footer_before'));
            $resource_name = 'o_login.tpl';
            $view =& $this->getView();
            $view->template_dir = OPENPNE_MODULES_DIR . '/pc/templates/';
            $view->display($resource_name);
            exit;

        }
        else
        {
            if (LOGIN_URL_PC && !DISPLAY_LOGIN) {
                client_redirect_absolute(LOGIN_URL_PC);
            }

            //外部公開日記を取得する
            $openData = new Login_View();
            $diary_list = $openData->getOpenDiary();
            $commu_list = $openData->getOpenCommu();
            $topic_list = $openData->getOpenTopic();
            $event_list = $openData->getOpenEvent();
            $css        = $openData->getCustumCss();
            //メンバーの一言を取得する
            $oneword     = new OneWord();
            $other_word = $oneword->getList();
            //サイトニュースを取得する
            $sitenews = new Information();
            $newslist = $sitenews->getList(1, 5);

            //print_r($newslist);
            //exit;
            //=======================================
            //template assign block
            //=======================================
            //ここでテンプレートへ変数をセットする
            //$this->set('[[パラメータ名]]', [[セットするパラメータ変数]]);
            $this->set('diary_list', $diary_list);
            $this->set('commu_list', $commu_list);
            $this->set('topic_list', $topic_list);
            $this->set('event_list', $event_list);

            $this->set('other_word', $other_word);
            $this->set('newslist', $newslist);
            return 'success';
        }
    }
}
?>
