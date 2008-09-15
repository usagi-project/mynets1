<?php
@session_name('ktai_regist');
if($_REQUEST['regist_ksid']){
    session_id($_REQUEST['regist_ksid']);
}
@session_start();
?>