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

//include_once OPENPNE_WEBAPP_DIR . '/lib/OpenPNE/KtaiEmoji.php'

ini_set('display_errors', true);
class Mynet_converter extends Model
{

    /**
     * @var DBバージョンを保持
     *
     * @access  private
     */
    var $dbversion;

    /**
     * @var MyNETSテーブル一覧情報を保持
     *
     * @access  private
     */
    var $tablelist;

    /**
     * @var テーブル更新でのADDを行う情報を保持
     *
     * @access  private
     */
    var $tableaddlist;

    /**
     * @var テーブルを削除する情報を保持
     *
     * @access  private
     */
    var $tabledroplist;

    /**
     * @var テーブルの更新するカラム情報を保持
     *
     * @access  private
     */
    var $tablecolumnlist;

    /**
     * @var テーブルの更新するINDEX情報を保持
     *
     * @access  private
     */
    var $tableindexlist;

    /**
     * @var 追加するレコード情報を保持
     *
     * @access  private
     */
    var $tableinsertlist;

    /**
     * @var 強制追加するレコード情報を保持
     *
     * @access  private
     */
    var $runinsertsql;

    /**
     * @var レコードを更新する情報を保持
     *
     * @access  private
     */
    var $tableupdatelist;

    /**
     * @var DB内のテーブル情報を保持
     *
     * @access  private
     */
    var $dbtables;

    /**
     * @var DB内のテーブルのカラム情報を保持
     *
     * @access  private
     */
    var $tablecolumns;

    /**
     * @var エラーの情報を保持する
     *
     * @access  private
     */
    var $sqlerrmsg = array();
    var $sqlerrflg = FALSE;

    /**
     * コンストラクタ　テーブル名一覧を取得する
     * @param $dbh DB接続ID
     * @param string $version バージョン情報
     */
    function Mynet_converter()
    {
        parent::Model();
        $version = 'v1.2.0';
        $this->mynetsversion = MYNETS_VERSION;
        include_once(APPPATH.'data/tableadd-' . $version . '.php');
        include_once(APPPATH.'data/tablecolumn-' . $version . '.php');
        include_once(APPPATH.'data/tabledrop-' . $version . '.php');
        include_once(APPPATH.'data/tableindex-' . $version . '.php');
        include_once(APPPATH.'data/tableinfo-' . $version . '.php');
        include_once(APPPATH.'data/tableinsertdata-' . $version . '.php');
        include_once(APPPATH.'data/tableupdatedata-' . $version . '.php');

        //テーブル情報が記載されているファイル名を取得する
        $this->tablelist       = $tablelist;
        $this->tableaddlist    = $tableaddlist;
        $this->tabledroplist   = $tabledroplist;
        $this->tablecolumnlist = $tablecolumnlist;
        $this->tableindexlist  = $tableindexlist;
        $this->tableinsertlist = $tableinsertdatalist;
        $this->tableupdatelist = $tableupdatedatalist;
        $this->runinsertsql    = $runinsertsql;
        $this->dbversion = $this->db->version();
    }

    /**
     * MyNETSのテーブル一覧を返却
     *
     * @return  array  テーブル一覧情報
     * @access  public
     */
    function getTableList()
    {
        return $this->tablelist;
    }

    /**
     * 新しく追加するテーブルリストを返却
     *
     * @return  array  テーブル情報
     * @access  public
     */
    function getAddTableList()
    {
        return $this->tableaddlist;
    }

    /**
     * 新しく強制追加するレコードリストを返却
     *
     * @return  array  テーブル情報
     * @access  public
     */
    function getRunSql()
    {
        return $this->runinsertsql;
    }

    /**
     * 削除するテーブル一覧を返却
     *
     * @return  array  テーブル情報
     * @access  public
     */
    function getDropTableList()
    {
        return $this->tabledroplist;
    }

    /**
     * 更新するカラム情報を返却
     *
     * @return  array  カラム情報
     * @access  public
     */
    function getModifyColumnList()
    {
        $table = $this->tablecolumnlist;
        $modifylist = array();
        foreach ($table as $key => $value) {
            if ($value['action'] == "MODIFY COLUMN") {
                $modifylist[] = $value['data'];
            }
        }
        return $modifylist;
    }

    /**
     * 追加するカラム情報を返却
     *
     * @return  array  カラム情報
     * @access  public
     */
    function getAddColumnList()
    {
        $table = $this->tablecolumnlist;
        $addlist = array();
        foreach ($table as $key => $value) {
            if ($value['action'] == "ADD COLUMN") {
                $addlist[] = $value['data'];
            }
        }
        return $addlist;
    }

    /**
     * 更新するINDEX情報を返却
     *
     * @return  array  INDEX情報
     * @access  public
     */
    function getAddIndexList()
    {
        $index = $this->tableindexlist;
        $addlist = array();
        foreach ($index as $key => $value) {
            if ($value['action'] == "ADD INDEX") {
                $addlist[] = $value['data'];
            }
        }
        return $addlist;
    }

    /**
     * 新規追加するレコード情報を返却
     *
     * @return  array  新規レコード情報
     * @access  public
     */
    function getInsertDataList()
    {
        $insertdata = $this->tableinsertlist;
        $addlist = array();
        foreach ($insertdata as $key => $value) {
            if ($value['action'] == "INSERT INTO") {
                $addlist[] = $value['data'];
            }
        }
        return $addlist;
    }

    /**
     * 更新するレコード情報を返却
     *
     * @return  array  レコード情報
     * @access  public
     */
    function getUpdateDataList()
    {
        $updatedata = $this->tableupdatelist;
        $addlist = array();
        foreach ($updatedata as $key => $value) {
            if ($value['action'] == "UPDATE") {
                $addlist[] = $value['data'];
            }
        }
        return $addlist;
    }

    /**
     * DSN情報をセット
     *
     * @param   array  DSN情報
     * @access  public
     */
    function setDsn($dsn)
    {
        $this->dsn = $dsn;
    }

    /**
     * MySQLでのエンジン情報を返却
     *
     * @retunr  string  エンジンタイプの文字列（SQLに追加して使用）
     * @access  public
     */
    function getEngine()
    {
        $version = explode('.', $this->dbversion);
        if ($version[0] == '5' || ($version[0] == '4' && $version[1] == '1'))
        {
            $engine = ' ENGINE=MyISAM DEFAULT CHARSET=utf8;';
        }
        else
        {
            $engine = ' TYPE=MyISAM;';
        }
        return $engine;
    }

    /**
     * DB内のテーブル情報を格納
     *
     * @access  public
     */
    function getDbTables()
    {
        $this->dbtables = $this->db->list_tables();
    }

    /**
     * SQL実行エラー情報を返す
     *
     * @access  public
     */
    function getError()
    {
        return $this->sqlerrmsg;
    }

    /**
     * テーブル内のカラム情報を格納
     *
     * @param   string  テーブル名
     * @access  public
     */
    /*
    function getTableColumns($table)
    {
        $result = $this->dbh->MetaColumnNames($table);
        if ($this->dbh->errorMsg()) {
            $this->tablecolumns = null;
            echo $this->dbh->errorMsg() . "<BR>";
        } else {
            $this->tablecolumns = $result;
        }
    }
    */

    /**
     * テーブルの存在確認
     *
     * @param   string  テーブル名
     * @return  bool True|False
     * @access  public
     */
    function hasTable($tablename)
    {
        /*
        $this->getDbTables();
        if (in_array($tablename, $this->dbtables)) {
            return true;
        } else {
            return false;
        }
        */
        return $this->db->table_exists($tablename);
    }

    /**
     * テーブル内に指定のデータがあるかどうか
     *
     * @param   string  テーブル名
     * @param   string  カラム名
     * @param   string  カラム内のデータ名
     * @return  bool True|False
     * @access  public
     */
    function hasTableData($tablename, $columnname, $columndata)
    {
        $sql = "SELECT "
                    . "count(*) as count "
             . "FROM "
                    . MYNETS_PREFIX_NAME . $tablename. " "
             . "WHERE "
                    . $columnname . " = ? ";
        $params = array($columndata);
        $result = $this->db->query($sql, $params);
        if ($result) {
            $row = $result->row();
            if ($row->count >= 1)
            {
                return true;
            }
            else
            {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * テーブル内に指定のカラムがあるかどうか
     *
     * @param   string  テーブル名
     * @param   string  カラム名
     * @return  bool True|False
     * @access  public
     */
    function hasColumn($tablename, $columnname)
    {
        //return $this->db->field_exists($columnname, $tablename);
        $fields = $this->get_table_type($tablename);
        $flag = 0;
        foreach ($fields as $field)
        {
            if ($field->name == $columnname)
            {
                $flag ++;
            }
        }
        return (bool)$flag;
    }

    /**
     * 追加テーブル処理
     *
     * @access  public
     */
    function addTable()
    {
        $addlist = $this->getAddTableList();
        if ($addlist) {
            foreach ($addlist as $key => $value) {
                $result = $this->db->query($value['sql'] . $this->getEngine());
                if (!$result) {
                    $this->sqlerrmsg[] = 'テーブル追加実行エラー:'.$key." = ".$value['sql'];
                }
            }
        }
        $runlist = $this->getRunSql();
        if ($runlist)
        {
            foreach ($runlist as $value) {
                $result = $this->db->query($value);
                if (!$result) {
                    $this->sqlerrmsg[] = 'テーブル追加実行エラー:'.$value['sql'];
                }
            }
        }
    }

    /**
     * 削除テーブル処理
     *
     * @access  public
     */
    function dropTable()
    {
        $droplist = $this->getDropTableList();
        if ($droplist) {
            foreach ($droplist as $key => $value) {
                $result = $this->db->query($value['sql']);
                if (!$result) {
                    $this->sqlerrmsg[] = 'テーブル削除実行エラー:'.$key." = ".$value['sql'];
                }
            }
        }
    }

    /**
     * カラム修正処理
     *
     * @access  public
     */
    function modifyColumns()
    {
        $modifylist = $this->getModifyColumnList();
        if ($modifylist) {
            foreach ($modifylist as $value)
            {
                //2008-10-28 KUNIHARU Tsujioka update
                //一部c_diaryのe_datetimeでdate型になっているケースがある
                if ($this->hasColumn(MYNETS_PREFIX_NAME.$value['name'], $value['column']))
                {
                    //c_diaryのe_datetimeを調査
                    if ($value['name'] === 'c_diary')
                    {
                        $fields = $this->get_table_type(MYNETS_PREFIX_NAME.$value['name']);
                        foreach ($fields as $field)
                        {
                            if ($field->name == 'e_datetime')
                            {
                                if ($field->type == 'date')
                                {
                                    $this->db->query($value['sql']);
                                }
                            }
                        }
                    }
                    else
                    {
                        $this->db->query($value['sql']);
                    }
                } else {
                    $this->sqlerrmsg[] = $value['sql'].":更新するはずのカラムがありません！";
                }
            }
        }
    }

    /**
     * テーブル内のカラム情報を格納
     *
     * @param   string  テーブル名
     * @access  public
     */
    function get_table_type($table)
    {
        return $this->db->field_data($table);
    }

    /**
     * カラム追加処理
     *
     * @access  public
     */
    function addColumns()
    {
        $addlist = $this->getAddColumnList();
        if ($addlist) {
            foreach ($addlist as $value) {
                //テーブルが存在しているかどうかをチェック
                if (!$this->hasTable(MYNETS_PREFIX_NAME.$value['name'])) {
                    $this->sqlerrmsg[] = $value['name']. " not exists this DB";
                    continue;
                }
                //現在のテーブルにそのカラムがあるかどうかを確認する
                if ($this->hasColumn(MYNETS_PREFIX_NAME.$value['name'], $value['column']))
                {
                    //echo "skip -- " . $value['column'] . " add column <br>";
                } else {
                    //echo "no column<BR>";
                    //ADD COLUMNを実行する
                    if ($query = $this->db->query($value['sql'])) {
                        //echo "OK -- " . $value['sql'] . " add column <br>";
                    } else {
                        $this->sqlerrmsg[] = $value['name'].":".$value['column'].":カラム追加エラー";
                    }
                }
            }
        } else {
            //echo "db error ";
        }
    }

    /**
     * INDEX設定処理
     * ※既にある場合はエラーで処理をしない
     * @access  public
     */
    function addIndex()
    {
        $addlist = $this->getAddIndexList();
        if ($addlist) {
            foreach ($addlist as $value) {
                //echo $value['sql']."<BR>";
                if (! $result = $this->db->query($value['sql']))
                {
                    //$this->sqlerrmsg[] = $value['sql']. ":INDEX追加エラー";
                }
            }
        }
    }

    /**
     * 追加レコード処理
     *
     * @access  public
     */
    function addInsertData()
    {
        $addlist = $this->getInsertDataList();
        if ($addlist) {
            foreach ($addlist as $value) {
                //現在のテーブルにそのデータがあるかどうかを判定
                if (!$this->hasTableData($value['name'],
                                        $value['columnname'],
                                        $value['columndata'])) {

                    $result = $this->db->query($value['sql']);
                    if (!$result) {
                        $this->sqlerrmsg[] = $value['name'].":".$value['columndata'].":データ追加エラー";
                    }
                }
            }
        }
    }

    /**
     * 更新レコード処理
     *
     * @access  public
     */
    function updateTableData()
    {
        $updatelist = $this->getUpdateDataList();
        if ($updatelist) {
            foreach ($updatelist as $value) {
                //現在のテーブルにそのデータがあるかどうかを判定
                //if (!$this->chkTableData($value['name'], $value['columnname'], $value['columndata'])) {

                    $result = $this->db->query($value['sql']);
                    if (!$result)
                    {
                        $this->sqlerrmsg[] = $value['sql'].":データ更新エラー";
                    }
                //} else {
                //    echo $value['name']." has ".$value['columnname']."=".$value['columndata']."<br>";
                //}
            }
        }
    }

    /**
     * バージョン名追記処理
     *
     * @access  public
     */
    function updateMyNETSVersion($strVersion)
    {
        $oldv = '';
        $sql = "SELECT new_version_name FROM `".MYNETS_PREFIX_NAME."c_version` "
                . "ORDER BY r_datetime DESC ";
        $result = $this->db->query($sql);
        if ($result->num_rows() > 0)
        {
            $row  = $result->row();
            $oldv = $row->new_version_name;
        }
        //echo $result;
        $sql = "INSERT INTO `".MYNETS_PREFIX_NAME."c_version` "
                    . "(old_version_name,new_version_name,r_datetime) "
                    . "values ("
                    . "?,?,? ) ";
        $date = date('Y-m-d H:i:s');
        $params = array(strval($oldv), $strVersion, $date);
        if (!$this->db->query($sql, $params)) {
            $this->sqlerrmsg[] = "Version番号更新時実行エラー";
        } else {
            return true;
        }
    }

    function runCreateSql($sqlfile)
    {
        $rst = file_get_contents($sqlfile);
        $new_sql = explode(";", $rst);
        $arrsql = array();
        foreach($new_sql as $value) {
            if (trim($value)) {
                $sql = str_replace('CREATE TABLE IF NOT EXISTS `',
                                    'CREATE TABLE IF NOT EXISTS `'.MYNETS_PREFIX_NAME,
                                    $value);
                $arrsql[] = $sql.$this->getEngine();
                //echo $value.$tableinfo->getEngine();
                if (!$this->db->query($sql.$this->getEngine()))
                {
                    $this->sqlerrmsg[] = $sql.$this->getEngine().":SQL実行エラー";
                }
            }
        }
    }
    function runSql($sqlfile)
    {
        $strSql = "";
        $file = @fopen($sqlfile, "r");
        @flock($file, LOCK_EX);
        while ($sql_files = @fgets($file, 10240)) {
            $sql_files = trim($sql_files);
            if ( $sql_files[0] == '#' ) {
                continue;
            }
            if ( strpos($sql_files, '--') === 0) {
                continue;
            }
            if ( $sql_files[0] == '' ) {
                continue;
            }

            //str_replaceでprefix対応
            if ( $sql_files[strlen($sql_files)-1] == ';' ) {
                $strSql .= str_replace('INSERT INTO `',
                                        'INSERT INTO `'.MYNETS_PREFIX_NAME,
                                        (str_replace('DRPOP TABLE IF EXISTS `',
                                                    'DRPOP TABLE IF EXISTS `'.MYNETS_PREFIX_NAME,
                                                    $sql_files)
                                         )
                                      );
            } else {
                $strSql .= str_replace('INSERT INTO `',
                                        'INSERT INTO `'.MYNETS_PREFIX_NAME,
                                        (str_replace('DRPOP TABLE IF EXISTS `',
                                                    'DRPOP TABLE IF EXISTS `'.MYNETS_PREFIX_NAME,
                                                    $sql_files)
                                         )
                                     );
                continue;
            }

            if (!$this->db->query($strSql))
            {
                $this->sqlerrmsg[] = $strSql.":SQL実行エラー";
            }
            $strSql = "";
        }
        @flock($file, LOCK_UN);
        @fclose($file);
    }

    /**
     * 日記のコメント番号を調整する
     *
     * @access  public
     */
    function setDiaryCommentNo()
    {
        $sql = "CREATE TABLE `convert_diary_commentno_tmp` (
    `c_diary_id` int(11) NOT NULL ,
    `comment_number` int(11) NOT NULL auto_increment,
    `c_diary_comment_id` int(11) NOT NULL,
    primary key (`c_diary_id`,`comment_number`)
)";
        $this->db->query($sql);
        //コメント番号をAUTO_INCREMENTでインサート
        $sql = "insert into convert_diary_commentno_tmp select c_diary_id,0,c_diary_comment_id from ".MYNETS_PREFIX_NAME."c_diary_comment order by r_datetime ";
        $this->db->query($sql);
        //日記コメントデータにコメント日付を更新
        $sql = "update `".MYNETS_PREFIX_NAME."c_diary_comment` as c,
`convert_diary_commentno_tmp` as t  set c.comment_number = t.comment_number
where c.c_diary_comment_id = t.c_diary_comment_id ";
        $this->db->query($sql);
        $sql = "DROP TABLE convert_diary_commentno_tmp";
        $this->db->query($sql);
        $sql = "OPTIMIZE TABLE `".MYNETS_PREFIX_NAME."c_diary_comment` ";
        $this->db->query($sql);
        return ;
    }
    /**
     * 日記のコメント番号を調整する
     *
     * @access  private
     */
    /*
    function _setDiaryCommentNo($id)
    {
        $sql   = "SELECT * FROM ".MYNETS_PREFIX_NAME."c_diary_comment ";
        $sql  .= "WHERE c_diary_id = ".$id." ORDER BY r_datetime ";
        $query = $this->db->query($sql);
        $i = 1;
        if ($query)
        {
            foreach ($query->result() as $res) {
                $sql  = "UPDATE ".MYNETS_PREFIX_NAME."c_diary_comment SET comment_number = ".$i;
                $sql .= " WHERE c_diary_comment_id = ".intval($res->c_diary_comment_id);
                $this->db->query($sql);
                $i++;
            }
            $query->free_result();
        }
        return ;
    }
    */

    /**
     * 日記のコメント数を計算する
     *
     * @access  public
     */
    function setDiaryCommentCount()
    {
        $sql = "CREATE TABLE `convert_diary_commentno_max_tmp` (
    `c_diary_id` int(11) NOT NULL ,
    `comment_count` int(11) NOT NULL,
    `e_datetime` datetime
)";
        $this->db->query($sql);
        //コメント番号をAUTO_INCREMENTでインサート
        $sql = "insert into convert_diary_commentno_max_tmp select c_diary_id,max(comment_number),max(r_datetime) from ".MYNETS_PREFIX_NAME."c_diary_comment group by c_diary_id";
        $this->db->query($sql);
        //日記コメントデータにコメント日付を更新
        $sql = "update ".MYNETS_PREFIX_NAME."c_diary as c, convert_diary_commentno_max_tmp as t set c.comment_count = t.comment_count where c.c_diary_id = t.c_diary_id";
        $this->db->query($sql);
        $sql = "DROP TABLE convert_diary_commentno_max_tmp";
        $this->db->query($sql);
        $sql = "OPTIMIZE TABLE `".MYNETS_PREFIX_NAME."c_diary` ";
        $this->db->query($sql);
        return ;
    }

    /**
     * 足跡数を計算し、c_memberにデータを保持する
     * ※追加処理を実施するために、一度行うと整合性が取れなくなる可能性があるので
     * ※結果ファイルを保存し、以後その内容を確認し二度行わないように設定する必要あり。
     * @access  public
     */
    function setViewCount()
    {
        $sql = "CREATE TABLE `convert_ashiato_count_tmp` (
    `c_member_id` int(11) NOT NULL ,
    `ashiato_count` int(11) NOT NULL
)";
        $this->db->query($sql);
        //あしあと合計をインサート
        $sql = "insert into convert_ashiato_count_tmp select c_member_id_to,count(c_ashiato_id) from ".MYNETS_PREFIX_NAME."c_ashiato group by c_member_id_to";
        $this->db->query($sql);
        //合計値をc_meberテーブルに格納
        $sql = "update ".MYNETS_PREFIX_NAME."c_member as c, convert_ashiato_count_tmp as t set c.ashiato_count_log = c.ashiato_count_log + t.ashiato_count where c.c_member_id = t.c_member_id";
        $this->db->query($sql);
        $sql = "DROP TABLE convert_ashiato_count_tmp";
        $this->db->query($sql);
        $sql = "OPTIMIZE TABLE `".MYNETS_PREFIX_NAME."c_member` ";
        $this->db->query($sql);
        return ;
    }

    /**
     * トピックの更新日付を調整する
     *
     * @access  public
     */
    function setTopiUpdate()
    {
        $sql = "CREATE TABLE `convert_topic_edatetime_tmp` (
`id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
`c_commu_topic_id` INT( 11 ) NOT NULL DEFAULT '0',
`e_datetime` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
PRIMARY KEY ( `id` )
);";
        $this->db->query($sql);
        /*
        //テンポラリーテーブルを作成し、1行SQLでそれぞれ実行するように変更
        $loop_counter = ceil($total_num / $page_size);
        while ($i <= $loop_counter) {
            $sql = "SELECT * FROM ".MYNETS_PREFIX_NAME."c_commu_topic ORDER BY c_commu_topic_id  "
                    . "LIMIT ".($i-1) * $page_size.", ".$page_size;
            $query = $this->db->query($sql);
            if ($query)
            {
                foreach ($query->result() as $res) {
                    $this->_setTopiUpdate($res->c_commu_topic_id);
                }
                $query->free_result();
            }
            echo $i . "<br>";
            $i++;
        }
        */
        $sql = "insert into convert_topic_edatetime_tmp SELECT '', c.c_commu_topic_id, MAX(c.r_datetime) FROM `".MYNETS_PREFIX_NAME."c_commu_topic_comment` as c, `".MYNETS_PREFIX_NAME."c_commu_topic` as b WHERE c.c_commu_topic_id =
b.c_commu_topic_id GROUP BY c.c_commu_topic_id";
        $this->db->query($sql);
        //次にc_topic_idに日付を入れていく
        $sql = "update `".MYNETS_PREFIX_NAME."c_commu_topic` as c,
`convert_topic_edatetime_tmp` as t  set c.e_datetime = t.e_datetime
where c.c_commu_topic_id = t.c_commu_topic_id ";
        $this->db->query($sql);
        $sql = "DROP TABLE `".MYNETS_PREFIX_NAME."convert_topic_edatetime_tmp`";
        $this->db->query($sql);
        $sql = "OPTIMIZE TABLE `".MYNETS_PREFIX_NAME."c_commu_topic` ";
        $this->db->query($sql);
        return ;
    }
    /**
     * トピックの更新日付を調整する
     *
     * @access  private
     */
    /*
    function _setTopiUpdate($id)
    {
        $sql   = "SELECT MAX(r_datetime) as date FROM ".MYNETS_PREFIX_NAME."c_commu_topic_comment ";
        $sql  .= "WHERE c_commu_topic_id = ".$id;
        $query = $this->db->query($sql);
        $i = 1;
        if ($query)
        {
            $row  = $query->row();
            $date = $row->date;
            $sql = "UPDATE ".MYNETS_PREFIX_NAME."c_commu_topic SET e_datetime = '".$date ;
            $sql .= "' WHERE c_commu_topic_id = ".intval($id);
            $this->db->query($sql);
            $query->free_result();
        }
        return ;
    }
    */


    /**
     * c_imageテーブルにc_member_idをセットする
     *
     * @access  private
     */
    function setIdImageTable()
    {
        $sql = "create table image_convert_tmp (
    c_member_id int(11) NOT NULL default '0',
    table_name varchar(32) NOT NULL default '',
    key_id int(11) NOT NULL default '0',
    filename text NOT NULL,
    c_image_id int(11) NOT null,
    key `c_image_id` (`c_image_id`)
)";
        $this->db->query($sql);
        log_message('debug', "create image_convert_tmp table ");
        $sql = "insert into image_convert_tmp select 0,'c_diary',0,filename,c_image_id from ".MYNETS_PREFIX_NAME."c_image where left(filename,2) = 'd_' ";
        $this->db->query($sql);
        $sql = "insert into image_convert_tmp select 0,'c_diary_comment',0,filename,c_image_id from ".MYNETS_PREFIX_NAME."c_image where left(filename,2) = 'dc'";
        $this->db->query($sql);
        $sql = "insert into image_convert_tmp select 0,'c_message',0,filename,c_image_id from ".MYNETS_PREFIX_NAME."c_image where left(filename,2) = 'ms'";
        $this->db->query($sql);
        $sql = "insert into image_convert_tmp select 0,'c_commu_topic',0,filename,c_image_id from ".MYNETS_PREFIX_NAME."c_image where left(filename,2) = 't_'";
        $this->db->query($sql);
        $sql = "insert into image_convert_tmp select 0,'c_commu_topic_comment',0,filename,c_image_id from ".MYNETS_PREFIX_NAME."c_image where left(filename,3) = 'tc_'";
        $this->db->query($sql);
        $sql = "insert into image_convert_tmp select 0,'c_commu',0,filename,c_image_id from ".MYNETS_PREFIX_NAME."c_image where left(filename,2) = 'c_'";
        $this->db->query($sql);
        $sql = "insert into image_convert_tmp select 0,'c_member',0,filename,c_image_id from ".MYNETS_PREFIX_NAME."c_image where left(filename,2) = 'm_'";
        $this->db->query($sql);
        log_message('debug', "insert image_convert_tmp table finished");
        //INDEX作成
        log_message('debug', "copy data tmp start");
        $sql = "ALTER TABLE `".MYNETS_PREFIX_NAME."c_diary` ADD INDEX ( `image_filename_1` ( 64 ))";
        $this->db->query($sql);
        $sql = "update image_convert_tmp as t,".MYNETS_PREFIX_NAME."c_diary as c set t.c_member_id = c.c_member_id,t.key_id = c.c_diary_id where t.filename = c.image_filename_1";
        $this->db->query($sql);
        $sql = "ALTER TABLE `".MYNETS_PREFIX_NAME."c_diary` ADD INDEX ( `image_filename_2` ( 64 ))";
        $this->db->query($sql);
        $sql = "update image_convert_tmp as t,".MYNETS_PREFIX_NAME."c_diary as c set t.c_member_id = c.c_member_id,t.key_id = c.c_diary_id where t.filename = c.image_filename_2";
        $this->db->query($sql);
        $sql = "ALTER TABLE `".MYNETS_PREFIX_NAME."c_diary` ADD INDEX ( `image_filename_3` ( 64 ))";
        $this->db->query($sql);
        $sql = "update image_convert_tmp as t,".MYNETS_PREFIX_NAME."c_diary as c set t.c_member_id = c.c_member_id,t.key_id = c.c_diary_id where t.filename = c.image_filename_3";
        $this->db->query($sql);
        $sql = "ALTER TABLE `".MYNETS_PREFIX_NAME."c_diary_comment` ADD INDEX ( `image_filename_1` ( 64 ))";
        $this->db->query($sql);
        $sql = "update image_convert_tmp as t,".MYNETS_PREFIX_NAME."c_diary_comment as c set t.c_member_id = c.c_member_id,t.key_id = c.c_diary_comment_id where t.filename = c.image_filename_1";
        $this->db->query($sql);
        $sql = "ALTER TABLE `".MYNETS_PREFIX_NAME."c_diary_comment` ADD INDEX ( `image_filename_2` ( 64 ))";
        $this->db->query($sql);
        $sql = "update image_convert_tmp as t,".MYNETS_PREFIX_NAME."c_diary_comment as c set t.c_member_id = c.c_member_id,t.key_id = c.c_diary_comment_id where t.filename = c.image_filename_2";
        $this->db->query($sql);
        $sql = "ALTER TABLE `".MYNETS_PREFIX_NAME."c_diary_comment` ADD INDEX ( `image_filename_3` ( 64 ))";
        $this->db->query($sql);
        $sql = "update image_convert_tmp as t,".MYNETS_PREFIX_NAME."c_diary_comment as c set t.c_member_id = c.c_member_id,t.key_id = c.c_diary_comment_id where t.filename = c.image_filename_3";
        $this->db->query($sql);
        $sql = "ALTER TABLE `".MYNETS_PREFIX_NAME."c_message` ADD INDEX ( `image_filename_1` ( 64 ))";
        $this->db->query($sql);
        $sql = "update image_convert_tmp as t,".MYNETS_PREFIX_NAME."c_message as c set t.c_member_id = c.c_member_id_from,t.key_id = c.c_message_id where t.filename = c.image_filename_1";
        $this->db->query($sql);
        $sql = "ALTER TABLE `".MYNETS_PREFIX_NAME."c_message` ADD INDEX ( `image_filename_2` ( 64 ))";
        $this->db->query($sql);
        $sql = "update image_convert_tmp as t,".MYNETS_PREFIX_NAME."c_message as c set t.c_member_id = c.c_member_id_from,t.key_id = c.c_message_id where t.filename = c.image_filename_2";
        $this->db->query($sql);
        $sql = "ALTER TABLE `".MYNETS_PREFIX_NAME."c_message` ADD INDEX ( `image_filename_3` ( 64 ))";
        $this->db->query($sql);
        $sql = "update image_convert_tmp as t,".MYNETS_PREFIX_NAME."c_message as c set t.c_member_id = c.c_member_id_from,t.key_id = c.c_message_id where t.filename = c.image_filename_3";
        $this->db->query($sql);
        $sql = "ALTER TABLE `".MYNETS_PREFIX_NAME."c_commu_topic_comment` ADD INDEX ( `image_filename1` ( 64 ))";
        $this->db->query($sql);
        $sql = "update image_convert_tmp as t,".MYNETS_PREFIX_NAME."c_commu_topic_comment as c set t.c_member_id = c.c_member_id,t.key_id = c.c_commu_topic_comment_id where t.filename = c.image_filename1";
        $this->db->query($sql);
        $sql = "ALTER TABLE `".MYNETS_PREFIX_NAME."c_commu_topic_comment` ADD INDEX ( `image_filename2` ( 64 ))";
        $this->db->query($sql);
        $sql = "update image_convert_tmp as t,".MYNETS_PREFIX_NAME."c_commu_topic_comment as c set t.c_member_id = c.c_member_id,t.key_id = c.c_commu_topic_comment_id where t.filename = c.image_filename2";
        $this->db->query($sql);
        $sql = "ALTER TABLE `".MYNETS_PREFIX_NAME."c_commu_topic_comment` ADD INDEX ( `image_filename3` ( 64 ))";
        $this->db->query($sql);
        $sql = "update image_convert_tmp as t,".MYNETS_PREFIX_NAME."c_commu_topic_comment as c set t.c_member_id = c.c_member_id,t.key_id = c.c_commu_topic_comment_id where t.filename = c.image_filename3";
        $this->db->query($sql);
        $sql = "ALTER TABLE `".MYNETS_PREFIX_NAME."c_commu` ADD INDEX ( `image_filename` ( 64 ))";
        $this->db->query($sql);
        $sql = "update image_convert_tmp as t,".MYNETS_PREFIX_NAME."c_commu as c set t.c_member_id = c.c_member_id_admin,t.key_id = c.c_commu_id where t.filename = c.image_filename";
        $this->db->query($sql);
        $sql = "ALTER TABLE `".MYNETS_PREFIX_NAME."c_member` ADD INDEX ( `image_filename_1` ( 64 ))";
        $this->db->query($sql);
        $sql = "update image_convert_tmp as t,".MYNETS_PREFIX_NAME."c_member as c set t.c_member_id = c.c_member_id,t.key_id = c.c_member_id where t.filename = c.image_filename_1";
        $this->db->query($sql);
        $sql = "ALTER TABLE `".MYNETS_PREFIX_NAME."c_member` ADD INDEX ( `image_filename_2` ( 64 ))";
        $this->db->query($sql);
        $sql = "update image_convert_tmp as t,".MYNETS_PREFIX_NAME."c_member as c set t.c_member_id = c.c_member_id,t.key_id = c.c_member_id where t.filename = c.image_filename_2";
        $this->db->query($sql);
        $sql = "ALTER TABLE `".MYNETS_PREFIX_NAME."c_member` ADD INDEX ( `image_filename_3` ( 64 ))";
        $this->db->query($sql);
        $sql = "update image_convert_tmp as t,".MYNETS_PREFIX_NAME."c_member as c set t.c_member_id = c.c_member_id,t.key_id = c.c_member_id where t.filename = c.image_filename_3";
        $this->db->query($sql);
        log_message('debug', "copy data tmp finished");

        //c_imageテーブルにc_member_idをつける
        $sql = "update ".MYNETS_PREFIX_NAME."c_image as c,image_convert_tmp as t set c.c_member_id = t.c_member_id where c.c_image_id = t.c_image_id";
        $this->db->query($sql);
        log_message('debug', "update c_image set c_member_id finished");
        //テンポラリテーブル、インデックスを削除する
        $sql = "ALTER TABLE `".MYNETS_PREFIX_NAME."c_diary` DROP INDEX `image_filename_1`,DROP INDEX `image_filename_2`,DROP INDEX `image_filename_3`";
        $this->db->query($sql);
        $sql = "ALTER TABLE `".MYNETS_PREFIX_NAME."c_diary_comment` DROP INDEX `image_filename_1`,DROP INDEX `image_filename_2`,DROP INDEX `image_filename_3`";
        $this->db->query($sql);
        $sql = "ALTER TABLE `".MYNETS_PREFIX_NAME."c_message` DROP INDEX `image_filename_1`,DROP INDEX `image_filename_2`,DROP INDEX `image_filename_3`";
        $this->db->query($sql);
        $sql = "ALTER TABLE `".MYNETS_PREFIX_NAME."c_commu_topic_comment` DROP INDEX `image_filename1`,DROP INDEX `image_filename2`,DROP INDEX `image_filename3`";
        $this->db->query($sql);
        $sql = "ALTER TABLE `".MYNETS_PREFIX_NAME."c_commu` DROP INDEX `image_filename`;";
        $this->db->query($sql);
        $sql = "ALTER TABLE `".MYNETS_PREFIX_NAME."c_member` DROP INDEX `image_filename_1`,DROP INDEX `image_filename_2`,DROP INDEX `image_filename_3`";
        $this->db->query($sql);
        $sql = "DROP TABLE image_convert_tmp";
        $this->db->query($sql);
        log_message('debug', "update c_image convert all finished");
        return;
    }

    /**
     * 絵文字コードを、PNEと合わせて内部独自コードへ変換する
     *
     * @access  public
     */
    function emojiConvert()
    {

        set_time_limit(0);

        $target = array(
            'biz_schedule' => array('title', 'value',),
            'biz_todo' => array('memo',),
            'c_commu' => array('name', 'info',),
            'c_commu_admin_confirm' => array('message',),
            'c_commu_member_confirm' => array('message',),
            'c_commu_sub_admin_confirm' => array('message',),
            'c_commu_topic' => array('name', 'open_date_comment', 'open_pref_comment',),
            'c_commu_topic_comment' => array('body',),
            'c_diary' => array('subject', 'body',),
            'c_diary_comment' => array('body',),
            'c_friend' => array('intro',),
            'c_friend_confirm' => array('message',),
            'c_member' => array('nickname',),
            'c_member_pre' => array('nickname', 'c_password_query_answer',),
            'c_member_pre_profile' => array('value',),
            'c_member_profile' => array('value',),
            'c_message' => array('body', 'subject',),
            'c_searchlog' => array('searchword',),
            'c_review_comment' => array('body'),
            //MyNETS独自テーブル
            'c_dengon_comment' => array('body'),
            'c_schedule' => array('title', 'body'),
            'c_tags' => array('c_tags_name'),
        );

        foreach ($target as $tablename => $fields)
        {
            //テーブルがDBに存在しているかどうかを見る
            if ($this->hasTable($tablename))
            {
                foreach ($fields as $fieldname)
                {
                    //テーブルにそのカラムがあるかどうかを判定
                    if ($this->hasColumn($tablename, $fieldname))
                    {
                        //処理実行
                        $this->_convert_emoji_format_2_8_to_2_10($tablename, $fieldname);
                    }
                }
            }
        }
        return true;
    }

    function _convert_emoji_format_2_8_to_2_10($table, $field)
    {
        $primary_key = $table . '_id';
        $sql = 'SELECT ' . $primary_key . ',' . $field . ' FROM ' . $table;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        if ($result)
        {
            foreach ($result as $value)
            {

                $old_field_value = mb_convert_encoding($value[$field], 'SJIS-win', 'UTF-8');
                $new_field_value = $old_field_value;
                // すべての絵文字を展開する
                $new_field_value = $this->emoji_unescape($new_field_value, false);
                // 先にSoftBank絵文字のコンバート処理
                $GLOBALS['__Framework']['carrier'] = 's';
                $new_field_value = $this->emoji_escape($new_field_value);
                $GLOBALS['__Framework']['carrier'] = '';

                // 他キャリア絵文字のコンバート処理
                $new_field_value = $this->emoji_escape($new_field_value);
                // 絵文字をコンバートした場合
                if ($old_field_value !== $new_field_value)
                {
                    $new_field_value = mb_convert_encoding($new_field_value, 'UTF-8', 'SJIS-win');
                    $data = array($field => $new_field_value);
                    $where = array($primary_key => $value[$primary_key]);
                    $this->db->update($table, $data, $where);
                }
            }
        }
    }


    function emoji_escape($str, $remove = false)
    {
        $result = '';
        for ($i = 0; $i < strlen($str); $i++) {
            $emoji = '';
            $c1 = ord($str[$i]);
            if ($GLOBALS['__Framework']['carrier'] == 's') {
                if ($c1 == 0xF7 || $c1 == 0xF9 || $c1 == 0xFB) {
                    $bin = substr($str, $i, 2);
                    $emoji = $this->emoji_escape_s($bin);
                }
            } elseif ($c1 == 0xF8 || $c1 == 0xF9) {
                $bin = substr($str, $i, 2);
                $emoji = $this->emoji_escape_i($bin);
            } elseif (0xF3 <= $c1 && $c1 <= 0xF7) {
                $bin = substr($str, $i, 2);
                $emoji = $this->emoji_escape_e($bin);
            }
            if ($emoji) {
                if (!$remove) {
                    $result .= $emoji;
                }
                $i++;
            } else {
                $result .= $str[$i];
                if ((0x81 <= $c1 && $c1 <= 0x9F) || 0xE0 <= $c1) {
                    $result .= $str[$i+1];
                    $i++;
                }
            }
        }
        return $result;
    }

    function emoji_escape_i($bin)
    {
        $iemoji = '\xF8[\x9F-\xFC]|\xF9[\x40-\xFC]';
        if (preg_match('/'.$iemoji.'/', $bin)) {
            $unicode = mb_convert_encoding($bin, 'UCS2', 'SJIS-win');
            $emoji_code = OpenPNE_KtaiEmoji::getInstance();
            $code = $emoji_code->get_emoji_code4emoji(sprintf('&#x%02X%02X;', ord($unicode[0]), ord($unicode[1])), 'i');
            return '['.$code.']';
        } else {
            return '';
        }
    }

    function emoji_escape_e($bin)
    {
        $sjis = (ord($bin[0]) << 8) + ord($bin[1]);
        if ($sjis >= 0xF340 && $sjis <= 0xF493) {
            if ($sjis <= 0xF352) {
                $unicode = $sjis - 3443;
            } elseif ($sjis <= 0xF37E) {
                $unicode = $sjis - 2259;
            } elseif ($sjis <= 0xF3CE) {
                $unicode = $sjis - 2260;
            } elseif ($sjis <= 0xF3FC) {
                $unicode = $sjis - 2241;
            } elseif ($sjis <= 0xF47E) {
                $unicode = $sjis - 2308;
            } else {
                $unicode = $sjis - 2309;
            }
        } elseif ($sjis >= 0xF640 && $sjis <= 0xF7FC) {
            if ($sjis <= 0xF67E) {
                $unicode = $sjis - 4568;
            } elseif ($sjis <= 0xF6FC) {
                $unicode = $sjis - 4569;
            } elseif ($sjis <= 0xF77E) {
                $unicode = $sjis - 4636;
            } elseif ($sjis <= 0xF7D1) {
                $unicode = $sjis - 4637;
            } elseif ($sjis <= 0xF7E4) {
                $unicode = $sjis - 3287;
            } else {
                $unicode = $sjis - 4656;
            }
        } else {
            return '';
        }
        $emoji_code = OpenPNE_KtaiEmoji::getInstance();
        $code = $emoji_code->get_emoji_code4emoji(sprintf('&#x%04X;', $unicode), 'e');
        return '['.$code.']';
    }

    function emoji_escape_s($bin)
    {
        $sjis1 = ord($bin[0]);
        $sjis2 = ord($bin[1]);
        $web1 = $web2 = 0;
        switch ($sjis1) {
        case 0xF9:
            if ($sjis2 >= 0x41 && $sjis2 <= 0x7E) {
                $web1 = ord('G');
                $web2 = $sjis2 - 0x20;
            } elseif($sjis2 >= 0x80 && $sjis2 <= 0x9B) {
                $web1 = ord('G');
                $web2 = $sjis2 - 0x21;
            } elseif ($sjis2 >= 0xA1 && $sjis2 <= 0xED) {
                $web1 = ord('O');
                $web2 = $sjis2 - 0x80;
            }
            break;
        case 0xF7:
            if ($sjis2 >= 0x41 && $sjis2 <= 0x7E) {
                $web1 = ord('E');
                $web2 = $sjis2 - 0x20;
            } elseif ($sjis2 >= 0x80 && $sjis2 <= 0x9B) {
                $web1 = ord('E');
                $web2 = $sjis2 - 0x21;
            } elseif ($sjis2 >= 0xA1 && $sjis2 <= 0xF3) {
                $web1 = ord('F');
                $web2 = $sjis2 - 0x80;
            }
            break;
        case 0xFB:
            if ($sjis2 >= 0x41 && $sjis2 <= 0x7E) {
                $web1 = ord('P');
                $web2 = $sjis2 - 0x20;
            } elseif ($sjis2 >= 0x80 && $sjis2 <= 0x8D) {
                $web1 = ord('P');
                $web2 = $sjis2 - 0x21;
            } elseif ($sjis2 >= 0xA1 && $sjis2 <= 0xD7) {
                $web1 = ord('Q');
                $web2 = $sjis2 - 0x80;
            }
            break;
        default:
            return '';
        }
        $emoji_code = OpenPNE_KtaiEmoji::getInstance();
        $code = $emoji_code->get_emoji_code4emoji(pack('c5', 0x1b, 0x24, $web1, $web2, 0x0f), 's');
        return '['.$code.']';
    }

    function emoji_unescape($str, $amp_escaped = false)
    {
        $amp = ($amp_escaped) ? '&amp;' : '&';
        $regexp = "/$amp#x(E[0-9A-F]{3});/";
        return preg_replace_callback($regexp, array($this, 'emoji_unescape_callback'), $str);
    }


    function emoji_unescape4i($unicode)
    {
        $ubin = pack('H4', dechex($unicode));
        return mb_convert_encoding($ubin, 'SJIS-win', 'UCS2');
    }

    function emoji_unescape4e($unicode)
    {
        if (0xE468 <= $unicode  && $unicode <= 0xE5DF) {
            if ($unicode <= 0xE4A6) {
                $sjis = $unicode + 4568;
            } elseif ($unicode <= 0xE523) {
                $sjis = $unicode + 4569;
            } elseif ($unicode <= 0xE562) {
                $sjis = $unicode + 4636;
            } elseif ($unicode <= 0xE5B4) {
                $sjis = $unicode + 4637;
            } elseif ($unicode <= 0xE5CC) {
                $sjis = $unicode + 4656;
            } else {
                $sjis = $unicode + 3443;
            }
        } elseif (0xEA80 <= $unicode && $unicode <= 0xEB88) {
            if ($unicode <= 0xEAAB) {
                $sjis = $unicode + 2259;
            } elseif ($unicode <= 0xEAFA) {
                $sjis = $unicode + 2260;
            } elseif ($unicode <= 0xEB0D) {
                $sjis = $unicode + 3287;
            } elseif ($unicode <= 0xEB3B) {
                $sjis = $unicode + 2241;
            } elseif ($unicode <= 0xEB7A) {
                $sjis = $unicode + 2308;
            } else {
                $sjis = $unicode + 2309;
            }
        }
        return pack('H4', dechex($sjis));
    }

    function emoji_convert($str)
    {
        $moji_pattern = '/\[([a-z]:[0-9]+)\]/i';
        return preg_replace_callback($moji_pattern, array($this, '_emoji_convert'), $str);
    }

    function emoji_unescape_callback($matches)
    {
        $unicode = hexdec($matches[1]);
        if (0xE63E <= $unicode && $unicode <= 0xE757) {
            return $this->emoji_unescape4i($unicode);
        } elseif ((0xE468 <= $unicode && $unicode <= 0xE5DF) ||
                  (0xEA80 <= $unicode && $unicode <= 0xEB88)) {
            return $this->emoji_unescape4e($unicode);
        } else {
            return $matches[0];
        }
    }

    function _emoji_convert($matches)
    {
        $o_code = $matches[1];

        switch ($GLOBALS['__Framework']['carrier']) {
        case 'i':
        case 'w':
            $carrior = 'i';
            break;
        case 's':
            $carrior = 's';
            break;
        case 'e':
            $carrior = 'e';
            break;
        default:
            $carrior = null;
            break;
        }

        $emoji_code = OpenPNE_KtaiEmoji::getInstance();
        $c_emoji = $emoji_code->convert_emoji($o_code, $carrior);
        if ($c_emoji) {
            return $c_emoji;
        } else {
            return '〓';
        }
    }
}

?>