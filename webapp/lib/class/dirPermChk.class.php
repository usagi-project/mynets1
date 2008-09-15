<?php
class dirPermChk
{
    var $_chkDir = '' ;          //ディレクトリーパス
    var $_chk_flag = false ;
    /*********************************************
     * コンストラクタ
     *********************************************/
    function dirPermChk()
    {
    }

    /*********************************************
     *ディレクトリのパーミッションチェック
     *********************************************/
    function chekPerm($chkDir)
    {
        clearstatcache();
        $this->$_chkDir = $chkDir ;
        $parms = substr(sprintf('%o', fileperms($this->$_chkDir)), -3);
        $chmod_test = is_writable($this->$_chkDir);
        
        return $chmod_test;
    }

}
?>