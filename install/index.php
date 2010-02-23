<?php
require_once '../webapp/version.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>MyNETS <?php echo MyNETS_VERSION;?> インストーラーについて</title>
<link href="css/import.css" rel="stylesheet" type="text/css" media="screen,projection" />
<script type="text/javascript" src="js/js.js"></script>
</head>
<body>
<div id="wrap">
  <div id="head-install">
    <h1>MyNETS <?php echo MyNETS_VERSION;?> インストーラー</h1>
    <div id="head-menu">
      <ul class="menu">
        <li><a href="http://usagi-project.org/">Usagi Project公式サイト</a></li>
        <li><a href="http://usagi-project.org/SBBS/">サポート掲示板</a></li>
        <li><a href="http://demo.usagi-project.org/">デモサイトSNS</a></li>
      </ul>
    </div>
  </div>
  <div id="content">
    <div id="main-body">
      <div class="entry-box">
        <div id="step0" class="entry-tag">さあ、あなたもSNSエンジン MyNETS Version <?php echo MyNETS_VERSION;?> をインストールしよう！</div>
        <h2>MyNETS Version <?php echo MyNETS_VERSION;?> をインストールしよう！</h2>
        <div class="entry-category">Step0</div>
        <div class="entry-body">
          <p>Usagi Projectへようこそ</p>
          <p>Usagi ProjectのSNSエンジン「MyNETS Version <?php echo MyNETS_VERSION;?>」をインストールするためのツールがインストーラーです。このツールは新規でMyNETS Version <?php echo MyNETS_VERSION;?> を導入するためのツールです。</p>
          <!--<p>すでにMyNETSを導入していて、バージョンアップする場合は「<a href="./versionup.html" title="バージョンアップツール" onmouseout="hideTooltip()" onmouseover="showTooltip(event,'MyNETS 1.0.1や1.0.0をご利用の場合に使います。');return false">バージョンアップツール</a>」をご利用ください。</p>-->
          <!--<p>また、OpenPNE2.4.Xや2.6.xからのコンバートは「<a href="./upgrade.html" title="Usagiコンバータ" onmouseout="hideTooltip()" onmouseover="showTooltip(event,'OpenPNE系SNSからMyNETSを導入するときに使います。');return false">Usagiコンバーター</a>」をお使いください。</p>-->
          <br />
          <br />
          <p class="center"><img src="./images/back_img.jpg" alt="Usagi Project"  /></p>
        </div>
      </div>
      <div class="entry-box">
        <div id="step1" class="entry-tag">導入前の確認を！</div>
        <h2>MyNETSをインストールするための事前準備</h2>
        <div class="entry-category">Step1</div>
        <div class="entry-body">
          <p>インストーラーは、MyNETS <?php echo MyNETS_VERSION;?> を新規でサーバーに導入する方を対象としています。</p>
          <p>画面の指示に従ってインストール作業を行うことができます。</p>
          <br />
          <p>処理の流れは次のようになります。</p>
          <ul>
            <li><a href="#" onmouseout="hideTooltip()" onmouseover="showTooltip(event,'まずは公式サイトからMyNETS <?php echo MyNETS_VERSION;?> をDLして自分のマシンで展開しておきましょう。');return false">MyNETS <?php echo MyNETS_VERSION;?> アプリケーションファイルの準備</a></li>
            <li><a href="#" onmouseout="hideTooltip()" onmouseover="showTooltip(event,'導入予定のサーバーの情報を準備しておいてください。どのようなURLでSNSサイトを動かすのか、などインストールのためには情報が必要になります。');return false">サーバー情報の準備</a></li>
            <li><a href="#" onmouseout="hideTooltip()" onmouseover="showTooltip(event,'MyNETSでは、MySQL（データベースサーバー）を利用します。これが利用できないとMyNETSをお使いになることはできません。データベースを作成して、情報を準備しておいてください。');return false">データベースの事前準備</a></li>
            <li><a href="#" onmouseout="hideTooltip()" onmouseover="showTooltip(event,'必要なディレクトリのパーミッションの調整（書き込み権限）が必要です。画面に従ってサーバーのディレクトリを調整しましょう。');return false">パーミッションのディレクトリの調整</a></li>
            <li><a href="#" onmouseout="hideTooltip()" onmouseover="showTooltip(event,'インストーラーで自動でデータを保存するためのテーブルを作成します。');return false">データベースのインストール</a></li>
            <li><a href="#" onmouseout="hideTooltip()" onmouseover="showTooltip(event,'会員ID１番の初期ユーザーの設定、管理画面へログインするためのIDとパスワードを登録します。');return false">初期ユーザー、管理者の設定</a></li>
            <li><a href="#" onmouseout="hideTooltip()" onmouseover="showTooltip(event,'SNSへのログイン開始');return false">ログイン開始</a></li>
          </ul>
          <p>順番に進めていくことで、簡単にMyNETSをインストールすることができます。</p>
          <br />
          <p>インストーラーでは設定されないものがあります。別途設定する必要がありますのでご確認ください。</p>
          <ul>
            <li><a href="#" onmouseout="hideTooltip()" onmouseover="showTooltip(event,'CRONを使ったデイリーニュース等の自動配信は、サーバーによっては扱えないものものございます。サーバーにより設定方法が異なりますので、インストーラーでは設定することができません。');return false">cronによるメール等の自動配信設定</a></li>
            <li><a href="#" onmouseout="hideTooltip()" onmouseover="showTooltip(event,'携帯電話によるメール投稿の設定はインストーラーだけでは設定することができません。メール投稿機能を実現するためには、サーバーそれぞれの状況に合わせた設定が必要です。また、サーバーによっては行えないケースがあります。');return false">携帯電話によるメール投稿</a></li>
            <li><a href="#" onmouseout="hideTooltip()" onmouseover="showTooltip(event,'各種設定ファイルをセキュリティのために非公開領域へ移動される場合は、個別に移動し各種設定ファイルを変更しなければなりません。');return false">非公開領域へのディレクトリ移動</a></li>
            <li><a href="#" onmouseout="hideTooltip()" onmouseover="showTooltip(event,'インストールディレクトリそのものをインストーラーで削除することはできません。インストール完了後ご自身で変更または削除してもらう必要があります。');return false">インストールディレクトリの削除</a></li>
            <li><a href="#" onmouseout="hideTooltip()" onmouseover="showTooltip(event,'設定ファイル conf/config.php を編集することで変更できる設定項目がいくつかあります。必要な場合は、インストール完了後ご自身で config.php を変更してください。');return false">config.phpでしか設定できない詳細な設定</a></li>
          </ul>
          <p>上記内容はインストーラーでは自動で設定できませんのでご注意ください。</p>
          <br />
          <!--<input type="checkbox" name="step1chk" value="1"  />　※確認ができたら、チェックを入れてください。-->
        </div>
      </div>
      <div class="entry-box">
        <div id="step2" class="entry-tag">MyNETSアプリケーションをサーバーに転送する！</div>
        <h2>ファイルの転送</h2>
        <div class="entry-category">Step2</div>
        <div class="entry-body">
          <p>MyNETS <?php echo MyNETS_VERSION;?> のファイルをダウンロードし、FTPクライアントまたはSSH等でご利用になるサーバーへアップロードしてください。</p>
          <p>※確実にすべてのファイルがアップロードできるようにしてください。（FTP転送の場合、転送ミスで一部ファイルが正常にアップロードできないことがあります。その場合動作上不具合が出る可能性がありますので、ご注意ください。</p>
          <p>ファイルが正常にアップロードできたかどうかを確認するためのツールを別途ご用意しています。</p>
          <p>スクリプトチェックツールを Usagi Project 公式サイト、またはソースフォージからダウンロードして、サーバーに転送します。</p>
          <p>すべてのファイルが正しくアップロードできたか確認してください。</p>
          <br />
          <p class="center"><img src="images/ffftp_img.jpg" alt="FFFTP画面" /></p>
          <br />ここでは例としてFFFTPでの画面をご紹介しています。<br />
          <p class="center"><img src="images/ffftp_img_02.jpg" alt="FFFTP画面" /></p>
          <br />
          <!--<input type="checkbox" name="step2chk" value="1"  />　※確認ができたら、チェックを入れてください。-->
        </div>
      </div>
      <div class="entry-box">
        <div id="step3" class="entry-tag">データベースを準備する</div>
        <h2>MySQLデータベースの作成</h2>
        <div class="entry-category">Step3</div>
        <div class="entry-body">
          <p>サーバーの管理画面等から「データベース」の作成を行ってください。多くのレンタルサーバーでは、MySQLを利用することができます。</p>
          <p>MySQLを利用する場合は、通常、次の情報が必要となります。</p>
          <ul>
            <li>データベースを動かすサーバーの名前（DBサーバー名、またはDBホスト名）</li>
            <li>データベースへ接続するためのユーザー名</li>
            <li>データベースへ接続するためのパスワード</li>
            <li>作成したデータベースの名前</li>
          </ul>
          <p>WEBサーバーの中にMySQL（データベース）が入っている場合は、通常ホスト名は「localhost」となります。<br />
          さくらインターネットやロリポップなどのレンタルサーバーなどの場合は「mysqlxx.db.sakura.ne.jp」などの専用のサーバーが用意されており、指定されたサーバーへ接続して利用する形になっています。
          </p>
          <br />
          <p class="center"><img src="images/sakura_01.jpg" alt="FFFTP画面" /></p>
          <br />ここでは、さくらインターネットを例にご説明しています。それぞれのレンタルサーバーに合わせてごらんください<br />
          <p class="center"><img src="images/sakura_02.jpg" alt="FFFTP画面"  /></p>
          <p>通常レンタルサーバーをご利用の場合はユーザー名は「アカウント名」となります。専用サーバーなどの場合は「root」となることが多いでしょう。</p>
          <p>接続するパスワードは、WEBサーバーを契約したときにご自身で接続するためのパスワードを決めることが多いです。<br />プロバイダ等から指定されている場合は、その指定されたパスワードを必要とします。</p>
          <p>サーバー内にMyNETSを動かすためのデータベースを作成する必要があります。あらかじめコントロールパネルなどからデータベースを作成しておいてください。<br />※テーブルは作成する必要がありません。また、レンタルサーバーでは1契約で1個のデータベースしか使えない場合があります。その場合はあらかじめ用意されたデータベースを使ってMyNETSをインストールします。</p>
          <br />
          <!--<input type="checkbox" name="step3chk" value="1"  />　※確認ができたら、チェックを入れてください。-->
        </div>
      </div>
      <div class="entry-box">
        <div id="step4" class="entry-tag">ディレクトリのパーミッションの設定</div>
        <h2>指定したディレクトリのパーミッションを調整する</h2>
        <div class="entry-category">Step4</div>
        <div class="entry-body">
          <p>MyNETSでは、サーバー上でファイルを書き込む必要があります。その場合、そのディレクトリに「書き込み権限」が必要となります。</p>
          <p>以下の情報をもとに、事前にディレクトリの書き込み権限を設定しましょう。</p>
          <p class="style2">※通常書き込み権限を必要とするのは、777 または 757となります。それぞれのサーバーに合わせて設定してください。</p>
          <br />
          <p class="center"><img src="images/ffftp_img_03.jpg" alt="FFFTP画面"  /></p>
          <br />
          <!--<input type="checkbox" name="step4chk" value="1"  />　※確認ができたら、チェックを入れてください。-->
        </div>
      </div>
      <div class="entry-box">
        <div id="step5" class="entry-tag">インストーラーの起動</div>
        <h2>準備ができたらインストーラーをスタートさせます</h2>
        <div class="entry-category">Step5</div>
        <div class="entry-body">
          <p>事前準備が完了したら、いよいよインストールを開始します。</p>
          <p>インストーラーでは、ディレクトリのパーミッションのチェックを行い、設定ファイル（configファイル）に設定する情報を入力します。<br />
          確認後、設定ファイルを作成してデータベースにテーブルを作成します。</p>
          <br />
          <p>すべてが終了したら、管理画面へログインすることができるようになります。<br />このときに「installディレクトリ」がそのままになっていると、管理画面にログインできないようになっています。これはセキュリティのため、インストール用のプログラムが入っているディレクトリを削除するか別の名前にしなければなりません。</p>
          <p>ディレクトリの削除等をおこなって管理画面にログインできればインストール完了です</p>
          <br />
          <!--<input type="checkbox" name="step5chk" value="1"  />　※確認ができたら、チェックを入れてください。-->
        </div>
      </div>
      <div class="entry-box">
        <div id="step6" class="entry-tag">SNSにログインしよう！</div>
        <h2>いよいよSNSにログインしよう</h2>
        <div class="entry-category">Step6</div>
        <div class="entry-body">
          <br />
          <p>すべての作業が完了したら、あなたのSNSにログインすることが可能となります！</p>
          <br />
           <p class="center"><img src="./images/back_img.jpg" alt="Usagi Project"  /></p>
          <br />
          <br />
          <form action="index1.php">
          <p align="center"><input type="submit" value="インストールを開始する" /></p>
          </form>
          <br />
        </div>
      </div>
    </div>
    <div id="side-menu">
      <div id="category">
        <h3>CATEGORY</h3>
        <ul class="link-list">
          <li><a href="#step1" onmouseout="hideTooltip()" onmouseover="showTooltip(event,'導入前の確認を行います');return false">導入前の確認</a></li>

          <li><a href="#step2" onmouseout="hideTooltip()" onmouseover="showTooltip(event,'サーバーへファイルをアップロードします');return false">サーバーへのアプリケーションの転送</a></li>
          <li><a href="#step3" onmouseout="hideTooltip()" onmouseover="showTooltip(event,'データベースの作成等の準備を行います。');return false">データベースの作成</a></li>
          <li><a href="#step4" onmouseout="hideTooltip()" onmouseover="showTooltip(event,'書き込み権限が必要なディレクトリにパーミッションの設定を行います。');return false">パーミッションの調整</a></li>

          <li><a href="#step5" onmouseout="hideTooltip()" onmouseover="showTooltip(event,'インストーラを起動させて各種設定を登録します。');return false">インストールの開始</a></li>
          <li><a href="#step6" onmouseout="hideTooltip()" onmouseover="showTooltip(event,'管理画面とSNSへログインしましょう');return false">ログイン</a></li>

        </ul>
      </div>
      <div id="search-box">
        <h3>CHECK</h3>
        <ul class="link-list">
          <li><a href="http://usagi-project.org/SBBS/" target="_blank">サポート掲示板</a></li>

        </ul>
      </div>
    </div>
  </div>
  <div id="foot">
    <ul class="menu">
      <li><a href="http://usagi-project.org/">Usagi Project公式サイト</a></li>
      <li><a href="http://usagi-project.org/SBBS/">サポート掲示板</a></li>
      <li><a href="http://demo.usagi-project.org/">デモサイトSNS</a></li>
      <li><a href="#">ページTOP</a></li>
    </ul>
    <div id="copyright">
      <p>COPYRIGHT Usagi Project All Rights reserved. 2007-2010</p>
    </div>
  </div>
</div>
</body>
</html>
