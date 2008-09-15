================================================================================
【   作者名   】　Naoya Shimada
【モジュール名】　OpenPNE BBCode入力支援モジュール
【 バージョン 】　Ver 0.8.1
【   作成日   】　2007/12/26
【  開発言語  】　PHP
【 ライセンス 】　The PHP License, version 3.01
【  著作権者  】　Naoya Shimada / しまさん
【   再配布   】　可
【    転載    】　可
【ホームページ】　http://shima3.seesaa.net/
【   連絡先   】　shima3amihs@gmail.com
================================================================================

■ 1. はじめに
--------------

  ★Ver.0.6.0で変更した利用規定をPHPライセンスに戻しました。ご注意ください。

  ★Ver.0.8.0より前のバージョンでは、クロスサイトスクリプティング（XSS）
    脆弱性が存在します。0.8.0で大体の問題を解消したはずです。
    入力部分などは以前のバージョンでもかまいませんが、Smartyプラグインは
    0.8.0以降のバージョンのSmartyプラグインを使用してください。

  ★Ver.0.8.0からスタイルシートとJavascriptの配置を変更しました。

  このパッケージは、オープンソースのSNSである「OpenPNE（オープンピーネ）」
  にて、BBCodeによる記述を可能にするためのパッケージです。

  SNS、ブログ、フォーラムや掲示板などで投稿する際、入力する内容にアクセント
  をつけたい、文章のココの部分を強調したいなどと思うことがあります。

  一部のSNSやブログなどのシステムでは、直接HTMLを記述できるようになっている
  場合もありますが、不完全なHTMLを記述した場合、画面が崩れたりして、問題に
  なることがあります。

  それを回避する方法の１つがBBCodeです。直接HTMLを記述させるのではなくて、
  代替えとなるBBCodeというタグを書いてもらい、システム側でBBCodeをHTMLに変換
  してやることで、問題となる記述を排除するのです。

  そのBBCodeをOpenPNEでも採用してみようという試みのひとつとして作成したのが、
  この「BBCode入力支援モジュール」というわけです。

  phpBBやDrupal、xoopsなど、BBCodeを使用できるシステムは色々ありますが、
  本モジュールでは、それらで使用されている、種種のBBCode表記をすべて網羅
  しているわけではありません。
  しかしながら、基本的なBBCodeを記述することができますし、Firefoxの拡張
  プラグイン（BBCodeXtra https://addons.mozilla.org/ja/firefox/addon/491）
  を使用して入力することも可能です。

  既存システムへの適用は、なるべく最小限度のカスタマイズでできるように考慮
  しているつもりですが、設定などが面倒であるなどありましたら、ご報告いただ
  ければと思います。

  配布場所やOpenPNEのコミュニティなどでお声かけいただければ、できる限り、
  お返事させていただきます。:-)

    * 秘密にしたい内容（謎）の場合はメールでどうぞｗ

  Javascriptの記述の問題などで、ブラウザ依存する部分は多いと思いますし、
  ブラウザにより動きが微妙に違うなどあるかと思います。
  一応、IE6、IE7、Firefox2、Opera9では動作確認をしていますが、バージョンや
  パッチなどの若干の違いで動かないなどあるかもしれません。

  ＃Windows版Safari 3 Public Beta (3.03) でも確認してみましたが、ある程度
  ＃は動作するようです。

  本モジュールの使用にあたっては、このreadme.txtを一読し、記述内容に同意
  した上でご使用ください。

  なお、本モジュールの内容は、予告なく更新されます。

  記述内容の不備や本モジュールの不具合等による予期せぬ損害・不利益について
  は、免責事項に記したように、一切の責任を負いませんので、あらかじめご注意
  ください。


■ 2. 本モジュール以外に必要な物
--------------------------------

  (1) OpenPNE 2.6系、2.8系、2.10系 または、
      MyNETS-1.0.1系、1.1.0系、1.1.1系
  
    OpenPNE.jp　～OpenPNE公式SNS～
    http://openpne.jp/

    Usagi Project
    http://usagi.mynets.jp/

     * OpenPNE 2.8.7、2.10.2 において動作を確認しています。

     * MyNETS-1.1.0stable-20071109、MyNETS-1.1.1Nighty-20071217 において
       動作を確認しています。

     * 上記バージョンにおいても、あらゆる状態を想定したテストをしている
       わけではありませんので、不具合等存在する可能性があることを承知の
       上でご利用下さい。
       上記以外のバージョンで使用する場合においても同様です。

  (2) OpenPNEが動作するのに必要なソフトウェア

  (3) prototype.js 1.5.0以降、script.aculo.us 1.6.4以降

    カラーピッカーをドラッグ＆ドロップできるようにするために必要ですが、
    必須ではありません。設定により無効にできます。（MyNETSでは常に有効）

    OpenPNEの場合、prototype.js を入れ替えることで予期せぬ動作不良を
    起こす可能性がありますので、ご検討の上入れ替えてください。
    ＃一応動作確認済みなので大丈夫だとは思いますが。

    MyNETSの場合は、MyNETSに付属の prototype.js と script.aculo.us にて
    動作確認をしていますので、置き換えないようにしてください。
    置き換えることで問題が生じることがわかっています。

    詳細は後述。

    本アーカイブには、 prototype.js 1.6.0 と script.aculo.us 1.8.0 を
    同梱してあります。


■ 3. ファイル構成
--------------------------------

アーカイブ内のファイル構成は以下のとおりです。

./
│  add_config_php.txt
│  bbcode_smarty_test1.txt
│  bbcode_smarty_test2.txt
│  bbcode_smarty_test3.txt
│  bbcode_smarty_test_all.txt
│  bbcode_smarty_test_pnetags.txt
│  install_mynets.txt
│  install_openpne.txt
│  LICENSE
│  readme.txt
│
├─home
│  ├─css
│  │  └─bbcode
│  │          bbcode.css
│  │          bbcode_buttons.css
│  │          bbcode_tags.css
│  │
│  ├─js
│  │  └─bbcode
│  │          bbcode.cmd.js
│  │          bbcode.colorpicker.js
│  │          bbcode.controller.js
│  │          bbcode.selector.js
│  │          bbcode.taglib.js
│  │
│  ├─skin
│  │  └─bbcode
│  │          bbcode_close.gif
│  │          bbcode_closex.gif
│  │          bbcode_icons.gif
│  │          bbcode_marquee.gif
│  │
│  ├─webapp
│  │  └─lib
│  │      └─smarty_plugins
│  │              modifier.bbcode2del.php
│  │              modifier.bbcode2del4pne.php
│  │              modifier.bbcode2html.php
│  │              modifier.bbcode2html4ktai.php
│  │              modifier.bbcode2html4pc.php
│  │              modifier.bbcode2html4pne.php
│  │
│  └─webapp_ext
│      └─modules
│          └─pc
│              └─templates
│                      inc_bbcode.tpl
│                      inc_bbcode_diary_comment_on_diary.tpl
│                      inc_bbcode_event_comment_on_diary.tpl
│                      inc_bbcode_topic_comment_on_diary.tpl
│
└─openpne
    └─public_html
        └─js
            │  prototype.js
            │
            └─javascripts
                    builder.js
                    controls.js
                    dragdrop.js
                    effects.js
                    scriptaculous.js
                    slider.js
                    sound.js
                    unittest.js


■ 4. インストールから動作確認まで
----------------------------------

  (1) OpenPNEの場合

    install_openpne.txt を参照し、インストール、設定、動作確認を行って
    ください。

  (2) MyNETSの場合

    install_mynets.txt を参照し、インストール、設定、動作確認を行って
    ください。


■ 5. 既存テンプレートをBBCodeに対応させる
------------------------------------------

    既存のテンプレートを修正し、BBCodeに対応させる必要があります。
    修正するタイプとしては、５種類、携帯用を加えると６種類、メールを
    加えると７種類になります。
    
     * MyNETSの場合は、基本的に表示系の修正は必要ないようにしています。
       modifier.t_body.php内に呼び出し部分を記述してあるため、「t_body」
       修飾子を使用している箇所では、BBCode用の修飾子も呼ばれます。

     * 本当なら、削除確認系も対応したほうが良いのかも知れませんが、削除
       の場合は、生の文章を見ることができた方が良いと思い、特に対応して
       おりません。
       テンプレートのファイル名に「_delete_」と付くものにbbcode2htmlを
       適用すれば、対応できると思います。


    [1] 表示系（HTML変換あり）

      BBCodeを含む「本文」（または「詳細」「説明文」「レビュー」）を
      表示するためのテンプレートであり、BBCodeの入力を行わないもので、
      BBCodeをHTMLに変換して表示するのが妥当なテンプレートです。

      例えば、以下のテンプレートが該当します。

        c_event_list.tpl
        c_home.tpl
        c_topic_list.tpl
        fh_review_list_member.tpl
        h_review_list_product.tpl
        h_review_search.tpl

      これ以外にも、プロフィールやメッセージにもBBCode入力を行えるように
      しようと思ったら、同じようなテンプレートを見つける必要があります。

      * MyNETSの場合は、modifier.t_body.php で対応しているため、該当する
        テンプレートの修正は必要ありません。

      さて、上記のテンプレートの場合、別途用意したテンプレートで上書き
      しても良いですが、既にテンプレートに違う改良を加えている場合には、
      直接編集する必要があります。

      その場合は、例えば、「c_event_list.tpl」の変更方法ですが、中身を
      「body」で検索して、下記のような行を見つけます。

({$item.body|nl2br})

      これには、「nl2br」というプラグインが適用されていますが、更に、
      BBCodeをHTMLに変換するプラグインを追加します。

({$item.body|nl2br|bbcode2html})

      本文である「$item.body」をbbcode2html修飾子を使い、HTMLに変換して
      いるわけです。

      「$item」の部分は、機能によって異なるので、別途各バージョン用に
      用意しているテンプレートのアーカイブに含まれる、各ファイルを
      参考に変更してみてください。

      例えば、「c_home.tpl」では、「body」ではなく、「$c_commu.info」と
      「info」（説明文）になっているので注意が必要です。

      なお、基本的に、他のSmartyプラグインより前に「bbcode2del」または
      「bbcode2html」を記述するようにすると良いと思われます。
      「nl2br」とは前後しても問題ない場合がほとんどだろうと思いますが、
      他のSmartyプラグインとは、競合する可能性があるため、ご注意ください。
      変換がおかしい場合などには、順序を変更してみると良いでしょう。


    [2] 表示系（HTML変換なし）

      BBCodeを含む「本文」（または「詳細」「説明文」「レビュー」）を
      表示するためのテンプレートであり、BBCodeの入力を行わないもので、
      BBCodeを除去して表示するのが妥当なテンプレートです。

        * t_truncate修飾子などを用いて、文字列を短くしているものなど。

      例えば、以下のテンプレートが該当します。

        c_com_topic_find.tpl
        fh_comment_list.tpl
        fh_diary_list.tpl
        h_com_find_all.tpl
        h_diary_list_all.tpl
        h_com_topic_find_all.tpl

      これ以外にも、プロフィールやメッセージからもBBCode除去を行うように
      しようと思ったら、同じようなテンプレートを見つける必要があります。

      基本的に、「t_truncate」修飾子を用いて、文字列を短くするものが該当
      します。

      * MyNETSの場合は、modifier.t_body.php で対応しているため、該当する
        テンプレートの修正は必要ありません。
        ただし、diary_list_block.tpl だけは修正する必要があります。

      さて、上記のテンプレートの場合、別途用意したテンプレートで上書き
      しても良いですが、既にテンプレートに違う改良を加えている場合には、
      直接編集する必要があります。

      その場合は、例えば、「fh_diary_list.tpl」の変更方法ですが、中身を
      「body」で検索して、下記のような行を見つけます。

({$item.body|t_truncate:"120"})

      これには、「t_truncate」というプラグインが適用されていますが、その
      前にBBCodeを削除するプラグインを追加します。

({$item.body|bbcode2del|t_truncate:"120"})

      本文である「$item.body」からbbcode2del修飾子を使い、BBCodeを除去
      しているわけです。

      「$item」の部分は、機能によって異なるので、別途各バージョン用に
      用意しているテンプレートのアーカイブに含まれる、各ファイルを
      参考に変更してみてください。

      例えば、「h_com_find_all.tpl」では、「body」ではなく、
      「$c_commu_search.info」と「info」（説明文）になっているので注意が
      必要です。

      * t_truncate の後に bbcode2del を設置すると、一部のBBCodeタグが
        除去されずに残ってしまうことがあるので注意が必要です。

   [3] 新規追加・編集系（BBCode入力支援機能追加）

      BBCodeを「本文」（または「詳細」「説明文」「レビュー」）にBBCodeを
      入力するための入力支援機能を追加します。

      例えば、以下のテンプレートが該当します。

        c_edit.tpl
        c_event_add.tpl
        c_event_edit.tpl
        c_topic_add.tpl
        c_topic_edit.tpl
        h_com_add.tpl
        h_diary_add.tpl
        h_diary_edit.tpl
        h_review_add_write.tpl
        h_review_edit.tpl

      これ以外にも、プロフィールやメッセージにもBBCode入力を行えるように
      しようと思ったら、同じようなテンプレートを見つける必要があります。

      さて、上記のテンプレートの場合、別途用意したテンプレートで上書き
      しても良いですが、既にテンプレートに違う改良を加えている場合には、
      直接編集する必要があります。

      テンプレート中の「本　　文」「コミュニティ説明文」「レビュー」と
      いったような文字列を探し、その少し下に（基本的には）２行追加すれば
      ＯＫです。

      その場合は、例えば、「h_diary_add.tpl」の変更方法ですが、中身を
      「body」で検索して、下記のような行を見つけます。

       * 以下のコードは長いので「-------」で囲ってありますが、実際は
         「-------」はありません。わかりやすくしてあるだけです。

-------
<div style="padding:4px 3px;">

本　　文

</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">

<div style="padding:4px 3px;">
-------

      ここにBBCode入力支援のための記述を加えます。

-------
<div style="padding:4px 3px;">

本　　文

</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">

({* BBCode *})
({ext_include file="inc_bbcode.tpl"})

<div style="padding:4px 3px;">
-------

      長いですが、入力支援機能を追加するための、以下の３行を記入した
      だけです。（最初の１行はコメントです）

({* BBCode *})
({ext_include file="inc_bbcode.tpl"})

      後述する、詳細表示＋入力（コメント）系のものも似たような記述を
      します。


    [4] 確認系（追加、変更後の確認）

      入力した内容を確認する画面です。
      BBCodeを含む「本文」（または「詳細」、「説明文」）を表示するだけの
      テンプレートであり、BBCodeをHTMLに変換しても問題ないものです。
      表示系（HTML変換あり）とほぼ同じです。

        c_event_add_confirm.tpl
        c_event_write_confirm.tpl
        c_topic_add_confirm.tpl
        c_topic_write_confirm.tpl
        fh_diary_comment_confirm.tpl
        h_com_add_confirm.tpl
        h_diary_add_confirm.tpl
        h_diary_edit_confirm.tpl
        h_review_add_write_confirm.tpl

      これ以外にも、プロフィールやメッセージにもBBCode入力を行えるように
      しようと思ったら、同じようなテンプレートを見つける必要があります。

      * MyNETSの場合は、modifier.t_body.php で対応しているため、多くは
        テンプレートの修正は必要ありません。
        c_event_add_confirm.tpl と h_review_add_write_confirm.tpl のみ
        修正が必要です。（MyNETS1.1.0の場合は前者の修正は不要）

      さて、上記のテンプレートの場合、別途用意したテンプレートで上書き
      しても良いですが、既にテンプレートに違う改良を加えている場合には、
      直接編集する必要があります。

      その場合は、例えば、「h_diary_add_confirm.tpl」の変更方法ですが、
      中身を「body」で検索して、下記のような行を見つけます。

({$form_val.body|nl2br})

      これには、「nl2br」というプラグインが適用されていますが、更に、
      BBCodeをHTMLに変換するプラグインを追加します。

({$form_val.body|nl2br|bbcode2html})

      本文である「$form_val.body」をbbcode2html修飾子を使い、HTMLに変換
      しています。

      「$form_val」の部分は、フォームから入力された値を意味しますが、
      機能によって異なる可能性があるので、別途各バージョン用に用意して
      いるテンプレートのアーカイブに含まれる、各ファイルを参考に変更
      してみてください。

      例えば、「h_com_add_confirm.tpl」では、「body」ではなく、
      「$form_val.info」と「info」（説明文）になっていますが、それ以外
      は「～.body」をターゲットに探せば見つかるはずです。


    [5] 詳細表示＋入力（コメント）系（BBCode入力支援機能追加）

      指定されたイベントやトピック、日記などを表示しつつ、そこにコメント
      を入力していくテンプレートです。
      「本文」などのBBCodeをHTMLに変換して表示するだけでなく、「本文」
      （または 「詳細」「説明文」「レビュー」）にBBCodeを入力するための
      入力支援機能も追加します。

      例えば、以下のテンプレートが該当します。

        c_event_detail.tpl
        c_topic_detail.tpl
        fh_diary.tpl

      これ以外にも、プロフィールやメッセージにもBBCode入力を行えるように
      しようと思ったら、同じようなテンプレートを見つける必要があります。

      さて、上記のテンプレートの場合、別途用意したテンプレートで上書き
      しても良いですが、既にテンプレートに違う改良を加えている場合には、
      直接編集する必要があります。

      BBCodeをHTMLに変換する修飾子bbcode2htmlを追加するのは、今まで同様、
      「～.body」をターゲットに探せば見つかるはずです。

      入力支援機能は、テンプレート中の「本　　文」を探し、その少し下に
      （基本的には）２行追加すればＯＫです。

      その場合は、例えば、「fh_diary.tpl」の変更方法ですが、中身を
      「body」で検索して、下記のような行を見つけます。

({$target_diary.body|nl2br|t_url2cmd:'diary'|t_cmd:'diary'})

      これは日記の本文であり、「nl2br」などのプラグインが適用されて
      いますが、更に、BBCodeをHTMLに変換するプラグインを追加します。

({$target_diary.body|nl2br|bbcode2html|t_url2cmd:'diary'|t_cmd:'diary'})

      さらに、日記についたコメントの本文のBBCodeをHTMLに変換する必要も
      ありますので、再度、「body」で検索して、下記のような行を見つけ
      ます。

({$item.body|nl2br|t_url2cmd:'diary'|t_cmd:'diary'})

      これがコメントの本文であり、「nl2br」などのプラグインが適用されて
      いますが、更に、BBCodeをHTMLに変換するプラグインを追加します。

({$item.body|nl2br|bbcode2html|t_url2cmd:'diary'|t_cmd:'diary'})

      本文である「$target_diary.body」「$item.body」をbbcode2html修飾子
      を使い、HTMLに変換しているわけです。

      「$target_diary」「$item」の部分は、機能によって異なるので、別途
      各バージョン用に用意しているテンプレートのアーカイブに含まれる、
      各ファイルを参考に変更してみてください。

      以上は表示に関する修正ですが、BBCode入力を行えるようにするための
      修正も必要となります。
      再度、中身を「body」で検索して、下記のような行を見つけます。

       * 以下のコードは長いので「-------」で囲ってありますが、実際は
         「-------」はありません。わかりやすくしてあるだけです。

-------
本　　文

</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">
<div style="padding:4px 3px;">
-------

      ここにBBCode入力支援のための記述を加えます。

-------
本　　文

</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">

({* BBCode *})
({ext_include file="inc_bbcode.tpl"})

<div style="padding:4px 3px;">
-------

      長いですが、入力支援機能を追加するための、以下の３行を記入した
      だけです。（最初の１行はコメントです）

({* BBCode *})
({ext_include file="inc_bbcode.tpl"})


    [6] 携帯での表示系（HTML変換あり）

      携帯では、BBCode入力支援は行いませんので、表示のみとなります。

      Ver.0.5.0までは、BBCodeを除去して表示していましたが、Ver.0.6.0から
      は、ある程度、携帯でも表示可能なHTMLタグに変換して表示するように
      仕様を変更しました。

      基本的には、「[1] 表示系（HTML変換あり）」と同じ処置を施します。

      以下のテンプレートが該当します。

      c_bbs.tpl
      fh_diary.tpl

      * MyNETSの場合は、modifier.t_body.php で対応しているため、該当する
        テンプレートの修正は必要ありません。

      さて、上記のテンプレートの場合、別途用意したテンプレートで上書き
      しても良いですが、既にテンプレートに違う改良を加えている場合には、
      直接編集する必要があります。

      その場合は、例えば、コミュニティのテンプレート「c_bbs.tpl」の変更
      方法ですが、中身を「body」で検索して、下記のような３つの行を見つ
      けて、それぞえを修正します。

({$c_commu_topic.body|t_url2a_ktai|nl2br})<br>

      を以下のように修正。

({$c_commu_topic.body|bbcode2html|t_url2a_ktai|nl2br})<br>

({$c_commu_topic.body|t_url2a_ktai|nl2br})<br>

      を以下のように修正。

({$c_commu_topic.body|bbcode2html|t_url2a_ktai|nl2br})<br>

({$item.body|t_url2a_ktai|nl2br})<br>

      を以下のように修正。

({$item.body|bbcode2html|t_url2a_ktai|nl2br})<br>

      基本的に、Smartyプラグインの最初に「bbcode2html」を記述するように
      すると良いと思われます。

      「$c_commu_topic」「$item」の部分は、機能によって異なるので、別途
      各バージョン用に用意しているテンプレートのアーカイブに含まれる、
      各ファイルを参考に変更してみてください。

      例えば、日記のテンプレート「fh_diary.tpl」の場合は、以下のように
      修正します。

({$target_c_diary.body|t_url2a_ktai|nl2br})<br>

      を以下のように修正。

({$target_c_diary.body|bbcode2html|t_url2a_ktai|nl2br})<br>

({$c_diary_comment_.body|t_url2a_ktai|nl2br})<br>

      を以下のように修正。

({$c_diary_comment_.body|bbcode2html|t_url2a_ktai|nl2br})<br>


    [7] メール系（HTML変換なし）

      コミュニティ書き込みを“PCメール”または“携帯メール”で受け取る
      場合に、トピック・イベントの情報（「本文」など）を出力するための
      テンプレートです。
      BBCodeを除去して表示するのが妥当なテンプレートです。

      例えば、以下のテンプレートが該当します。

        m_ktai_bbs_info.tpl
        m_pc_bbs_info.tpl

      さて、上記のテンプレートの場合、別途用意したテンプレートで上書き
      しても良いですが、既にテンプレートに違う改良を加えている場合には、
      直接編集する必要があります。

      その場合は、例えば、「m_ktai_bbs_info.tpl」の変更方法ですが、中身
      を「body」で検索して、下記のような行を見つけます。

({$body})

      このままでは、BBCodeが変換されずにメールとして送られてしまいます
      ので、BBCodeを削除するプラグインを追加します。

({$body|bbcode2del})

      本文である「$body」からbbcode2del修飾子を使い、BBCodeを除去して
      いるわけです。


■ 6. OpenPNE用独自BBCodeタグを有効化する
-----------------------------------------

    以下の設定で、config.phpに設定を追加しても、設定が反映されないと
    思われる事態に遭遇するかも知れません。
    inc_bbcode.css が既にコンパイル済みだと反映されない場合があります
    ので、var/templates_c ディレクトリ以下を空にしておいた方が良いかも
    知れません。

   [1] 独自タグについて

    通常、SNS内のリンクを日記などに貼り付けた場合、

    http://SNSのURL/?m=pc&a=page_fh_diary&target_c_diary_id=4649&comment_count=39

    などというように、URLを絶対パスで記述することになります。
    しかし、このように記述した場合は、日記を表示した際、上記のURLに対し
    べったりとリンクが張られて長たらしく表示されるだけです。

    例えば、上記のようにURLを記述した場合、MyNETSでは、「t_url2pne」
    修飾子が働いて、

    <a href="上記URL">【日記タイトル】(メンバー名さん-2007-08-08 00:00:00)</a>

    というように、上記のURLへのリンクが張られるため、どのような日記に
    リンクが張られているか一目でわかり、かつ非常に見やすくなります。

    また、上記のようにURLを記述すると、データベースに格納される文字数
    が長くなるため、私的にはあまり面白くありません(笑)

    そこで、MyNETSの良いところと、BBCodeタグを組み合わせ、OpenPNE独自の
    BBCodeタグを作成しました。

    [member]    ... メンバーのプロフィールへの簡易リンク
    [diary]     ... 日記への簡易リンク
    [topic]     ... トピックへの簡易リンク
    [event]     ... イベントへの簡易リンク
    [commu]     ... コミュニティへの簡易リンク。[community]も同じ効果
    [review]    ... レビューへの簡易リンク

    [member]1[/member] というように記述しておけば、BBCodeからHTMLに変換
    して表示する際に、メンバーIDが1のメンバーのプロフィールへのリンクが
    自動的に生成されます。
    [diary]や[commu]なども同様で、日記やコミュニティのIDが記述されていれ
    ば、その日記などへのリンクが生成されます。

    リンクのされ方は、独自の表示の仕方

    <a href="URL">【日記タイトル】（メンバー名さん）</a>

    となります。

    MyNETSの場合は、config.phpの設定で、MyNETS本来の表示方式を選ぶこと
    も可能です。
    MyNETSで携帯から利用している場合は、常にMyNETS本来の表示方式で表示
    されます。


   [2] 独自タグの入力方法

    入力方法は、直接IDを記述する方法も可能ですが、「リンクを挿入」ボタン
    からの入力を推奨します。（URLをプロンプトに貼り付けて入力する方法）

    「リンクを挿入」ボタンから入力した場合、URLを解析して、SNS内の独自
    タグが使用可能なURLであった場合は、独自タグに変換して、本文やコメント
    に挿入されるようになっています。
    例えば、

    http://SNSのURL/?m=pc&a=page_fh_diary&target_c_diary_id=4649&comment_count=39

    というURLを貼り付けた場合は、日記のURLであると判断し、IDを抽出して、

    [diary]4649[/diary]

    という文字列が本文またはコメントに挿入されます。


   [3] 独自タグの使用を有効にする

    独自タグの使用を有効にするためには、config.phpの末尾あたりに、設定
    を追記する必要があります。

    config.php の最後当たりに、

define('BBCODE_USE_PNE_TAG',true);

    と一行記述することで、有効になります。
    ＃true → false にすることで、無効化することもできます。

    この一行を記述しないと有効になりませんので、ご注意ください。
    この記述を行わない場合は、「リンクを挿入」ボタンからSNSのURLを貼り
    付けても、通常のURLとして処理します。

    設定内容は、add_config_php.txt ファイルとして用意しましたので、参考
    にしてください。


   [4] 独自タグ用のリンク表示方式ではなく、MyNETSの表示方式を優先する

    リンクのされ方は、独自の表示の仕方

    <a href="URL">【日記タイトル】（メンバー名さん）</a>

    がデフォルトとなっていますので、設定を変更しない限りそのままです。

     * MyNETSで携帯を使用している場合は、常にMyNETSの表示方式です。

    OpenPNEの場合は、独自の表示方式以外に選択肢がありませんので、独自
    方式のままご使用ください。

    MyNETSの場合は、MyNETSの表示方式「t_url2pne」修飾子を優先させる
    ことができます。
    config.php の最後当たりに、

define('BBCODE_USE_T_URL2PNE',false);

    と一行記述することで、有効になります。
    この一行を記述しないと有効になりませんので、ご注意ください。
    ＃true → false にすることで、無効化することもできます。

    設定内容は、add_config_php.txt ファイルとして用意しましたので、参考
    にしてください。


   [5] 「ドッチ」モジュールへのリンクも簡易にしてみる

    「ドッチ」モジュール
    http://openpneplus.sourceforge.jp/

    を使用している場合、BBCode入力支援モジュールで「ドッチ」モジュール
    用の独自タグを使用することができます。
    他のタグ同様、[docci]1[/docci] のようになります。

    config.php の最後当たりに、

define('BBCODE_USE_DOCCI_TAG',false);

    と一行記述することで、有効になります。
    この一行を記述しないと有効になりませんので、ご注意ください。
    ＃true → false にすることで、無効化することもできます。

    設定内容は、add_config_php.txt ファイルとして用意しましたので、参考
    にしてください。


■ 7. トピック・イベント・日記に『日記でコメント』ボタンを配置
--------------------------------------------------------------

    折角の独自タグも、「リンクを挿入」ボタンから貼り付けるのでは、
    一手間余計に作業が発生するので、あまり使われないかも知れません。
    OpenPNEにMyNETS同様の機能が搭載されるまでのつなぎにはなると思います
    が、やはり面倒ではあります。

    そこで、トピックとイベント、日記限定になりますが、各詳細表示のページ
    に「日記でコメント」ボタンを表示する機能を用意しました。
    トピックの本文や日記の本文の下に表示されます。

    「日記でコメント」ボタンを押下すると、新規に日記を書くための、新たな
    ウインドウが起動します。
    タイトルには、コメントを付けようと思ったトピックや日記のタイトルを
    一部取り込んだものが初期状態でセットされ、本文には、独自タグが埋め
    込まれた状態になります。
    
    現状では、トピックなどへ自動的にコメントを投稿するようなトラック
    バック的な機能は存在しません。
    普通に日記を書くだけになってしまいますが、日記を書いた後で、その
    日記のURLを、元のトピック等のコメント欄に貼り付ければ、手動による
    トラックバックとして利用できると思います。たぶん(笑)

    さて、このボタンの表示には、config.phpの設定が必要です。

    まず、必要なテンプレートファイルをを設置した後、config.php の最後
    当たりに、

define('BBCODE_USE_DIARY_COMMENT_ON_DIARY',true); //日記にボタンを表示
define('BBCODE_USE_TOPIC_COMMENT_ON_DIARY',true); //トピックにボタンを表示
define('BBCODE_USE_EVENT_COMMENT_ON_DIARY',true); //イベントにボタンを表示

    と記述することで、ボタンの表示が有効になります。

    また、次のような設定を行うことで、本文を引用するか否かも指定でき
    ます。

define('BBCODE_USE_DIARY_COMMENT_ON_DIARY_WITH_BODY',true); //本文引用の有無（日記）
define('BBCODE_USE_TOPIC_COMMENT_ON_DIARY_WITH_BODY',true); //本文引用の有無（トピック）
define('BBCODE_USE_EVENT_COMMENT_ON_DIARY_WITH_BODY',true); //本文引用の有無（イベント）

    メンバーがどのような動作が好みかにもよりますので、お好みで指定して
    みてください。


■ 8. BBCodeタグについて
------------------------

  ★現在、正式（？）対応しているBBCode

    太字         [b]text[/b]
    斜体         [i]text[/i]
    下線         [u]text[/u]
    打ち消し     [s]text[/s]
    添え字       [sub]text[/sub]
    上付き文字   [sup]text[/sup]
    文字色       [color=#ff0000]text[/color]
                 [color=red]text[/color]
    ハイライト   [highlight]text[/highlight]
    文字サイズ   [size=xx-large]text[/size]
                 [size=10pt]text[/size]
    中央寄せ     [center]text[/center]
    右寄せ       [right]text[/right]
    引用         [quote]text[/quote]
    コード       [code]text[/code]
    インデント   [indent]text[/indent]
                 [indent=2em]text[/indent]
    無効化       [noparse]BBCode[/noparse]
    箇条書き     [list][*]text[/list]
                 [list=1][*]text[/list]
    画像         [img]http://url[/img] 
    URL          [url]http://url[/url]
                 [url=http://url]text[/url]
    スクロール   [marquee]text[/marquee]
                 [marquee=alternate]text[/marquee]

    BBCodeタグの入力支援に関する設定は bbcode.taglib.js を変更すれば
    良いようにしてあるので、文言などについては、ご自由に変更してくだ
    さい。

     * bbcode2htmlには、入力支援を行っている以外のBBCodeも存在するので、
       [email]や[font]なども使用可能です。
       ただ、SNS的に、それが意味があるのかどうかとかあるので、前面には
       出していません(笑)

       隠し(?)タグ

         [email] ... メールアドレス
         [font]  ... 'MS 明朝' などのフォント指定
         [tt]    ... 等幅
         [left]  ... 左寄せ（通常左寄せなので入力からは除外してある）
         [s] と同じ意味のタグ [strike] [del] [linethrough]
         [b] と似たタグ [strong] （太字ではなく強調の意味）
         [i] と似たタグ [em] （斜体ではなく強調の意味）
         [right][center] と役割が同じ [align=～]
         [code] と役割が同じ [php] [phpsrc]
         [noparse] と [code] の合成要素 [bbcode]
         [marquee] の省略形である [marq]

           -> 詳しくは modifier.bbcode2html4pc.php 参照
           -> inc_bbcode.php、bbcode.css、bbcode_buttons.css
              bbcode.taglib.js あたりをカスタマイズすれば
              使えるものを変更したり、追加したり、ヘルプを
              書き換えたりできます。

  ★[img]タグについて

    画像の表示は、Javascriptで（document.writeで）行っています。
    環境によっては上手く動かないかも知れません。
    JavascriptがOffになっていると、通常の自動リンクで表示されます。

    画像のURLを入力するのに、Javascriptのpromptを使っています。
    やはり、環境によってはpromptが表示されないとかあるかも知れません。

    なお、bbcode2htmlのソースを見ればわかりますが、引数が３つあり、
    ２つ目と３つ目が画像に関わる引数です。

    テンプレートを変更し、例えば、
      ({$form_val.body|nl2br|bbcode2html:TRUE:FALSE})
    なんて記述にすると、[img]タグだけ除外します。
      ({$form_val.body|nl2br|bbcode2html:TRUE:TRUE:200})
    なんて記述にすると、画像の横幅が 200 に設定されます。
    （デフォルトは 120 です）

    ちなみに、「画像を挿入」ボタンからURLを貼り付けた場合、GIFやPNG、
    JPEGファイルなどの拡張子でない場合、無視することがあります。

  ★[url]タグについて

    画像と同様、アンカーの表示をJavascriptで（document.writeで）行って
    います。環境によっては上手く動かないかも知れません。
    JavascriptがOffになっていると、通常の自動リンクで表示されます。

    URLを入力するのに、Javascriptのpromptを使っています。
    やはり、環境によってはpromptが表示されないとかあるかも知れません。

    また、文字列を選択していたら、promptを表示してURLを入力させた後、
    選択していた文字列を[url]タグで挟み、
      [url=入力したURL]文字列[/url]
    という形式で貼り付けるようにしています。

      * 簡易リンク機能が組み込んであり、OpenPNE用独自タグを使用する
        設定（config.phpに記述）にしてあると、日記やトピックのURLを
        貼り付けようとした場合、[url]ではなく、独自タグに変換します。

    これがアンカータグに変換され、かつ、OpenPNEのURL自動リンク機能を
    回避するので、
      <a href="url">ここをクリック</a>
    などというのと等価に扱えます。

    念のためですが、文字列の部分を偽装して、悪意を持ってクリックさせる
    たぐいの人がいるかもしれないので、とりあえずの対策はしました。
    単に文字列部分に http or https があれば、除去するようにしている
    だけですが、多少なりと防げればという感じです。

      * [url=http://adultsite.kiken.xx/]http://example.com/[/url]
        などというのも可能ではあるので。

    リンク上にマウスを持っていくと、ステータスバーにリンク先が表示さ
    れますが、ステータスバーがそもそも非表示という場合も考え、チップ
    ヘルプも出るようにしてあります。

    なお、bbcode2htmlのソースを見ればわかりますが、引数が３つあり、
    １つ目がURLに関わる引数です。

    テンプレートを変更し、例えば、
      ({$form_val.body|nl2br|bbcode2html:FALSE})
    と記述にすると、[url]タグだけ除外します。
    ２つ目は[img]タグに関わる引数ですが、デフォルトがTRUEなので、
    [img]タグは有効になります。

  ★[quote]タグについて

    スタイルが好みの分かれるところだと思います(笑)
    bbcode_tags.css の bb-blockquote、bb-quote-marks、bb-quote あたり
    を変更すれば、お好みのスタイル、色などに変更できるでしょう。:-)

  ★[marquee]について
  
    [marquee=slide]も使用可能ですが、Mozilla系ブラウザ（Firefox、
    NetscapeなどのGeckoエンジン）では、[marquee=left]や[marquee=scroll]
    と同じ動作になります。
    [marq]と省略形を用いることもできます。

  ★[color]タグ、[highlight]タグについて

    簡易的なカラーピッカーを搭載していますが、動作がよろしくないかも。
    通常は、代表的なカラー（70色）からの選択で、216色のWebセーフカラー
    からの選択にも変更可能ですが、環境依存はしないと思います。

    若干コードの修正が必要になりますが、

     (1) 216色全部を表示するパターン
     (2) 216色＋ピックアップした12色を表示するパターン
     (3) カラーパレットで表示されるような代表的なカラー（70色）パターン

    を用意したので、bbcode.controller.js のcolor_pallet_popup関数内での
    処理を変更すれば、好きなパターンに変えられます。（通常は(3)です）
    内容がわかれば表示のさせ方も自由に変更できます。

    なお、カラーピッカーではなく、カラーネームから選択するパターン
    （SELECTタグで選択）も使用可能ですが、inc_bbcode.tplも修正が必要に
    なります。
    携帯のことを考えると、カラーネームからの選択の方が良いのかもしれま
    せん。（それもまた環境に依存するでしょうが）

  ★[size]タグについて

    Ver.0.5.0までは、[size=12pt]などというように、ポイントによる絶対指定
    でしたが、Ver.0.6.0からは、[size=xx-large]というように相対的なサイズ
    指定に変更しました。

      xx-small ... 最小
      x-small  ... 小
      small    ... やや小
      medium   ... 中
      large    ... やや大
      x-large  ... 大
      xx-large ... 最大

    携帯を意識してのことなのですが、上記のサイズ指定だと、ブラウザにより
    標準となるサイズが変わってしまいます。（通常は「medium」が標準だが、
    ブラウザによっては「small」が標準となる）

    そのため、実際のサイズは、ブラウザに依存しないよう CSSファイルで
    クラス（bb-size-xx-smallなど）として設定しています。
      <span style="font-size:xx-small;">最小</span>
    のようにサイズ指定しているわけではなく、
      <span class="bb-size-xx-small">最小</span>
    とういようにclassでサイズ指定しているのです。

    これにより、CSSファイル bbcode_tags.css の該当箇所を変更すれば、自由
    にサイズを設定することができます。（x-largeをもっと大きくするなど）
    初期設定は、CSS2.1に基づき、パーセンテージでサイズ指定しています。

	| Fonts
	| http://www.w3.org/TR/CSS21/fonts.html
	| font-size
	| http://w3g.jp/css/font/font-size
	| CSS1 の仕様では7段階ある内の1段階大きく表示されるキーワードごとに1.5倍の比率となる
	| 実装が推奨されていましたが、CSS2 の仕様では1段階大きくなるごとに1.2倍の比率となる
	| 実装が推奨されていました。しかし、改訂版の CSS2.1 の仕様では1.5倍や1.2倍といった
	| 固定比率は推奨しないと見直され、UA は下記の h1-h6要素、および font要素との対照表を
	| 参照するように推奨されています。
	| 絶対指定   xx-small x-small small medium large x-large xx-large
	| h1～h6要素 h6               h5    h4     h3    h2      h1
	| font要素   1                2     3      4     5       6         7
	| %          60%      75%     88.8% 100%  120%   150%    200%      300%

  ★[noparse]タグについて

    BBCodeを無効化するためのタグですが、URLへの自動リンクも無効化でき
    ます。

    http://example.com/

    と記述すると、通常は

    <a href="http://example.com/">http://example.com/</a>

    と自動リンクが張られてしまいますが、

    [noparse]http://example.com/[/noparse]

    とすると、リンクのない

    http://example.com/

    という文字列だけが表示されます。
    ＃「:」を「&#35;」に変換して自動リンクを回避している

  ★独自タグ [member][diary][topic][event][commu][community][review]

    独自タグを有効にした場合に使用可能な、簡易リンク用の独自タグです。
    「リンクを挿入」ボタンにより、日記やトピックのURLを貼り付けようと
    した場合、[url]ではなく、独自タグに変換します。

    [member]    ... メンバーのプロフィールへの簡易リンク
    [diary]     ... 日記への簡易リンク
    [topic]     ... トピックへの簡易リンク
    [event]     ... イベントへの簡易リンク
    [commu]     ... コミュニティへの簡易リンク。[community]も同じ機能
    [review]    ... レビューへの簡易リンク

    [member]1[/member] というように記述しておけば、BBCodeからHTMLに変換
    して表示する際に、メンバーIDが1のメンバーのプロフィールへのリンクが
    自動的に生成されます。
    [diary]や[commu]なども同様で、日記やコミュニティのIDが記述されていれ
    ば、その日記などへのリンクが生成されます。

  ★独自タグ [docci]

   「ドッチ」モジュール用のタグを有効にした場合に使用可能な、簡易リンク
   用の独自タグです。
    「リンクを挿入」ボタンにより、日記やトピックのURLを貼り付けようと
    した場合、[url]ではなく、独自タグに変換します。


■ 9. 著作権・ライセンス・利用規定・再頒布等について
----------------------------------------------------

  以下の内容に同意していただいた上で、本モジュールをご利用ください。

(1) ライセンスについて

  本モジュールは、The PHP License, version 3.01に準じたオープンソース
  のフリーソフトウェアとして公開します。

  PHPライセンスに基づいてご利用いただく限りは、変更の有無や商用・非商用
  有無を問わず、またその用途を問わず、ソースコードおよびバイナリの再頒布
  および使用を許可します。

  なお、PHPライセンスに基づき、本モジュールの使用に起因する一切の直接・
  間接的存在、不利益、不法行為（過失その他を含む）のいずれであろうとも、
  作者は一切の責任を負いません。
  「10. 免責事項」で補足説明する内容の通りです。

(2) 配布・再頒布について

  PHPライセンスに基づき、転載・再頒布は自由です。
  以下、補足説明です。

  [ 配布について ]

    以下のURLで配布します。

    http://shima3.seesaa.net/

    または、

    http://usamimi.sourceforge.jp/

    前者は「仮」の置き場所です。
    確定するまでは上記URLのいずれかで配布いたします。

  [ 転載・再頒布について ]

    転載および再頒布は、本モジュールのアーカイブの中身を変更せずに行って
    ください。
    中身が同じであれば、アーカイブの形式を変更してもかまいません。

  [ 改良後の配布について ]

    本モジュールのアーカイブを添付するか、あるいは、本readme.txtコピー
    （名前の変更可）を添付する形で配布するようにしてください。
    少なくとも、著作権表示、本条件項目、および下記の免責条項をソース
    コード内に記載するようにしてください。
    これは、本モジュールの配布場所が確定していないためであり、確定後
    は、改良元となった本モジュールの配布場所がどこであるかを説明書など
    に既述していただくだけでも問題ありません。

(3) 著作権

  ・本モジュールの著作権は、しまさんこと Naoya Shimada に帰属します。
  ・なお、OpenPNEもしくはMyNETS本体に由来する一部のソースの著作権は、
    OpenPNEプロジェクト、またはUsagi Projectに帰属します。
  ・また、上記以外にも、本モジュールには、一部のファイル（PHPファイル
    やJavascipt、画像ファイルなど）について、作者が著作権を持たない
    ものが含まれます。
    以下のとおりです。

      [1] Prototype JavaScript framework
          http://www.prototypejs.org/
           ・prototype.js

      [2] script.aculo.us
          http://script.aculo.us/
           ・builder.js
           ・controls.js
           ・dragdrop.js
           ・effects.js
           ・scriptaculous.js
           ・slider.js
           ・sound.js
           ・unittest.js

(4) お願い

  以下は、規約ではなく、単なる個人的なお願いです。
  ライセンスに追加適用される条項ではなく、禁止事項・強制事項でもありま
  せん。

  本モジュールを改良してリリースする場合や機能の一部として取り込む場合
  などにおいて、本条件を適用する必要は全くありません。

  [1] 以下に当てはまる場合は、本モジュールの使用をご遠慮ください。

    ・いわゆる「アダルト」なジャンルのサイト・SNSである
    ・いわゆる「出会い系」のジャンルのサイト・SNSである
    ・いわゆる「カルト宗教」による、またはそれに関するサイト・SNSである
    ・暴力的・差別的なジャンルのサイト・SNSである
    ・犯罪を助長する恐れが著しくあるサイト・SNSである。

    単に、良心に対する訴えかけに過ぎませんので、禁止事項とまでは行き
    ません。
    大体、３番目や５番目が守られるとも思っていないので。

  [2] 以下に当てはまる場合は、ご連絡いただければ幸いです。（非強制）

    ・OpenPNEもしくはその派生プロジェクトで本モジュールを正式採用する
    ・商用・非商用によらず、サイト・SNS等において本モジュールを使用する
    ・サイトやブログなどで取り上げる、あるいは雑誌等に掲載する
      （作者のブログへのトラックバックも連絡の内に入ります）
    ・本モジュールがSNSメンバーに好評（不評）である
    ・カスタマイズして欲しい
    ・改造・改良してみた
    ・転載・再頒布した

    以上は、単に作者の自己満足のために知りたいことが主なので、強制では
    ありませんので、ご注意ください。
    ご連絡いただければ、作者のブログなどでリンクを貼るなどさせていた
    だくなど、相互に有益な関係が築ければ幸いと考えています。
    よろしくお願いします。


■ 10. 免責事項
---------------

  下記の内容は、PHPライセンスに準じた本モジュールの規約を補足説明する
  ものであって、ライセンスに追加適用される条項ではありません。
  下記については、「9. 著作権・ライセンス・利用規定・再頒布等について」
  において、PHPライセンスとして示した条項で定めるとおりです。

  (1) 自己責任による利用についての同意

    本モジュールは無保証です。市場性及び特定目的適合性についての暗黙の
    保証を含めて、いかなる保証も行ないません。
    また、本モジュールの使用に起因する一切の損害、不利益、違法行為
    （過失その他を含む）のいずれであろうとも、作者は一切の責任を負い
    ません。
    作者がそのような損害や違法行為などの発生する可能性について知らされ
    ていた場合も同様です。
    自己責任においてご使用ください。

  (2) 違法行為における責任の所在

    作者は、犯罪行為を助長するようなサイト、ブログ、SNSなどを容認する
    ものではありませんが、例え、そのような目的で本モジュールが使用され
    たとしても、作者は一切の責任を負いません。
    そのような目的で使用した人（サイト開設者または利用者）自身の問題で
    あって、本モジュールに直接的に起因するものではありません。
    過失その他による違法行為についても同様です。

  (3) 開発の中止

    本モジュールは、予告なく、開発を中止する可能性があります。
    不具合の修正等についても同様です。

    また、OpenPNEまたはMyNETS自体がBBCodeなどの入力補助に対応した時点
    で、開発を中止する予定です。
    OpenPNEあるいはMyNETS自体が対応した場合は、そちらの機能をご使用く
    ださい。


■ 11. Special Thanks
---------------------

  OpenPNE.jp　～OpenPNE公式SNS～
  [勝手に機能拡張コミュ] トピック - ユーザにもHTMLを使わせるには
  http://openpne.jp/?m=pc&a=page_c_topic_detail&target_c_commu_topic_id=1281&all=1

  ↓これらをお手本に一から書き直しました。m(__)m

  modifier.bbcode2html.phpファイル
  http://smarty.incutio.com/?page=BBCodePlugin
  Smarty :: View topic - Modifying BBCODE2HTML
  http://www.phpinsider.com/smarty-forum/viewtopic.php?p=28598&sid=5823a64bd9381354b451b12d380683ce

  ↓Ver.0.5.0から対応したMyNETSについての言及。

  Usagi project サポート掲示板 / 拡張モジュールについて
  http://usagi.mynets.jp/SBBS/upmsk_pc.cgi?mode=al2&mo=128&namber=112&space=60&rev=0&page=0&no=0


  その他参考にしたサイト、ブログは数知れず・・・m(_ _)m

  * 一番参考になったのは、[勝手に機能拡張コミュ]かな。


■ 12. 開発環境／テスト環境など
-------------------------------

  Windows XP Professional Service Pack 2

    XAMPP Windows版 1.6.4
      * Apache 2.2.6, MySQL 5.0.45, PHP 4.4.7

    Internet Explorer 7 / Internet Explorer 6.0
    Firefox 2.0.0.11 + Sage 1.3.10 + Wizz RSS 2.1.9
    Sleipnir 2.6.1 + Headline-Reader Plugin  1.2.3
    Opera 9.25 / Headline-Reader Lite 1.03d
    
      * おまけで、Windows版 Safari 3.0.4 Public Beta


■ 12. その他（独り言）
-----------------------

  あくまで実験的なものなのですので、ご容赦のほどを。

  色々改良点はあるので、画像等、ご自由に入れ替えてご使用ください。
  そこら辺は皆様にお任せします。m(_ _)m

  OpenPNE/MyNETS本体側のテンプレートの修正については、本モジュールに
  含めるとバージョンアップの都度変更が必要になって大変なので、分離しま
  した。
  別途ダウンロードして使用するか、手動で適用してください。

  OpenPNEとMyNETSでは、仕様が異なるため、微調整したりした結果が散見され
  ますが、残骸などがあればご指摘いただければ幸いです。

  Ver.0.8.0で、小窓ボタンを追加してみましたが、サービス側で用意されて
  いる「ブログに貼る」などからコピー＆ペーストし、その結果を正規表現で
  マッチングさせて、URL2CMDまたはCMDタグで有効な形に整形しています。

  そのため、サービス側で提供される文字列が変更されるなどすると、整形
  できなくなる場合があります。
  その場合はお知らせいただければ対応します。

  また、コピー＆ペーストできるのは、それが１行で表示されている場合に
  限ります。途中で改行されている場合は整形できない場合があります。
  何らかの形で解消できればと思っていますが、それは次期バージョンで
  ということで・・・（0.9.0かな）

  なお、作者は、下記の場所に出没するらしいです。
  見かけても、そっとしておいてください(笑) ＞ 声かけてくださいｗ

  OpenPNE コニュニティ
    http://openpne.jp/

  Usagi Project
    http://usagi.mynets.jp/


■ 13. 開発履歴
---------------

2007/12/26 Ver 0.8.1
・Operaでリスト、URL、画像、メールアドレス、小窓のボタンが機能しない
  問題を修正（bbcode.controller.js）
・IEでメールアドレスボタンを押すとエラーになる場合がある問題を修正
  （bbcode.taglib.js）

2007/12/24 Ver 0.8.0
・OpenPNE 2.8.7、2.10.2、MyNEMyNETS-1.1.1に対応
・クロスサイトスクリプティング対策
・スタイルシートとJavascriptの配置を変更
・日記でコメントボタンが正常に動作しないため修正
・ALPSLAB clip!のYahoo! blog用のタグに対応 
・prototype.js 1.6.0、script.aculo.us 1.8.0のJavascriptに入れ替え
  （MyNETSだと問題が発生するので入れ替えないこと）
・URL2CMD、CMDタグに必要な情報を取り出して貼り付ける、小窓ボタンを
  実装（bbcode.cmd.js）

2007/10/22 Ver 0.7.2
・OpenPNE 2.10RC1 に対応
・PeeVee.TVのYahoo!ブログ用のembedタグの変換を間違ったまま添付していた
  ので修正、同時に、PhotobucketのBBCodeタグを変換する処理を追加
  （modifier.bbcode2html4pc.php、modifier.bbcode2html4ktai.php、
  modifier.bbcode2del.phpの３ファイル）

2007/10/17 Ver 0.7.1
・OpenPNE 2.6.11、2.10β2 に対応
・IEの場合、クリップボードからプロンプトに自動的にコピー＆ペーストする
  ように仕様変更（bbcode.controller.js）
・ちょっとおまじないをしてみた
  （bbcode.colorpicker.js、bbcode.controller.js、bbcode.selector.js）
・PeeVee.TVのYahoo!ブログ用のembedタグを変換するようにした
  （modifier.bbcode2html4pc.php に変換処理追加）

2007/10/09 Ver 0.7.0
・MyNETSでもscript.aculo.usの使用有無を利用可能に変更
・日記、トピック、イベントに「日記でコメント」欄を追加
  （テンプレートを３つ追加し、config.phpの設定項目も増やした）
・「日記でコメント」欄追加に伴い、restopicsbutton.js、resdiarybutton.js
  を削除
・ボタン用アイコン画像を１画像にまとめ、スタイルシートで表示をずらして
  ボタンとして表示するようにした（MARQUEE用画像、閉じる画像除く）

2007/09/21 Ver 0.6.5
・カスタマイズしてある環境で問題が生じるという報告があり、また拙作某
  小窓の設置でも発生したため、bbcode.controller.jsを修正
・上記の修正に伴い、inc_bbcode.tplを修正

2007/09/19 Ver 0.6.4
・MyNETSの場合は、prototype.jsおよびscript.aculo.us関連のJavascipt
  ファイルを入れ替えないように注意喚起の文を記述
・インストール、設定、動作確認をOpenPNE用（install_openpne.txt）と
  MyNETS用（install_mynets.txt）に分離した（一部はreadme.txt内）
・openpne/public_html/css/default.css を削除
  （テンプレートモジュールのアーカイブにて配布）
・inc_bbcode.tplのタブを半角スペースに置換
・modifier.bbcode2html4pc.phpに[slideshare]タグ追加

2007/09/11 Ver 0.6.3
・restopicsbutton.js、resdiarybutton.jsに不具合があったので修正

2007/08/26 Ver 0.6.2
・Gecko系ブラウザで入力支援を使うと、カーソルがテキストエリアの先頭に
  移動してしまう問題を修正（bbcode.controller.js）

2007/08/17 Ver 0.6.1
・OpenPNE 2.6.10、2.8.3、2.9.2、MyNETS1.0.1stable-20070815、
  MyNEMyNETS-1.1.0stable-20070814に対応
・利用規定をPHPライセンスに戻した
・modifier.bbcode2del.phpに不具合があったため修正
・[url]内に[img]を存在させた（入れ子構造）場合の致命的な問題を修正
・skin/bbcodeにbbcode_cmd.gif、bbcode_preview.gif追加（機能はないが）

2007/08/07 Ver 0.6.0
・OpenPNE 2.6.9、2.8.2、MyNEMyNETS-1.1.0Nighty-20070807に対応
・prototype.js 1.5.1.1 → 1.5.0 に入れ替え（エラーになるため）
・利用規定を一部変更
・Smarty Pluginを全面改定した
・OpenPNE用独自BBCodeタグを追加
・携帯の場合、BBCodeタグを除去して表示していたが、装飾して表示する
  ように仕様変更
・inc_bbcode_css.tpl を削除し、CSSファイル(bbcode_buttons.css)に変更
・bbcode.cssからBBCodeタグ装飾用のスタイル（bbcode_tags.css）と入力
  支援部のスタイル（bbcode.css）を分離した
・ハイライトタグのカラーピッカーを変更
・カラーピッカーのボタンを画像に変更
・シンプルセレクタ bbcode.selector.js を導入し、サイズ指定とスクロール
  をセレクタから選択するようにして、ボタン化した
・文字のサイズ（[size]）を、絶対指定（pt）から相対指定（x-smallなど）
  で選択するように変更。実際の表示サイズの設定はbbcode_tags.cssで設定
・添え字と上付き文字を追加
・「日記でコメント」ボタン表示用Javascriptファイル追加

2007/07/05 Ver 0.5.0
・MyNETS（MyNETS-1.1.0Nighty-20070628）に対応
・カラーピッカーをドラッグ＆ドロップできるようにした
・レビューでもBBCodeを使用できるようにした
・ボタン用画像の配置場所をskinからskin/bbcodeに変更した
・Smarty Pluginの大幅な見直しを行った

2007/06/03 Ver 0.4.3
・BBCode入力支援コントロールの外部Javascriptファイル名が間違っていた
　ので変更（bbcode.coltroller.js → bbcode.controller.js）
・要望があったので、カラーピッカーのタイプを１種類追加
　（7. BBCodeタグについて」参照）
・各タグのヘルプの文言などを結構修正
・XAMPP 1.6.2 に上げてテスト

2007/05/27 Ver 0.4.0
・bbcode2htmlで、強制的にタブを「&nbsp;」４つに置換していたのを廃止
　し、[code][php][phpsrc][bbcode][noparse]のみで適用するように修正
・簡易的なカラーピッカー（bbcode.colorpicker.js）を作成し、[color]と
　[highlight]で使用可能にした。
・入力支援を行うBBCodeタグを増やした（入力支援画面などを変更）

2007/05/25 Ver 0.3.4
・Operaで確認画面ボタンを押しても、先へ進めない不具合を修正
　（必ずcheckFormを実行させていたが、動作不良の模様。無用なので廃止）
・bbcode2htmlで、強制的に半角スペースを&nbsp;に置換していたのを廃止
　し、[code][php][phpsrc][bbcode][noparse]のみで適用するように修正
・[marquee]を追加し、入力支援画面などを変更

2007/05/23 Ver 0.3.1
・スタイルとスタイルシートを整理
・ボタン画像を作成
・bbcode2htmlのURLの引数が無効になっていたので修正
・使用できるBBCodeタグの数を増やした。
・タグ増加に伴い、入力支援画面を変更した。
・GPLがらみのコードを除去し、bbcode.coltroller.jsとbbcode.taglib.jsを
  新たに書き起こした。

2007/05/16 Ver 0.2.1
・inc_bbcode.tpl 文言修正
・bbcode2htmlのURLの正規表現にミスがあった

2007/05/16 Ver 0.2.0
・日記だけでなく、コミュニティ、トピック、イベントに対応
・[img]の入力方法と表示方法を変更した
・[url]タグに対応
・bbcode2html、bbcode2delの処理を変更した

2007/05/14 Ver 0.1.2
・OpenPNE 2.8β7に対応
・携帯用のテンプレート変更内容が間違っていた
・bbcode2htmlを入れる順番がばらばらだったので統一

2007/05/13 Ver 0.1.0
・とりあえず動くものができたので公開（日記だけ）


================================================================================
Copyright (C) 2007. Naoya Shimada. All Rights Reserved.
