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
 * @copyright  Copyright (c) 2006-2008 Usagi Project (URL:http://usagi.mynets.jp)
 * @license    New BSD License
 */

class Convert extends Controller
{
    var $hostname;
    var $username;
    var $password;
    var $dbname;
    var $dbprefox;

    function Convert()
    {
        parent::Controller();
    }

    function index()
    {
        if (strpos($this->input->post('submit'), 'MyNETS') !== FALSE)
        {
            $convert_flag = 'mynets';
        }
        else
        {
            $convert_flag = 'pne';
        }
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

        $submit = $this->input->post('submit');
        $this->load->model('mynet_converter', '', $db);

        $vData = array(
                'header'   => 'header/header.html',
                'footer'   => 'header/footer.html',
                'errmsg'   => '',
        );

        $is_pne = 0;

        if ($convert_flag === 'mynets')
        {
            log_message('debug', "MyNETS database VersionUP started");
            //テーブルの削除
            $this->mynet_converter->dropTable();
            log_message('debug', "dropTable() finished");
            //新規テーブルの追加
            $this->mynet_converter->addTable();
            log_message('debug', "addTable() finished");
            //カラムの修正を実施 2008-08-28先に追加をしておく
            $this->mynet_converter->addColumns();
            log_message('debug', "addColumns() finished");
            $this->mynet_converter->modifyColumns();
            log_message('debug', "modifyColumns() finished");
            //インデックスの追加等の実施
            $this->mynet_converter->addIndex();
            log_message('debug', "addIndex() finished");
            //データの追加処理
            $this->mynet_converter->addInsertData();
            log_message('debug', "addInsertData() finished");
            //データのアップデート処理
            $this->mynet_converter->updateTableData();
            log_message('debug', "updateTableData() finished");
            //完了した内容を、c_versionへ記述する
            $this->mynet_converter->updateMyNETSVersion($this->mynet_converter->mynetsversion);
            log_message('debug', "updateMyNETSVersion() finished");

            //エラー結果を取得
            $errmsg = $this->mynet_converter->getError();
            $vData['errmsg'] = $errmsg;

            //エラーがない場合、データコンバートを実施する
            if (!$errmsg)
            {
                log_message('debug', "MyNETS data convertion started");
                //トピックのe_datetimeカラム追加に対して最新日付を調整する
                $file_path = OPENPNE_DIR . '/var/tmp';
                if (file_exists($file_path . '/topic_edatetime_update.txt'))
                {
                    log_message('debug', "setTopiUpdate() no convert");
                }
                else
                {
                    //$this->session->set('topic_edatetime', 'OK');
                    $this->mynet_converter->setTopiUpdate();
                    //実行履歴ファイルを作成する
                    $fp = fopen($file_path . '/topic_edatetime_update.txt', 'w+');
                    fwrite($fp, date(time()));
                    fclose($fp);
                    log_message('debug', "setTopiUpdate() finished");
                }
                //Ver1.0.1から1.1.0へ以降した際のコメント番号の集計、更新
                if (file_exists($file_path . '/diary_commentno_update.txt'))
                {
                    log_message('debug', "setTopiUpdate() no convert");
                }
                else
                {
                    //$this->session->set('topic_edatetime', 'OK');
                    $this->mynet_converter->setDiaryCommentNo();
                    //実行履歴ファイルを作成する
                    $fp = fopen($file_path . '/diary_commentno_update.txt', 'w+');
                    fwrite($fp, date(time()));
                    fclose($fp);
                    log_message('debug', "setDiaryCommentNo() finished");
                }
                //c_imageテーブルにc_member_idの値を取り込む
                $this->mynet_converter->setIdImageTable();
            }
        }
        else if ($convert_flag === 'pne')
        {
            log_message('debug', "OpenPNE database Convert started");
            $is_pne = 1;
            //テーブルの削除
            $this->mynet_converter->dropTable();
            log_message('debug', "dropTable() finished");
            //新規テーブルの追加
            $this->mynet_converter->addTable();
            log_message('debug', "addTable() finished");
            //カラムの修正を実施
            $this->mynet_converter->modifyColumns();
            log_message('debug', "modifyColumns() finished");
            $this->mynet_converter->addColumns();
            log_message('debug', "dropColumns() finished");
            //インデックスの追加等の実施
            $this->mynet_converter->addIndex();
            log_message('debug', "addIndex() finished");
            //データの追加処理
            $this->mynet_converter->addInsertData();
            log_message('debug', "addInsertData() finished");
            //データのアップデート処理
            $this->mynet_converter->updateTableData();
            log_message('debug', "updateTableData() finished");
            //完了した内容を、c_versionへ記述する
            $this->mynet_converter->updateMyNETSVersion($this->mynet_converter->mynetsversion);
            log_message('debug', "updateMyNETSVersion() finished");

            //エラー結果を取得
            $errmsg = $this->mynet_converter->getError();
            $vData['errmsg'] = $errmsg;

            //エラーがない場合、データコンバートを実施する
            if (!$errmsg)
            {
                log_message('debug', "MyNETS data convertion started");
                //トピックのe_datetimeカラム追加に対して最新日付を調整する
                $file_path = OPENPNE_DIR . '/var/tmp';
                if (file_exists($file_path . '/topic_edatetime_update.txt'))
                {
                    log_message('debug', "setTopiUpdate() no convert");
                }
                else
                {
                    //$this->session->set('topic_edatetime', 'OK');
                    $this->mynet_converter->setTopiUpdate();
                    //実行履歴ファイルを作成する
                    $fp = fopen($file_path . '/topic_edatetime_update.txt', 'w+');
                    fwrite($fp, date(time()));
                    fclose($fp);
                    log_message('debug', "setTopiUpdate() finished");
                }
                //Ver1.0.1から1.1.0へ以降した際のコメント番号の集計、更新
                if (file_exists($file_path . '/diary_commentno_update.txt'))
                {
                    log_message('debug', "setTopiUpdate() no convert");
                }
                else
                {
                    //$this->session->set('topic_edatetime', 'OK');
                    $this->mynet_converter->setDiaryCommentNo();
                    //実行履歴ファイルを作成する
                    $fp = fopen($file_path . '/diary_commentno_update.txt', 'w+');
                    fwrite($fp, date(time()));
                    fclose($fp);
                    log_message('debug', "setDiaryCommentNo() finished");
                }
                //PNEからMyNETS、diaryコメント集計及びc_diary/comment_countへの集計値移動処理
                if (file_exists($file_path . '/diary_commentcount_update.txt'))
                {
                    log_message('debug', "setDiaryCommentCount() no convert");
                }
                else
                {
                    //$this->session->set('topic_edatetime', 'OK');
                    $this->mynet_converter->setDiaryCommentCount();
                    //実行履歴ファイルを作成する
                    $fp = fopen($file_path . '/diary_commentcount_update.txt', 'w+');
                    fwrite($fp, date(time()));
                    fclose($fp);
                    log_message('debug', "setDiaryCommentCount() finished");
                }
                //c_imageテーブルにc_member_idの値を取り込む
                $this->mynet_converter->setIdImageTable();
            }

        }
        else        //error?
        {

        }

        $options = array(
                    'OpenPNE Ver2.10.X未満から'  => 'PNE2.8',
                    'OpenPNE Ver2.10.Xよりあと'  => 'PNE2.10',
                );

        $vData['options'] = $options;
        $vData['is_pne']  = $is_pne;
        $this->load->view('convert.html', $vData);
    }

}
?>
