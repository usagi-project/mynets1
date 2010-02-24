<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 *
 * @category
 * @package    Session Class
 * @author     KUNIHARU Tsujioka <kunitsuji@gmail.com>
 * @copyright  Copyright (c) 2008 KUNIHARU Tsujioka <kunitsuji@gmail.com>
 * @copyright  Copyright (c) 2006-2008 Usagi Project (URL:http://usagi-project.org)
 * @license    New BSD License
 */


class Convertnext extends Controller
{

    function Convertnext()
    {
        parent::Controller();
    }
    function index()
    {
        $this->load->helper('form');
        $this->load->library('session');
        $this->session->start();

        $this->username  = $this->session->get('username');
        $this->password  = $this->session->get('password');
        $this->dbname    = $this->session->get('dbname');
        $this->hostname  = $this->session->get('hostname');
        $this->dbprefix  = $this->session->get('dbprefix');

        $db['hostname'] = $this->hostname;
        $db['username'] = $this->username;
        $db['password'] = $this->password;
        $db['database'] = $this->dbname;
        $db['dbdriver'] = "mysql";
        $db['dbprefix'] = $this->dbprefix;
        $db['pconnect'] = false;
        $db['db_debug'] = false;
        $db['char_set'] = "utf8";
        $db['dbcollat'] = "utf8_general_ci";

        if (!defined('MYNETS_PREFIX_NAME'))
        {
            define('MYNETS_PREFIX_NAME', $this->dbprefix);
        }

        $submit = $this->input->post('submit');
        $this->load->model('mynet_converter', '', $db);

        $vData = array(
                'header'   => 'header/header.html',
                'footer'   => 'header/footer.html',
        );

        $file_path = OPENPNE_DIR . '/var/tmp';
        //PNEからMyNETS、足跡集計及びc_memberへの追加処理
        if ($this->input->post('view_count') == '1' && $this->input->post('is_pne') == '1')
        {
            if (file_exists($file_path . '/ashiato_count_update.txt'))
            {
                log_message('debug', "setViewCount() no convert");
            }
            else
            {
                $this->mynet_converter->setViewCount();
                //実行履歴ファイルを作成する
                $fp = fopen($file_path . '/ashiato_count_update.txt', 'w+');
                fwrite($fp, date(time()));
                fclose($fp);
                log_message('debug', "setViewCount() finished");
            }
        }
        else
        {
            log_message('debug', "setViewCount() convert skip");
        }

        switch ($this->input->post('pne_ver'))
        {
            case 'PNE2.8':
            default:
                //絵文字コンバート
                //$this->mynet_converter->emojiConvert();
                break;
            case 'PNE2.10':
                //なし

                break;
        }
        $this->load->view('convertnext.html', $vData);
    }

}
?>
