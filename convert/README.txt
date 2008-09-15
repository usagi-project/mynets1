/**
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 *
 * @category
 * @package    Phptal Parser Class
 * @author     KUNIHARU Tsujioka <kunitsuji@gmail.com>
 * @copyright  Copyright (c) 2008 KUNIHARU Tsujioka <kunitsuji@gmail.com>
 * @copyright  Copyright (c) 2006-2008 Usagi Project (URL:http://usagi.mynets.jp)
 * @license    New BSD License
 */
----------------------------------------------------------------------
【 タイトル 】  MyNETS Converter
【バージョン】  1.1
【 製作著作 】  KUNIHARU Tsujioka, Usagi Project
【 カテゴリ 】  MyNETSバージョンアップ、コンバートツール
【 種　　別 】  new BSDライセンス
【 動作確認 】  Windows XP,Linux
----------------------------------------------------------------------

【 更新履歴 】
Version1.1
2008/08/19：CIでの調整
・imageテーブルでのc_member_idの取得をコメントに
・絵文字コンバートをコメントに
・あしあとカウントをセッションで管理。1回のみの実行※複数行うとそれだけ実行される
・今日の一言テーブルのカラム追加とINDEX追加

2008/05/13 : 足跡集計の実行場所の移動
○新機能
・足跡集計の実行場所の変更。

Version1.0
2008/05/01 : MyNETSバージョンアップ、OpenPNEVer2.6系からのコンバートツールとして開発
【TODO】
・あしあと集計を1度行った場合に度と行わないようにする仕組み
・imageテーブルへのc_member_idの取り込み
・絵文字コンバート（MyNETS及びPNE2.8.X以前を2.10に合わせる）
----------------------------------------------------------------------
【同封ファイル】
    system/                 -本スクリプトの本体ディレクトリ
    index.php               -本スクリプトの実行PHPファイル
    README.txt              -現在表示中のファイル
    php.ini                 -CGIモードで動いているサーバの場合に利用
    copyright.txt
    license.txt             -CodeIgniterのライセンスと著作権表示
【使い方】
    MyNETSが設置されているサーバーに、convert/ディレクトリ
    以下のファイルをすべてFTP等でアップしてください。
    http://domain.com/
    これがSNSの実行ドメインだとすると
    http://domain.com/convert/
    として実行することになります。

【実行前の設定】
    本スクリプトを実行する前に次のことを必ず実行してください。
    1）
    サクラインターネットの場合（PATH_INFOが使えないサーバー）
    サクラインターネットの場合、PHPはCGIモードで起動しています。
    http://your-domain.com/convert/の直下にphp.iniファイルを設置し、次の記述を行ってください。
    cgi.fix_pathinfo=1
    このphp.iniは添付しています。
    さくらサーバ以外で、php.iniの設置ができない場合は、コントロールパネル等から設定を
    行ってください。

    また、この記述はサクラインターネットのコントロールパネルから実施することができます。
    さくらインターネットのレンタルサーバーでもPATH_INFOが使えるサーバーがあります。
    ※PHP５設定で確認しています。
    その場合は、上記$config['uri_protocol'] = "PATH_INFO";はそのままで、php.iniの設置も
    必要ありません。

    2）PATH_INFOの設定がなく、PHP.iniでのcgi.fix_pathinfo=1等の設定をしても次へ進まない
    サーバーの場合、本スクリプトを動かすことができません。
    この場合は手動でのバージョンアップ、コンバート実行となります。

    3）パーミッションの変更
    system/cache/ディレクトリ
    system/logs/ディレクトリのパーミッションを777などに変更して書き込み権限を与えて下さい。

【免責】
    必ず本スクリプトを実行する場合、データベースのバックアップを作成して行ってください。
    当プログラムを使用した際に起こるトラブル等について、保障いたしかねますので、あらかじめ
    ご了承ください。

【  連　絡  】
    Site   - http://usagi-project.org/
    E-Mail - kunitsuji@gmail.com
    作成者 : KUNIHARU Tsujioka, Usagi Project

