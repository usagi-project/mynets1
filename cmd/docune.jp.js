function url2cmd(url) {
    if (!url.match(/^http:\/\/docune\.jp\/doc\/([0-9]+)/)) {
        document.write('<font color="red">'+url+'</font>');
        return;
    }
    var id = RegExp.$1;

    main(id,url);
}

function main(id,url) {
    var html ='<object width="420" height="315"><param name="movie" value="http://docune.jp/viewer.swf?documentid='
        + id
        + '" /><embed name="PubKnowle" width="420" height="315" src="http://docune.jp/viewer.swf?documentid='
        + id
        + '" type="application/x-shockwave-flash"></embed></object><div style="padding:5px;"><a href="http://docune.jp/viewer.swf?documentid='
        + id
        + '" target="_blank" onmouseover= form1.text1.value="原寸大で開く(別ウィンドウ)" onmouseout= form1.text1.value=""><img src="./skin/default/img/icon_window.gif" alt="別ウィンドウで開く（原寸）" title="原寸大で開く(別ウィンドウ)" style="margin:0px 5px;"></a>'
        + '<a href="http://docune.jp/doc/'
        + id
        + '/download/pdf" onmouseover= form1.text1.value="PDF形式(AdobeAcrobat)でダウンロード\\nPDF形式以外のファイルは存在しないかも知れません.\\nアップロードした際のファイル形式およびPDF形式のみダウンロードできます." onmouseout= form1.text1.value=""><img src="http://docune.jp/img/pdf_icon.gif" alt="PDF形式(Acrobat)でダウンロード" title="PDF形式(Acrobat)でダウンロード" style="margin:0px 10px 0px 5px;"></a>'

        + '<a href="http://docune.jp/doc/'
        + id
        + '/download/doc" onmouseover= form1.text1.value="DOC形式(MicrosoftWord)でダウンロード\\nファイルは存在しないかも知れません.\\nアップロードした際のファイル形式およびPDF形式のみダウンロードできます." onmouseout= form1.text1.value=""><img src="http://docune.jp/img/doc_icon.gif" alt="DOC形式(Word)でダウンロード" title="DOC形式でダウンロード" style="margin:0px 2px;"></a>'
        + '<a href="http://docune.jp/doc/'
        + id
        + '/download/xls" onmouseover= form1.text1.value="XLS形式(MicrosoftExcel)でダウンロード\\nファイルは存在しないかも知れません.\\nアップロードした際のファイル形式およびPDF形式のみダウンロードできます." onmouseout= form1.text1.value=""><img src="http://docune.jp/img/xls_icon.gif" alt="XLS形式(Exel)でダウンロード" title="XLS形式でダウンロード" style="margin:0px 2px;"></a>'
        + '<a href="http://docune.jp/doc/'
        + id
        + '/download/ppt" onmouseover= form1.text1.value="PPT形式(MicrosoftPowerPoint)でダウンロード\\nファイルは存在しないかも知れません.\\nアップロードした際のファイル形式およびPDF形式のみダウンロードできます." onmouseout= form1.text1.value=""><img src="http://docune.jp/img/ppt_icon.gif" alt="PPT形式(PowerPoint)でダウンロード" title="PPT形式でダウンロード" style="margin:0px 2px;"></a>'
        + '<a href="http://docune.jp/doc/'
        + id
        + '/download/rtf" onmouseover= form1.text1.value="RTF形式(リッチテキストフォーマット)でダウンロード\\nファイルは存在しないかも知れません.\\nアップロードした際のファイル形式およびPDF形式のみダウンロードできます." onmouseout= form1.text1.value=""><img src="http://docune.jp/img/txt_icon.gif" alt="RTF形式(リッチテキストフォーマット)でダウンロード" title="RTF形式でダウンロード" style="margin:0px 7px;"></a>'
        + '<a href="http://docune.jp/doc/'
        + id
        + '/download/odt" onmouseover= form1.text1.value="ODT形式(OpenOfficeドキュメント)でダウンロード\\nファイルは存在しないかも知れません.\\nアップロードした際のファイル形式およびPDF形式のみダウンロードできます." onmouseout= form1.text1.value=""><img src="http://docune.jp/img/odt_icon.gif" alt="ODT形式(OpenOfficeドキュメント)でダウンロード" title="ODT形式でダウンロード" style="margin:0px 2px;"></a>'
        + '<a href="http://docune.jp/doc/'
        + id
        + '/download/ods" onmouseover= form1.text1.value="ODS形式(OpenOfficeスプレッドシート)でダウンロード\\nファイルは存在しないかも知れません.\\nアップロードした際のファイル形式およびPDF形式のみダウンロードできます." onmouseout= form1.text1.value=""><img src="http://docune.jp/img/ods_icon.gif" alt="ODS形式(OpenOfficeスプレッドシート)でダウンロード" title="ODS形式でダウンロード" style="margin:0px 2px;"></a>'
        + '<a href="http://docune.jp/doc/'
        + id
        + '/download/odp" onmouseover= form1.text1.value="ODP形式(OpenOfficeプレゼンテーション)でダウンロード\\nファイルは存在しないかも知れません.\\nアップロードした際のファイル形式およびPDF形式のみダウンロードできます." onmouseout= form1.text1.value=""><img src="http://docune.jp/img/odp_icon.gif" alt="ODP形式(OpenOfficeプレゼンテーション)でダウンロード" title="ODP形式でダウンロード" style="margin:0px 2px;"></a>'
        + '<a href="http://docune.jp/doc/'
        + id
        + '/download/odg" onmouseover= form1.text1.value="ODG形式(OpenOfficeグラフィック)でダウンロード\\nファイルは存在しないかも知れません.\\nアップロードした際のファイル形式およびPDF形式のみダウンロードできます." onmouseout= form1.text1.value=""><img src="http://docune.jp/img/odg_icon.gif" alt="ODG形式(OpenOfficeグラフィック)でダウンロード" title="ODG形式でダウンロード" style="margin:0px 2px;"></a>'
        + '<a href="'
        + url
        + '" target="_blank" onmouseover= form1.text1.value="docuneで開く(別ウィンドウ)\\ndocuneのサイトで文書を開きます." onmouseout= form1.text1.value="" name="documeで開く（別ウィンドウ）" style="margin:0px 20px;">docuneで開く</a></div>'
        + '<form name="form1"id="coution" method="post" action=""><textarea name="text1" style="width:408px;height:4em;border-width:1px;overflow:hidden;padding:20px 5px 5px 5px;"></textarea></form>';

    document.write(html);
}
