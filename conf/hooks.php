<?php

/**
 * MyNETSHOOKシステム
 * 配列に情報をセットすることで、クラス、関数を起動させることが可能となります。
 * class  呼び出したいクラスの名前。クラスの代わりに手続き型の関数を使いたい場合
 * は、空のままにしておきます。
 * function  呼び出したいメソッド名 (関数名)。
 * filename  クラス/メソッド(関数)が含まれるファイル名。
 * filepath  スクリプトが含まれるディレクトリ名。Note: スクリプトは、webapp/components/
 * フォルダの中にあるhooksディレクトリに置く必要があり、パスはwebapp/componentsフォルダ
 * からの相対パスになります。たとえばスクリプトがwebapp/components/にあるとき、
 * 単に hooks をファイルパスとして用います。スクリプトが
 * webapp/components/hooks/utilities にあるときは、hooks/utilities をファイルパスとして
 * 用います。末尾にスラッシュをつけないようにしてください。
 * params  スクリプトに渡したい全パラメータ。この項目はオプションです。
 *
 * classではなく関数の場合はclassは空欄にしておいてください。
 */

/*
//コントローラーの実行の手前
$hook['pre_system'] = array(
                            'class' => 'MyClass',
                            'function' => 'MyFunction',
                            'filename' => 'Myclass.php',
                            'filepath' => 'hooks',
                            'params' => array(),
                            );
*/

/*
//モジュールのinit.incが読み込まれる前
$hook['pre_include_init'] = array(
                            'class' => 'MyClass',
                            'function' => 'MyFunction',
                            'filename' => 'Myclass.php',
                            'filepath' => 'hooks',
                            'params' => array(),
                            );
*/

/*
//モジュールのinit.incが読み込まれた後
$hook['post_include_init'] = array(
                            'class' => 'MyClass',
                            'function' => 'MyFunction',
                            'filename' => 'Myclass.php',
                            'filepath' => 'hooks',
                            'params' => array(),
                            );
*/

/*
//auth.incファイルが読み込まれた後
$hook['post_auth_inc'] = array(
                            'class' => 'MyClass',
                            'function' => 'MyFunction',
                            'filename' => 'Myclass.php',
                            'filepath' => 'hooks',
                            'params' => array(),
                            );
*/

/*
//バリデーション処理が終了した後
$hook['post_validation'] = array(
                            'class' => 'MyClass',
                            'function' => 'MyFunction',
                            'filename' => 'Myclass.php',
                            'filepath' => 'hooks',
                            'params' => array(),
                            );
*/

/*
//モジュールの後のinitファンクションが実行された後
$hook['post_do_init'] = array(
                            'class' => 'MyClass',
                            'function' => 'MyFunction',
                            'filename' => 'Myclass.php',
                            'filepath' => 'hooks',
                            'params' => array(),
                            );
*/

/*
//コントローラーのすべての処理が終了した時点（画像表示などが終わった）
$hook['post_all_system'] = array(
                            'class' => 'MyClass',
                            'function' => 'MyFunction',
                            'filename' => 'Myclass.php',
                            'filepath' => 'hooks',
                            'params' => array(),
                            );
*/

?>